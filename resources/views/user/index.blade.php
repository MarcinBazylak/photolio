@extends('layouts.panel')

@section('content')

@if(Auth::check())
   <h1>Ustawienia</h1>
   <br>
   {{ Auth::user()->username }}<br>
   {{ Auth::user()->name }}<br>
   {{ Auth::user()->email }}<br>
@endif

@endsection
