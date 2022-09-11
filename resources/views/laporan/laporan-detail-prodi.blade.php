<x-app-layout>
    <header class="navbar navbar-expand navbar-light bg-primary mb-3">
        <h5 class="text-white mx-3">Laporan</h5>
    </header>
    <div class="page-heading">
        <section class="section">
            <div class="card">

                <div class="card-body">
                    <form method="get" action="{{ route('cetak.detail.prodi')}}"
                        class="d-block d-md-flex justify-content-end">
                        @csrf()
                        @if(Auth()->user()->role === 'SuperAdmin')

                        <div class="w-25 d-md-block d-none me-2">
                            <select type="input" onchange="handleChange()" name="id_prodi"
                                class="id_prodi form-select w-100">
                                <option>-- Pilih Program Studi --</option>
                                @foreach ($program_studi as $item)
                                <option value="{{$item->id}}">{{$item->nama_prodi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-100 d-block mb-2 d-md-none me-2">
                            <select type="input" onchange="handleChange()" name="id_prodi"
                                class="id_prodi form-select w-100">
                                <option>-- Pilih Program Studi --</option>
                                @foreach ($program_studi as $item)
                                <option value="{{$item->id}}">{{$item->nama_prodi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center text-md-left">
                            <button class="btn btn-primary me-2">Cetak Prodi <i class="fa-solid fa-print"></i></button>
                            @endif
                            <a href="{{ route('cetak.detail.prodi')}}" target="_blank" class="btn btn-primary">Cetak <i
                                    class="fa-solid fa-print"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card-content">
                            <!-- table bordered -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="myTable">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Jumlah Pelanggaran</th>
                                        </tr>
                                    </thead>
                                    <tbody class="pelanggaran">
                                        @php
                                        $no=1
                                        @endphp
                                        @foreach ($pelanggaran as $item)
                                        <tr>
                                            <td class="text-center">{{ $no }}</td>
                                            <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>

                                            <td class="text-center">{{ $item->jumlah }}</td>

                                        </tr>
                                        @php
                                        $no++
                                        @endphp
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
                    url: `/laporan/detail-prodi?id=${id}`,
                    method: 'get',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data)
                        data.map((val, i) => {
                            $('.pelanggaran').html(`
                                <tr>
                                        <td class="text-center">${i+1 }</td>
                                        <td>${val.pelanggaran.nama_pelanggaran }</td>
                                        <td class="text-center">${val.jumlah }</td>
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