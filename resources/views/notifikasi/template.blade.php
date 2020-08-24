<!-- Menu toggle button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btn_notif">
    <i class="fa fa-bell-o"></i>
    @if (count(Auth::user()->unreadNotifications) > 0)
    <span class="label label-warning" id="jml_notif">{{ count(Auth::user()->unreadNotifications) }}</span>
    @endif
</a>
<ul class="dropdown-menu">
    <li class="header">
    @if (count(Auth::user()->unreadNotifications) > 0)
    <li class="header">
        <span id="header_notif">{{ count(Auth::user()->unreadNotifications) }} Notif
            Baru</span>

        <span style="float: right;"><a href="#" id="readAll">Tandai Telah Dibaca
                Semua</a></span>
    </li>
    @else
    <li class="header">Tidak Ada Notifikasi Baru</li>
    @endif
    </li>
    <li>
        <!-- Inner Menu: contains the notifications -->
        <ul class="menu" id="list_notif">
            <!-- start notification -->

            @yield('content')


            <!-- end notification -->
        </ul>
    </li>
    @if (count(Auth::user()->notifications) > 0)
    <li class="footer"><p style="height: 4px;"></p></li>
    {{-- <li class="footer"><a href="{{ route('notifikasi.index') }}">Lihat Semua</a></li> --}}
    @endif
</ul>
