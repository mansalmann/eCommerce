@extends('layouts.main')
@section('content')
@livewire('product-detail-page', ['slug' => $product])
@endsection