<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio - Twoje portfolio fotograficzne</title>
   <link rel="stylesheet" href="/css/style.css">
   <link rel="stylesheet" href="/css/forms.css">
</head>
<body>

   <div class="container">
   
      <section class="section">

         <div class="first-section">
            <div class="top"></div>
            <div class="mid-left">
               <img class="front-image" src="/img/left-main.jpg" alt="front">
            </div>
            <div class="mid-right">
               <h1 class="title">ZBUDUJ SWOJĄ GALERIĘ</h1>
               <h2>W TRZECH PROSTYCH KROKACH</h2>
               
               <h3>- Utwórz konto</h3>
               <h3>- Dodaj albumy</h3>
               <h3>- Dodawaj do nich zdjęcia</h3>
               <p>
                  Photolio zostało stworzone przez ludzi, których pasją jest fotografowanie. Jeżli podzielasz ich pasję i chcesz dzielić się swoimi pracami, to jest to miejsce dla CIebie.
               </p>

            </div>
            <div class="bottom">
               <img src="/img/arrow-down.png" alt="arrow down">
            </div>
         </div>

      </section>
      <section class="section">
            <p>
               Wpisz nazwę strony jakiej chciałbyś używać aby sprawdzić czy jest wolna.
            </p>
            <p>
               Możesz używać wielkich oraz małych liter, cyfr oraz znaku podkreślnika.<br>
               Adres Twojej strony będzie wyglądał następująco:<br>
            </p>
            <form action="" method="post">
               @csrf
               <input placeholder="https://photolio.pl/twoja_strona" type="text" name="username" class="username-check">
               <button type="submit" class="username-check button">Sprawdź</button>
            </form>
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