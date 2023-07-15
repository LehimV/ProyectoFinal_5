<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ProyectoFinal5-MLVL</title>

  <!-- icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">


  <!-- styles-->
  @vite('resources/css/app.css')
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</head>

<body>
  <main class="container-xl">
    <div class="flex">
      <div class="grid grid-rows-3 grid-flow-col justify-center w-20 sm:w-20 h-screen">
        <div class="mt-6">
          <img src="../logo.svg" width="40" alt="">
        </div>
        <nav class="grid justify-center">
          @php
          $activeButton = 'list';
          @endphp
          <ul>
            <li id="mainMenu" class="mb-6 {{ $activeButton === 'list' ? 'bg-orange-500' : '' }}"><a href="{{ route('items.index') }}"><span class="material-symbols-outlined">
                  format_list_bulleted
                </span></a></li>
            <li id="mainMenu" class=""><a href=""><span class="material-symbols-outlined">
                  replay
                </span></a></li>
            <li id="mainMenu" class="mt-6"><a href=""><span class="material-symbols-outlined">
                  insert_chart
                </span></a></li>
          </ul>
        </nav>
        <div class="grid content-end mb-5"><img src="../shopping_cart.svg" width="45" alt=""></div>
      </div>

      <div id="content" class="grow h-screen bg-gray-100" style="background-color: #FAFAFE;">
        @yield('contents')
      </div>
      <div class="flex w-96 sm:w-96 h-screen" style="background-color: #FFF0DE;">
        03
      </div>
    </div>


  </main>

  <footer class="mt-8">
    <p class="text-center text-gray-600">&copy; 2023 Shoppingify. All rights reserved.</p>
  </footer>

</body>

</html>