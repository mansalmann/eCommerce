@extends('layouts.main')
@section('content')
@livewire('order-success-page', ['invoiceId' => $invoiceId])
@endsection