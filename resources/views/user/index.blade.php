@extends('layouts.panel')

@section('content')

@if (Auth::check())
    Ustawienia
    <br>
    {{ Auth::user()->username }}<br>
    {{ Auth::user()->name }}<br>
    {{ Auth::user()->email }}<br>
@endif

@endsection