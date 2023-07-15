@extends('layouts.app')

@section('contents')

<header class="p-3 grid grid-flow-col">
  <h1 class="text-2xl w-96 ms-12 mt-5 ">
    <span class="font-bold" style="color:#F9A109">Shoppingify</span> <span class="font-medium"> allows you take your shopping list wherever you go</span>
  </h1>
  <div class="grow relative max-w-xs mt-5">
    <label for="hs-table-search" class="sr-only">Search</label>
    <input type="text" name="hs-table-search" id="hs-table-search" class="p-3 pl-10 block w-full border-gray-200 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Search for items">
    <div class="absolute top-3 left-0 flex items-center pointer-events-none pl-4">
      <span class="material-symbols-outlined">
        search
      </span>
    </div>

  </div>
</header>


<div class="xl:container-xl md:container-md mt-10 mx-12">
  <div class="font-bold text-lg mb-3">Fruit and vegetables</div>
  <div class="grid lg:grid-cols-4 md:grid-cols-2 lg:gap-10 md:gap-5 sm:gap-2.5">
    @foreach($itemsCategory1 as $item)
    <button class="flex justify-between rounded-2xl shadow-md p-4 bg-white font-bold text-left text-base">
      {{ $item->name }}
      <span class="material-symbols-outlined ">
        add
      </span>
    </button>
    @endforeach
  </div>


  <div class="font-bold mt-16 text-lg mb-3">Meat and Fish</div>
  <div class="grid lg:grid-cols-4 md:grid-cols-2 lg:gap-10 md:gap-5 sm:gap-2.5">
    @foreach($itemsCategory2 as $item)
    <button class="flex justify-between rounded-2xl shadow-md p-4 bg-white font-bold text-left text-base">
      {{ $item->name }}
      <span class="material-symbols-outlined ">
        add
      </span>
    </button>
    @endforeach
  </div>


  <div class="font-bold mt-16 text-lg mb-3">Beverages</div>
  <div class="grid lg:grid-cols-4 md:grid-cols-2 lg:gap-10 md:gap-5 sm:gap-2.5">
    @foreach($itemsCategory3 as $item)
    <button class="flex justify-between rounded-2xl shadow-md p-4 bg-white font-bold text-left text-base">
      {{ $item->name }}
      <span class="material-symbols-outlined ">
        add
      </span>
    </button>
    @endforeach
  </div>

  <div class="font-bold mt-16 text-lg mb-3">Pets</div>
  <div class="grid lg:grid-cols-4 md:grid-cols-2 lg:gap-10 md:gap-5 sm:gap-2.5">
    @foreach($itemsCategory4 as $item)
    <button class="flex justify-between rounded-2xl shadow-md p-4 bg-white font-bold text-left text-base">
      {{ $item->name }}
      <span class="material-symbols-outlined ">
        add
      </span>
    </button>
    @endforeach
  </div>

</div>

@endsection