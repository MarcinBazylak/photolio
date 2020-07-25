<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio - Twoje portfolio fotograficzne</title>
   <link rel="stylesheet" href="/css/scroll.css">
   <link rel="stylesheet" href="/css/style.css">
</head>
<body>

   <div class="container">
   
      <section class="section">
         <div class="insection">
            <h2 class="title">Photolio</h2>
            <h3>PODZIEL SIĘ PASJĄ</h3>
            <p>
               Photolio zostało stworzone przez ludzi, których pasją jest fotografowanie. Jeżli podzielasz ich pasję i chcesz dzielić się swoimi pracami, to jest to miejsce dla CIebie.
            </p>
            <p>
               Wpisz nazwę strony jakiej chciałbyś używać aby sprawdzić czy jest wolna. Rejestracja zajmuje tylko chwilę.
            </p>
            <form action="" method="post">
               @csrf
               <input type="text" name="username" class="username-check">
               <button type="submit" class="username-check button">Sprawdź</button>
            </form>
         </div>
      </section>
      <section class="section">
         <h2 class="title">Tutorial 1</h2>
      </section>
      <section class="section">
         <h2 class="title">Tutorial 2</h2>
      </section>
      <section class="section">
         <h2 class="title">Kontakt</h2>
      </section>

   </div>

</body>
</html>