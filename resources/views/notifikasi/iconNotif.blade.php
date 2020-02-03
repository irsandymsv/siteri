{{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btn_notif"> --}}
<i class="fa fa-bell-o"></i>
@if (count(Auth::user()->unreadNotifications) > 0)
<span class="label label-warning" id="jml_notif">{{ count(Auth::user()->unreadNotifications) }}</span>
@endif
{{-- </a> --}}
