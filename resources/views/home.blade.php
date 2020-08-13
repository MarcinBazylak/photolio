@extends('layouts.main')

@section('content')

@if(Auth::check())
   Jsteś zalogowany
@endif

@endsection
