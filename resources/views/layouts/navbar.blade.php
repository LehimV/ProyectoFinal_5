<section class="grid grid-rows-3 grid-flow-col justify-center sm:w-24 h-screen">
  <div class="mt-6">
    <a href="{{ route('welcome') }}"> <img src="../logo.svg" width="40" alt=""></a>
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
</section>