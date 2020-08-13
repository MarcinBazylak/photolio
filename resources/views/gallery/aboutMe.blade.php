@extends('layouts.gallery')

@section('content')

<div class="wrapper">

   <h2>{{ $aboutMe->title }}</h2>
   <p style="text-align: justify">{!! nl2br(e($aboutMe->description)) !!}</p>

</div>

@endsection
