@extends('layouts.main')
@section('content')
@livewire('order-cancel-page', ['invoiceId' => $invoiceId])
@endsection