@extends('layouts.auth-main')
@section('auth-content')
@livewire('reset-password-page', ['user' => $user])
@endsection