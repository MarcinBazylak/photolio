@extends('layouts.panel')

@section('content')

@if(Auth::check('verified'))
   <h1>Użytkownicy</h1>

   @error('albumName')
      <div class="alert">
         {{ $message }}
      </div>
   @enderror

   @foreach($users as $user)
      {{ $user->id }} | {{ $user->is_admin }} | {{ $user->terms_accepted }} | {{ $user->username }} | {{ $user->name }} | {{ $user->email }} | {{ $user->created_at }} | {{ $user->updated_at }} | {{ $user->email_verified_at }}
      <br>
   @endforeach

   <div class="screen-overlay"></div>
@endif
@endsection
