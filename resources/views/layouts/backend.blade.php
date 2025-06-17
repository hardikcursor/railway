<!DOCTYPE html>
<html lang="en">
@include('include.head')

<body class="fixed-navbar">
    <div class="page-wrapper">
        @include('include.header')
        @include('include.sidebar')
        @yield('main')
        @include('include.footer')
    </div>
    @include('include.backdrop')
    @include('include.script')
</body>

</html>
