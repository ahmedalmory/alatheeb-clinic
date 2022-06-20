@include('style.layouts.header')
@include('style.layouts.navbar')
@include('style.layouts.message')
<!-- container-fluid -->
<div class="container" style="min-height:75vh">
@yield('content')
</div>
@include('style.layouts.footer')
