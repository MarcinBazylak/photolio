@extends('layouts.main')

@section('content')
<section class="section">
   <div class="wrapper">
      <h1>Zarejestruj się</h1>
      <form method="POST" action="{{ route('register') }}">
         @csrf

         <div>
            <label for="username">Nazwa użytkownika</label>
            <div>
               <input id="username" type="text" placeholder="dozwolone: małe litery i cyfry" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $username ?? '' }}" {{ ($username ?? '') ? 'readonly' : '' }} autocomplete="off" required>
               <span class="feedback">
                  @error('username')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>

         <div>
            <label for="name">Imię lub pseudonim artystyczny</label>
            <div>
               <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" required>
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
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" required>
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
               <input id="password" type="password" placeholder="min. 8 znaków" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>
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
               <input id="password-confirm" type="password" placeholder="min. 8 znaków" class="form-control" name="password_confirmation" autocomplete="new-password" required>
            </div>
         </div>

         <div style="margin-top: 10px; margin-bottom: 10px">

            <label class="checkbox">Potwierdzam, że zapoznałem się z <a href="/regulamin" style="text-decoration: underline;">regulaminem</a> i akceptuję jego warunki.
               <input id="terms-accepted" type="checkbox" name="terms-accepted" value="1" required>
               <span class="checkmark"></span>
            </label>

            <span class="feedback">
               @error('terms-accepted')
                  <strong>Musisz zaakceptować regulamin.</strong>
               @enderror
            </span>
         </div>

         <div>
            <button type="submit" class="form-control">
               {{ __('Register') }}
            </button>
         </div>
      </form>
   </div>
</section>
@endsection
