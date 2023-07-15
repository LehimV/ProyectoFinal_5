@extends('layouts.app')

@section('contents')

<div class="fixed h-screen w-10 lg:w-64 p-3 bg-white">
  Contenido del sidebar
</div>

<div class="pl-16 lg:pl-63 h-screen w-full flex flex-col">

  <header class="p-3 bg-gray-100">
    Header
  </header>

  <div class="flex-grow bg-gray-100">

    <div class="container p-4">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tincidunt sodales nibh, tristique bibendum risus molestie et. Etiam consectetur quam fringilla, dapibus ligula ac, interdum lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut non eleifend sem. Vestibulum arcu velit, eleifend ut aliquam gravida, fringilla et justo. Ut et rutrum nisi. Aliquam erat volutpat. Pellentesque vel risus ut ex rhoncus pretium. Quisque feugiat eu neque vel maximus.</p>
      <p>Nam fringilla felis sem, vitae sollicitudin risus fringilla in. In nunc orci, interdum sit amet tellus placerat, condimentum interdum purus. Duis molestie sollicitudin lectus id pellentesque. In ut sem massa. Nam efficitur nibh leo, ac iaculis arcu consectetur nec. Donec et dui eget turpis lobortis ullamcorper at et odio. Cras porta aliquet ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec tristique ornare lorem id aliquam.</p>
    </div>
  </div>



</div>


@endsection