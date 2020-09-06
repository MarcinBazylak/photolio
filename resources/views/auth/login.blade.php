@extends('layouts.main')

@section('content')
<section class="section">
   <div class="wrapper">
      <h1>Zaloguj się</h1>
      <form method="POST" action="{{ route('login') }}">
         @csrf

         <div>
            <label for="email">{{ __('E-Mail Address') }}</label>
            <div>
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
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
               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" required>
               <span class="feedback">
                  @error('password')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>

         <div style="margin-top: 10px; margin-bottom: 10px">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
               {{ __('Remember Me') }}
            </label>
         </div>

         <div>
            <button type="submit" class="form-control">
               {{ __('Login') }}
            </button>
         </div>

         
         @if(Route::has('password.request'))
         <div style="margin-top: 10px; margin-bottom: 10px">
            <a href="{{ route('password.request') }}">
               {{ __('Forgot Your Password?') }}
            </a>
         </div>
         @endif

      </form>
   </div>
</section>
@endsection
