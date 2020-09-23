@extends('layouts.main')
@section('content')
<section class="section">
   <div class="wrapper">
      <img src="/img/logo.png" alt="logo" class="logo">
      @guest
         <H2>Szukasz miejsca na swoją fotogalerię?</H2>
         <p>Wpisz nazwę użytkownika i sprawdź czy jest dostępna</p>
         <div>
            <form action="/" method="post" id="checkUserName">
               @csrf
               <input placeholder="dozwolone: małe litery i cyfry" type="text" name="username" id="username" class="form-control" placeholder="Twoja nazwa użytkownika" autocomplete="off" required>
               <button type="submit" class="form-control">Sprawdź</button>
               <span class="feedback">
                  @error('username')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </form>
         </div>
      @endguest
      @auth
         <H2>Aktualnie jesteś zalogowany</H2>
         <p>To oznacza, że znalazłeś już miejsce na swoją galerię.<br>Z tego miejsca możesz przejść do:</p>
         <div class="contact-input-inline">
            <a href="http://{{ Auth::user()->username }}.{{ config('app.url') }}" tabindex="-1"><button type="button" class="form-control main-page" style="margin-right: 15px">swojej galerii</button></a>
            <a href="/panel" tabindex="-1"><button type="button" class="form-control main-page">panelu</button></a>
         </div>
      @endauth
   </div>
</section>

<section class="section" id="kontakt">
   <div class="wrapper">
      <h1>Napisz do nas</h1>
      <div style="text-align: center">
         {!! session('message') ?? '' !!}
      </div>
      <form enctype="multipart/form-data" action="/kontakt" method="post" id="contactForm">
         @csrf
         <p>
            Jeśli masz jakieś pytania lub sugestie dotyczace naszego serwisu, możesz skontaktować się z nami za pomocą poniższego furmularza
         </p>
         <div class=" form">
            <div class="contact-input-inline">
               <input placeholder="Twoje imię" id="contact-name" type="text" name="contact-name" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->name ?? old('contact-name') ?? '' }}" {{ (Auth::check()) ? 'readonly' : '' }} maxlength="80" autocomplete="off" required>
               <input placeholder="Twój adres email" id="contact-email" type="email" name="contact-email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email ?? old('contact-email') ?? '' }}" {{ (Auth::check()) ? 'readonly' : '' }} maxlength="80" autocomplete="off" required>
            </div>
            <div>
               <textarea placeholder="Twoja wiadomość" class="form-control" id="txtInput" name="enquiry" oninput="this.style.height = '' ;this.style.height = this.scrollHeight + 'px'" required></textarea>
               <input type="checkbox" name="tick" id="tick" value="123" style="display: none;">
            </div>
            @if($errors->get('contact-name') || $errors->get('contact-email') || $errors->get('enquiry'))
               @foreach($errors->all() as $message)
                  <span class="feedback">
                     {{ $message }}
                  </span>
               @endforeach
            @endif
            <div>
               <button type="submit" class="form-control" name="button">Wyślij</button>
            </div>
         </div>
      </form>
   </div>
</section>
@endsection
