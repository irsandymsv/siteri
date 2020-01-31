@extends('layouts.template')

@section('side_menu')
   @if (Auth::user()->jabatan->jabatan == "Dekan")
      @include('include.dekan_menu')
   @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 1")
   @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 2")
      @include('include.wadek2_menu')
   @elseif(Auth::user()->jabatan->jabatan == "Dosen")
      @include('include.dosen_menu')
   @endif
@endsection