<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnlineClothing</title>
</head>

<body>
    <div style="background-color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 2.25rem; line-height: 2.5rem; font-weight: 700; color: #64748b; margin-bottom: 3rem;">Order
            Details</h1>
        <h2 style="font-size: 1.25rem; line-height: 2.5rem; font-weight: 500; color: #64748b; margin-bottom: 1rem;">
            Customer Information</h2>
        <table
            style="width: 100%; border-collapse: collapse; background-color: white; border-radius: 0.5rem; overflow: hidden;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Customer</th>
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Order Date</th>
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Order Status</th>
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #e2e8f0; transition: background-color 0.2s;">
                    <td style="padding: 1rem 1.5rem; color: #1e293b; font-size: 0.875rem;">{{ $address->full_name }}
                    </td>
                    <td style="padding: 1rem 1.5rem; color: #1e293b; font-size: 0.875rem;">
                        {{ $order_items[0]->created_at->format('d-m-Y') }}</td>
                    <td style="padding: 1rem 1.5rem; color: #1e293b; font-size: 0.875rem;">
                        @php
                            $statusStyle = '';
                            $statusText = $order->status;

                            switch ($order->status) {
                                case 'new':
                                    $statusStyle =
                                        'background-color: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                case 'processing':
                                    $statusStyle =
                                        'background-color: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                case 'shipped':
                                    $statusStyle =
                                        'background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                case 'delivered':
                                    $statusStyle =
                                        'background-color: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                case 'canceled':
                                    $statusStyle =
                                        'background-color: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                default:
                                    $statusStyle =
                                        'background-color: #f3f4f6; color: #374151; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                            }
                        @endphp
                        <span style="{{ $statusStyle }}">{{ $statusText }}</span>
                    </td>
                    <td style="padding: 1rem 1.5rem; color: #1e293b; font-size: 0.875rem;">
                        @php
                            $paymentStyle = '';
                            $paymentText = $order->payment_status;

                            switch ($order->payment_status) {
                                case 'paid':
                                    $paymentStyle =
                                        'background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                case 'pending':
                                    $paymentStyle =
                                        'background-color: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                case 'failed':
                                    $paymentStyle =
                                        'background-color: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                                    break;
                                default:
                                    $paymentStyle =
                                        'background-color: #f3f4f6; color: #374151; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 500; font-size: 0.75rem; text-transform: uppercase;';
                            }
                        @endphp
                        <span style="{{ $paymentStyle }}">{{ $paymentText }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2 style="font-size: 1.25rem; line-height: 2.5rem; font-weight: 500; color: #64748b; margin-bottom: 1rem;">
            Products Information</h2>
        <table
            style="width: 100%; border-collapse: collapse; background-color: white; border-radius: 0.5rem; overflow: hidden;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Product</th>
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Price</th>
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Quantity</th>
                    <th
                        style="padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: #475569; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $item)
                    <tr wire:key="{{ $item->id }}"
                        style="border-bottom: 1px solid #e2e8f0; transition: background-color 0.2s;">
                        <td style="padding: 1rem 1.5rem; color: #1e293b;">
                            <p style="font-weight: 600; font-size: 0.875rem; margin: 0;">{{ $item->product->name }}</p>
                        </td>
                        <td style="padding: 1rem 1.5rem; color: #64748b; font-size: 0.875rem;">
                            Rp. {{ number_format($item->unit_amount, 0, ',', '.') }}
                        </td>
                        <td style="padding: 1rem 1.5rem; color: #64748b; font-size: 0.875rem;">
                            <span
                                style="display: inline-block; background-color: #f1f5f9; padding: 0.25rem 0.75rem; border-radius: 9999px; min-width: 2rem; text-align: center;">{{ $item->quantity }}</span>
                        </td>
                        <td style="padding: 1rem 1.5rem; color: #1e293b; font-weight: 600; font-size: 0.875rem;">
                            Rp. {{ number_format($item->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2 style="font-size: 1.25rem; line-height: 2.5rem; font-weight: 500; color: #64748b; margin-bottom: 1rem;">
            Shipping Information</h2>
        <div style="padding-left: 1.25rem">
            <p style="font-weight: 600;">Address:</p>
            <p>{{ $address->address }}</p>
            <p style="font-weight: 600;">Phone:</p>
            <p>{{ $address->phone }}</p>
        </div>
        <h2 style="font-size: 1.25rem; line-height: 2.5rem; font-weight: 500; color: #64748b; margin-bottom: 1rem;">
            Summary</h2>
        <div style="padding-left: 1.25rem">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span>Subtotal</span>
                <span style="position:absolute; right: 0;">Rp.
                    {{ number_format($item->order->grand_total, 0, ',', '.') }}</span>
            </div>
            <div style="margin-bottom: 0.5rem;">
                <span>Taxes</span>
                <span style="position:absolute; right: 0;">Rp. {{ number_format(0, 0, ',', '.') }}</span>
            </div>
            <div style="margin-bottom: 0.5rem;">
                <span>Shipping</span>
                <span style="position:absolute; right: 0;">Rp. {{ number_format(0, 0, ',', '.') }}</span>
            </div>
            <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
            <div style="margin-bottom: 0.5rem;">
                <span style="font-weight: 600;">Grand Total</span>
                <span style="font-weight: 600; position: absolute; right: 0;">Rp.
                    {{ number_format($item->order->grand_total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</body>

</html>
