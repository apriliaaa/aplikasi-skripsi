<x-app-layout>
    <header class="navbar navbar-expand navbar-light bg-primary mb-3">
        <h5 class="text-white mx-3">Laporan</h5>
    </header>

    <section class="section">
        <div class="card">
            <div class="card-body d-flex justify-content-end">
                <a href="{{route('cetak.prodi')}}" target="_blank" class="btn btn-primary">Cetak 
                    <i class="fa-solid fa-print"></i></a>
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
                                        <th>Program Studi</th>
                                        <th>Jumlah Pelanggaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ dd($program_studi) }} --}}
                                    @foreach ($program_studi as $item)
                                    {{-- {{ $item->mahasiswa }} --}}
                                    <tr>
                                        {{-- {{ dd($item) }} --}}
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->program_studi->nama_prodi }}</td>
                                        <td class="text-center">{{ $item->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>