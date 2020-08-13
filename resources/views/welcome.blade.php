@extends('layouts.main')

@section('content')

@if(Auth::check())
   {{ Auth::user()->username }}
   {{ Auth::user()->name }}
   {{ Auth::user()->email }}
@endif

@endsection
