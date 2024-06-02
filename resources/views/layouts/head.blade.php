<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Velora</title>
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">

    {{-- Owl Carousels --}}
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    {{-- New Input File --}}
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    {{-- Data Table --}}

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    {{-- End Data Table --}}
    <link rel="shortcut icon" href="{{ asset('assets//logo/AVASA2_COL.png') }}" type="image/x-icon">

    {{-- Toast --}}
    <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
         @include('layouts.nav')
          @include('layouts.sidebar')

          @yield('content')
          @include('layouts.footer')
        </div>
    </div>
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>


    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-slider.js') }}"></script>

    {{-- Modal --}}
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>

    {{-- Toast  --}}
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>


    <script src="{{ asset('assets/js/page/index.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- Input File --}}
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

</body>

</html>
