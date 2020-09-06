@extends('layouts.main')

@section('content')
<section class="section">
   <div class="wrapper">
      <h1>Resetowanie hasła</h1>
      <form method="POST" action="{{ route('password.update') }}">
         @csrf
         <input type="hidden" name="token" value="{{ $token }}">
         <div>
            <label for="email">{{ __('E-Mail Address') }}</label>
            <div>
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
               <span class="feedback">
                  @error('email')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <div>
            <label for="password">{{ __('Password') }}</label>
            <div>
               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
               <span class="feedback">
                  @error('password')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <div>
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <div>
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
         </div>
         <div>
            <button type="submit" class="form-control">
               {{ __('Reset Password') }}
            </button>
         </div>
      </form>
   </div>
</section>
@endsection
