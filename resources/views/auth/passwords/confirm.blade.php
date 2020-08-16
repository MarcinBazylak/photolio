@extends('layouts.main')

@section('content')

<h1>{{ __('Confirm Password') }}</h1>

{{ __('Please confirm your password before continuing.') }}

<form method="POST" action="{{ route('password.confirm') }}">
   @csrf

   <div>
      <label for="password">{{ __('Password') }}</label>
      <div>
         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
         <span class="feedback">
            @error('password')
               <strong>{{ $message }}</strong>
            @enderror
         </span>
      </div>
   </div>

   <div>
      <button type="submit">
         {{ __('Confirm Password') }}
      </button>

      @if(Route::has('password.request'))
         <a href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
         </a>
      @endif
   </div>
</form>
@endsection
