<x-app-layout>


    <header class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Laporan</h5>

    </header>

    <div class="page-title">

    </div>
    <section class="section">
        <div class="card">
            {{-- <div class="card-header">
                        <h4 class="card-title">Create Admin</h4>
                    </div> --}}
            <div class="card-body d-flex justify-content-end">

                <a href="{{route('cetak.prodi')}}" target="_blank" class="btn btn-primary">Cetak <i class="fa-solid fa-print"></i></a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card p-4">
                    {{-- <div class="card-header">
                                {{ $admin->links() }}
                </div> --}}
                <div class="card-content">
                    {{-- <div class="card-body">
                                    <p class="card-text">Add <code>.table-bordered</code> for borders on all sides of the table
                                        and
                                        cells. For
                                        Inverse Dark Table, add <code>.table-dark</code> along with
                                        <code>.table-bordered</code>.
                                    </p>
                                </div> --}}
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
                                    {{-- <td>{{ $item->program_studi->nama_prodi }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{ route('admin.edit', $item->id) }}">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                        <a class="btn btn-danger" href="{{ route('admin.delete', $item->id) }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td> --}}
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