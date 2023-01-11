<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.adminlte_head')
<!--
`body` tag options:
  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('partials.adminlte_navbar')
  @include('partials.adminlte_sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('partials.adminlte_pageheader')
    <!-- Main content -->
      @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  @include('partials.adminlte_footer')
</div>
<!-- ./wrapper -->
@include('partials.adminlte_scripts')
</body>
</html>