<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Pemantauan') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ url('assets/vendors/apexcharts/apexcharts.css') }}">

    <script src="{{ url('https://kit.fontawesome.com/ed1a4885d0.js') }}" crossorigin="anonymous"></script>

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    
    {{ $slot }}
    @stack('modals')

    @livewireScripts

    <script src="{{ url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('assets/js/mazer.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}

    <script src="{{ url('assets/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ url('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ url('assets/js/pages/ui-apexchart.js') }}"></script>



    @include('sweetalert::alert')
</body>

</html>