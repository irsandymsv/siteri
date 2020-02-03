{{-- <li> --}}
<!-- Inner Menu: contains the notifications -->
<ul class="menu" id="list_notif">
    <!-- start notification -->

    @yield('content')


    <!-- end notification -->
</ul>
{{-- </li>
@if (count(Auth::user()->notifications) > 0)
<li class="footer"><a href="{{ route('notifikasi.index') }}">Lihat Semua</a></li>
@endif --}}
