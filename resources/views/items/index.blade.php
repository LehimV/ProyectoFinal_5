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









@endsection