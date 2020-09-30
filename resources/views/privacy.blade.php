@extends('layouts.main')
@section('content')
<section class="section">
   <div class="wrapper">
      <h1>Polityka prywatności</h1>

      <h2>
         Polityka prywatności opisuje zasady przetwarzania przez nas informacji na Twój temat, w tym danych osobowych oraz ciasteczek, czyli tzw. cookies.
      </h2>
      <p style="text-align: left; line-height: 2;">

         {!! nl2br(e($privacy)) !!}

      </p>

   </div>
</section>
@endsection
