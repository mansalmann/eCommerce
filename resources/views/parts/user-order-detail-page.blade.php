@extends('layouts.main')
@section('content')
@livewire('user-order-detail-page', ['orderId' => $orderId])
@endsection