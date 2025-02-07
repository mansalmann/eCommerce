<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MidtransController extends Controller
{
    public function callback(Request $request){
        $payload = $request->getContent();
        $request = json_decode($payload); 
        $serverKey = config('midtrans.serverKey');
        $hashedKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashedKey !== $request->signature_key) {
            return response()->json([                
                'message' => 'Invalid signature key',
            ], 403);
        }

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        $transaction = Order::where('id', $orderId)->first();

        if(!$transaction){
            return response()->json([
                'message' => 'Transaction not found',
            ], 404);
        }

      
        switch ($transactionStatus) {
            case 'capture':
                if($request->payment_type == 'credit_card'){
                    if($request->fraud_status == 'challenge'){
                        $transaction->update([
                            'payment_status' => 'pending',
                        ]);
                    }else{
                        $transaction->update([
                            'payment_status' => 'success',
                            'status' => 'processing'
                        ]);
                    } 
                }
            case 'settlement':
                $transaction->update([
                    'payment_status' => 'success',
                    'status' => 'processing'
                ]);

                break;
            case 'pending':
                $transaction->update([
                    'payment_status' => 'pending',
                ]);
                break;
            case 'deny':
                $transaction->update([
                    'payment_status' => 'failed',
                ]);
                break;
            case 'expire':
                $transaction->update([
                    'payment_status' => 'expired',
                    'status' => 'canceled'
                ]);
                break;
                case 'cancel':
                    $transaction->update([
                    'payment_status' => 'canceled',
                    'status' => 'canceled'
                ]);
                break;
            default:
            $transaction->update([
                'payment_status' => 'unknown',
                'status' => 'canceled'
            ]);
            break;
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}
