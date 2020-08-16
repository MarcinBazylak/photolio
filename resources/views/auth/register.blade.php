@extends('layouts.main')

@section('content')
<h1>Załóż konto</h1>
<form method="POST" action="{{ route('register') }}">
   @csrf

   <div>
      <label for="username">Nazwa użytkownika</label>
      <div>
         <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
         <span class="feedback">
            @error('username')
               <strong>{{ $message }}</strong>
            @enderror
         </span>
      </div>
   </div>

   <div>
      <label for="name">{{ __('Name') }}</label>
      <div>
         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
         <span class="feedback">
            @error('name')
               <strong>{{ $message }}</strong>
            @enderror
         </span>
      </div>
   </div>

   <div>
      <label for="email">{{ __('E-Mail Address') }}</label>
      <div>
         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
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
         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
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
         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
      </div>
   </div>

   <div>
      <input id="terms-accepted" type="checkbox" class="@error('terms-accepted') is-invalid @enderror" style="display: inline-block !important; width: 45px !important" name="terms-accepted" value="1">
      Potwierdzam, że zapoznałem się z <a href="/regulamin">regulaminem</a> i akceptuję jego warunki.
      <span class="feedback">
         @error('terms-accepted')
            <strong><br>Musisz zaakceptować regulamin.</strong>
         @enderror
      </span>
   </div>

   <div>
      <div>
         <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
         </button>
      </div>
   </div>
</form>
@endsection
