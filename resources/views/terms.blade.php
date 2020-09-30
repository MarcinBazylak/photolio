@extends('layouts.main')
@section('content')
<section class="section">
   <div class="wrapper">
      <h1>Regulamin korzystania z serwisu</h1>

      <h2>
         Niniejszy regulamin opisuje zasady korzystania, obowiązki, prawa właściciela serwisu oraz użytkowników korzystających z usług serwisu photolio.pl.
      </h2>
      <p style="text-align: left; line-height: 2;">

         {!! nl2br(e($terms)) !!}

      </p>

   </div>
</section>
@endsection
