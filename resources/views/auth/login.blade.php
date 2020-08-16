@extends('layouts.main')

@section('content')

<form method="POST" action="{{ route('login') }}">
   @csrf

   <div>
      <label for="email">{{ __('E-Mail Address') }}</label>
      <div>
         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
         <span class="feedback">
            @error('email')
               <strong>{{ $message }}</strong>
            @enderror
         </span>
      </div>
   </div>

   <div>
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
      <div>
         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
         <span class="feedback">
            @error('password')
               <strong>{{ $message }}</strong>
            @enderror
         </span>
      </div>
   </div>

   <div>
      <div>
         <div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
               {{ __('Remember Me') }}
            </label>
         </div>
      </div>
   </div>

   <div>
      <div>
         <button type="submit">
            {{ __('Login') }}
         </button>

         @if(Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
               {{ __('Forgot Your Password?') }}
            </a>
         @endif
      </div>
   </div>
</form>
@endsection
