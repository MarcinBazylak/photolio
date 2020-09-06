@extends('layouts.main')
@section('content')
<section class="section">
   <div class="wrapper">
      <h1>{{ __('Reset Password') }}</h1>
      @if(session('status'))
         <div>
            {{ session('status') }}
         </div>
      @endif
      <form method="POST" action="{{ route('password.email') }}">
         @csrf
         <div>
            <label for="email">{{ __('E-Mail Address') }}</label>
            <div>
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Podaj swój adres email" required autocomplete="email" autofocus>
               <span class="feedback" role="alert">
                  @error('email')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <div>
            <button type="submit" class="form-control">
               {{ __('Send Password Reset Link') }}
            </button>
         </div>
      </form>
   </div>
</section>
@endsection
