@extends('adminlte::master')

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', 'hold-transition sidebar-mini layout-fixed')

@section('body')
<div class="wrapper">
    @include('admin.layouts.partials.navbar')
    @include('admin.layouts.partials.sidebar')
    
    <div class="content-wrapper">
        @include('admin.layouts.partials.content-header')
        <?php //die("Hello12"); ?>
            
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        
        <!-- @include('admin.layouts.partials.footer')
        @include('admin.layouts.partials.control-sidebar') -->
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop