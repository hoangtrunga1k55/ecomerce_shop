@extends('layout.index')
@section('header')
    @include('layout.header-index')
@endsection
@section('content')
    @include('layout.categories')
    @include('layout.featured-product')
    @include('layout.offer')
    @include('layout.testimonial')
    @include('layout.brands')
@endsection
@section('script')
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>
@endsection

