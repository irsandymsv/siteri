<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield("page_title") | {{config('app.name')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Style CSs -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Sweet Alert -->
    <script src="/js/sweet.js"></script>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield("css_link")

    <style type="text/css">
        i.fa.fa-check-circle.col-xs-2,
        i.fa.fa-times-circle.col-xs-2,
        i.fa.fa-exclamation-circle.col-xs-2 {
            padding: 5px;
            font-size: 18px;
        }

        i.fa.fa-check-circle.col-xs-2 {
            color: #00a65a;
        }

        i.fa.fa-times-circle.col-xs-2 {
            color: #dd4b39;
        }

        i.fa.fa-exclamation-circle.col-xs-2 {
            color: #f39c12;
        }
    </style>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-blue sidebar-mini">
    @include('sweet::alert')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>SI</b>T</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SI</b>Teri</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Messages: style can be found in dropdown.less (was Here)-->
                        <!-- /.messages-menu -->

                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btn_notif">
                                <i class="fa fa-bell-o"></i>
                                @if (count(Auth::user()->unreadNotifications) > 0)
                                <span class="label label-warning"
                                    id="jml_notif">{{ count(Auth::user()->unreadNotifications) }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                @if (count(Auth::user()->unreadNotifications) > 0)
                                <li class="header">
                                    <span id="header_notif">{{ count(Auth::user()->unreadNotifications) }} Notif
                                        baru</span>

                                    <span style="float: right;"><a href="#" id="readAll">Tandai Telah Dibaca
                                            Semua</a></span>
                                </li>
                                @else
                                <li class="header">Tidak Ada Notifikasi Baru</li>
                                @endif

                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu" id="list_notif">
                                        <!-- start notification -->
                                        {{-- @if (Auth::user()->jabatan->jabatan == 'Pengelola Data Akademik')
                                        @foreach (Auth::user()->unreadNotifications as $notif)
                                        @if ($notif->type == 'App\Notifications\verifSutgasKtu')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                Surat Tugas
                                                @if ($notif->data['tipe_sutgas'] == "Surat Tugas Pembimbing")
                                                Pembimbing
                                                @elseif($notif->data['tipe_sutgas'] == "Surat Tugas Pembahas")
                                                Pembahas
                                                @else
                                                Penguji
                                                @endif
                                                {{ $notif->data['no_surat'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
                                                telah diverifikasi.<br>
                                                <small
                                                    style="color: grey;">{{ Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans() }}</small>
                                            </a>
                                        </li>
                                        @elseif($notif->type == 'App\Notifications\verifSKSemproKtu')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                SK Sempro
                                                {{ $notif->data['no_surat'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
                                                telah diverifikasi.<br>
                                                <small
                                                    style="color: grey;">{{ Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans() }}</small>
                                            </a>
                                        </li>
                                        @elseif($notif->type == 'App\Notifications\verifSKSkripsiKtu')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                SK Pembimbing Skripsi
                                                {{ $notif->data['no_surat_pembimbing'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
                                                dan SK Penguji Skripsi
                                                {{ $notif->data['no_surat_penguji'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
                                                telah diverifikasi.<br>
                                                <small
                                                    style="color: grey;">{{ Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans() }}</small>
                                            </a>
                                        </li>
                                        @endif

                                        @endforeach

                                        @endif

                                        @if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN')
                                        @foreach (Auth::user()->unreadNotifications as $notif)
                                        @if ($notif->type == 'App\Notifications\verifPengadaan')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    Laporan Pengadaan<br>
                                                    <b>{{ $notif->data['keterangan'] }}</b><br>
                                                    @if ($notif->data['pesan'])
                                                    {{ $notif->data['pesan'] }}<br>
                                                    @endif
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @elseif ($notif->type == 'App\Notifications\verifPeminjamanBarang')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['kegiatan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    @if ($notif->data['verif_ktu'])
                                                    Laporan Peminjaman Barang<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b>telah diverifikasi KTU<br>
                                                    @else
                                                    Laporan Peminjaman Barang Baru<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b><br>
                                                    @endif
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @elseif ($notif->type == 'App\Notifications\verifPeminjamanRuang')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['kegiatan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    @if ($notif->data['verif_ktu'])
                                                    Laporan Peminjaman Ruang<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b>telah diverifikasi KTU<br>
                                                    @else
                                                    Laporan Peminjaman Ruang Baru<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b><br>
                                                    @endif
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif

                                        @if (Auth::user()->jabatan->jabatan == 'Wakil Dekan 2')
                                        @foreach (Auth::user()->unreadNotifications as $notif)
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="fa fa-exclamation-circle col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    Laporan Pengadaan Baru<br>
                                                    <b>{{ $notif->data['keterangan'] }}</b><br>
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif

                                        @if (Auth::user()->jabatan->jabatan == 'KTU')
                                        @foreach (Auth::user()->unreadNotifications as $notif)
                                        @if ($notif->type == 'App\Notifications\verifPeminjamanBarang')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    Laporan Peminjaman Barang Baru<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b><br>
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @elseif ($notif->type == 'App\Notifications\verifPeminjamanRuang')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    Laporan Peminjaman Ruang Baru<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b><br>
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif

                                        @if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa')
                                        @foreach (Auth::user()->unreadNotifications as $notif)
                                        @if ($notif->type == 'App\Notifications\verifPeminjamanBarang')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    Laporan Peminjaman Barang<br>
                                                    @if ($notif->data['verif_baper'])
                                                    <b>{{ $notif->data['kegiatan'] }}</b>telah disetujui Bagian Perlengkapan<br>
                                                    @elseif ($notif->data['verif_ktu'])
                                                    <b>{{ $notif->data['kegiatan'] }}</b>telah diverifikasi KTU<br>
                                                    @endif
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @elseif ($notif->type == 'App\Notifications\verifPeminjamanRuang')
                                        <li>
                                            <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
                                                <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
                                                <div class="col-xs-10">
                                                    Laporan Peminjaman Ruang<br>
                                                    <b>{{ $notif->data['kegiatan'] }}</b><br>
                                                    @if ($notif->data['verif_baper'])
                                                    Telah Disetujui Bagian Perlengkapan<br>
                                                    @elseif ($notif->data['verif_ktu'])
                                                    Telah Disetujui KTU<br>
                                                    @endif
                                                    <small
                                                        style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif --}}


                                        <!-- end notification -->
                                    </ul>
                                </li>

                                @if (count(Auth::user()->notifications) > 0)
                                <li class="footer"><a href="{{ route('notifikasi.index') }}">Lihat Semua</a></li>
                                @endif
                            </ul>
                        </li>

                        <!-- Tasks Menu (was Here)-->

                        <!-- User Account Menu -->

                        <li class="user-menu">
                            <a href="#" id="btn_logout" class="">Sign Out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel" style="padding-bottom: 40px">
                    {{-- <div class="pull-left image">
                      <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div> --}}
                    <div class="pull-left info" style="left: 0; width: 100%; white-space: initial; padding-left: 5px;">
                        <p style="text-align: center;">{{ Auth::user()->nama }}</p>
                        <!-- Status -->
                        {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
                    </div>
                </div>

                <!-- search form (Optional) -->
                {{-- <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="q" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                </form> --}}
                <!-- /.search form -->

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Main Menu</li>
                    <!-- Optionally, you can add icons to the links -->

                    <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
                    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                      </ul>
                    </li> -->

                    @yield('side_menu')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <!-- Page Header
                <small>Optional description</small> -->
                    @yield('judul_header')
                </h1>

                {{-- <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                    <li class="active">Here</li>
                </ol> --}}
                @yield('breadcrumb')
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                {{-- Anything you want --}}
            </div>
            <!-- Default to the left -->
            {{-- <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved. --}}
        </footer>

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Moment JS -->
    <script src="{{asset('/AdminLTE/bower_components/moment/moment.js')}}"></script>
    <!-- DataTables -->
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('/AdminLTE/bower_components/datatables.net/datetime-moment.js')}}"></script>
    <!--- mindmup-Editabletables -->
    <script src="/js/mindmup-editabletable.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
    <!-- page script -->
    <script type="text/javascript">
        $.fn.dataTable.moment('D MMMM Y', 'id');
        $('#table_data1').DataTable({
        })

        $('#btn_logout').click(function (event) {
            event.preventDefault();
            $('#logout-form').trigger('submit');
        });

        readAllNotif();
        function readAllNotif() {
        $('a#readAll').click(function(event) {
            event.preventDefault();
            console.log('baca semua');

            $.ajax({
              url: '{{ route('notifikasi.readAll') }}',
              type: 'GET',
              // dataType: '',
              // data: {},
            })
            .done(function(result) {
              console.log("success");
              console.log('hasil= '+result);

              $('#jml_notif').hide();
              $('a#readAll').hide();
              $('#list_notif').hide();
              $('span#header_notif').text('Tidak Ada Notifikasi Baru');
            })
            .fail(function(err, xml) {
              console.log("error");
              console.log(err);
              console.log(xml);
            });
          });
        }

        $(function(){
            function loadlink(){
                posisi = $('#list_notif').scrollTop();
                $('.dropdown.notifications-menu').load('{{ route("notifikasi.load") }}', function(){
                    $('#list_notif').scrollTop(posisi);
                });

            }

            loadlink();
            setInterval(function(){
                loadlink()
                readAllNotif();
            }, 3000);
        });

    </script>
    <script>
        $(document).on('ready change', function(){
            $('.angka').on('input', function(){
                $(this).val(this.value.replace(/[^0-9]/g,''));
            });

            $('.huruf').on('input', function(){
                $(this).val(this.value.replace(/[^a-zA-Z ]/g,''));
            });
            $('.anghrf').on('input', function(){
                $(this).val(this.value.replace(/[^a-zA-Z 0-9]/g,''));
            });
        });
    </script>

    @yield('script')

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>
