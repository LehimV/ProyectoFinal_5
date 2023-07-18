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


  <!-- styles % scripts -->
  @livewireStyles
  @vite('resources/css/app.css')
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="{{ asset('js/items_to_list.js') }}"></script>


</head>

<body>
  <main class="container-xl">
    <div class="flex">
      @include('layouts.navbar')

      <section id="content" class="grow h-min bg-gray-100" style="background-color: #FAFAFE;">
        @yield('contents')
      </section>

      <!----- RIGHT PANEL----->

      <section id="rightPanel" class="max-w-sm sm:min-w-60" style="background-color: #FFF0DE;">
        @yield('newItemPanel')
        @livewire('right-panel')
      </section>


    </div>


  </main>




  <br>
  <footer class="mt-2 p-1 bg-gray-300">
    @include('layouts.footer')
  </footer>



  @livewireScripts
</body>

</html>