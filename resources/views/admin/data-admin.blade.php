<x-app-layout>



    <header class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Data Admin</h5>
    </header>

    <div class="page-title">

    </div>


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
                                        <th>Nama Admin</th>
                                        <th>Program Studi</th>
                                        <th>E-mail / Username</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        {{-- <td>{{ $item->id_prodi }}</td> --}}
                                        <td>{{ $item->program_studi->nama_prodi }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td class="justify-content-center d-flex">
                                            <a class="btn btn-primary me-2" href="{{ route('admin.edit', $item->id) }}">
                                                <i class="bi bi-pen-fill"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.delete', $item->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'>
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            {{ $admin->appends(['search' => request()->query('search')])->links() }}
                        </div>
                    </div>


                </div>


            </div>


    </section>


    </script>
    <script>
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Apakah anda ingin menghapus data ini?",
                text: "Jika anda menghapus data ini, data akan dihapus permanent.",
                icon: "warning",
                type: "warning",
                buttons: ["Tidak", "Iya"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#8cd4f5',
                confirmButtonText: 'Hapus data!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>