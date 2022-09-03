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

   

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-white">
    <table class="table">
        <tr class="text-center">
            <td>
                <img style="height: 100px" src="/image/sasmita-jaya.jpg" alt="">
            </td>
            <td>
                <h6>YAYASAN SASMITA JAYA</h6>
                <h4>UNIVERSITAS PAMULANG</h4>
                <h5>FAKULTAS TEKNIK</h5>
                Jl. Surya Kencana No.1 Pamulang, Telp/Fax. (021) 7412566
            </td>
            <td>
                <img style="height: 100px" src="/image/logo_unpam.png" alt="">
            </td>
        </tr>
    </table>
   
    <table class="table table-bordered mb-0">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Jumlah Pelanggaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cetakMhs as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->name }}</td>
                    <td>{{ $item->mahasiswa->nim }}</td>
                    <td>{{ $item->mahasiswa->program_studi->nama_prodi }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
                
            @endforeach

        </tbody>
    </table>
    
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>