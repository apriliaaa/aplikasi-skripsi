<x-app-layout>

    <header class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Laporan</h5>

    </header>

    <div class="page-title">
        {{-- <div class="row">
                     <div class="col-12 col-md-6 order-md-1 order-last">
                         <h3>Layout Dezfault</h3>
                     </div>
                     <div class="col-12 col-md-6 order-md-2 order-first">
                         <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                             <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">Layout Default</li>
                             </ol>
                         </nav>
                     </div>
                 </div> --}}
    </div>
    <section class="section">
        <div class="card">

            <div class="card-body">

                <form method="post" action="{{ route('cetak.mahasiswa.prodi')}}" class="d-block d-md-flex justify-content-end">
                    @csrf()
                    @if(Auth()->user()->role === 'SuperAdmin')

                    <div class="w-25 d-none d-md-block me-2">
                        <select type="input" onchange="handleChange()" name="id_prodi" class="id_prodi form-select  w-100">
                            <option>-- Pilih Program Studi --</option>
                            @foreach ($prodi as $item)
                            <option value="{{$item->id}}">{{$item->nama_prodi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 d-md-none d-block mb-2 me-2">
                        <select type="input" onchange="handleChange()" name="id_prodi" class="id_prodi form-select  w-100">
                            <option>-- Pilih Program Studi --</option>
                            @foreach ($prodi as $item)
                            <option value="{{$item->id}}">{{$item->nama_prodi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center text-md-left">
                        <button class="btn btn-primary me-2">Cetak Prodi <i class="fa-solid fa-print"></i></button>
                        @endif
                        @if(count($mahasiswa) > 0)
                        <a href="{{ route('cetak.mahasiswa', [$mahasiswa[0]->mahasiswa->program_studi->nama_prodi]) }}" target="_blank" class="btn btn-primary">Cetak <i class="fa-solid fa-print"></i></a>
                        @endif
                    </div>
                    
                </form>

            </div>

        </div>
    </section>

    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card p-4">

                    <div class="card-content ">

                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NIM</th>
                                        <th>Program Studi</th>
                                        <th>Jumlah Pelanggaran</th>
                                    </tr>
                                </thead>
                                <tbody class="pelanggaran">
                                    @foreach ($mahasiswa as $item)
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

                        </div>
                    </div>


                </div>


            </div>


    </section>

    <script>
        const handleChange = () => {
            const id = $('.id_prodi').val()

            $.ajax({
                url: `/laporan/mahasiswa?id=${id}`,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    data.map((val, i) => {
                        $('.pelanggaran').html(`
                            <tr>
                                <td class="text-center">${i+1}</td>
                                <td>${val.mahasiswa.name}</td>
                                <td>${val.mahasiswa.nim}</td>
                                <td>${val.mahasiswa.program_studi.nama_prodi}</td>
                                <td>${val.total}</td>
                            </tr>

                        `)

                    })

                    if (data.length < 1) {
                        $('.pelanggaran').html('')

                    }

                }
            })
        }
    </script>

</x-app-layout>