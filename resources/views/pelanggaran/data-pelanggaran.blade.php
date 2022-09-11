<x-app-layout>
    <header class="navbar navbar-expand navbar-light bg-primary mb-3">
        <h5 class="text-white mx-3">Daftar Pelanggaran</h5>
    </header>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Tambah Data</h6>
            </div>
            <div class="card-body">
                <x-jet-validation-errors class="alert alert-danger" />
                <form action="{{ route('pelanggaran.create') }}" method="POST">
                    @csrf
                    <div class="row g-2 d-flex ">

                        <div class="col-sm-6 ">
                            <label for="" class="visually-hidden">Nama Pelanggaran</label>
                            <input type="text" name="nama_pelanggaran" class="form-control" placeholder="Masukkan jenis pelanggaran">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Save</button>
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
                            <table id="myTable" class="table table-bordered mb-0">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pelanggaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggaran as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_pelanggaran }}</td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('pelanggaran.delete', $item->id) }}">
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
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
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