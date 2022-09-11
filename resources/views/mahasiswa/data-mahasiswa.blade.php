<x-app-layout>
    <header class="navbar navbar-expand navbar-light bg-primary mb-3">
        <h5 class="text-white mx-3">Data pelanggaran Mahasiswa</h5>
    </header>

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
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Foto</th>
                                        <th>Jenis Pelanggaran</th>
                                        <th>Item Disita</th>
                                        <th>Dosen Penyita</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftar_pelanggaran as $list)
                                    <tr>
                                        <td>{{ $list->mahasiswa->nim }}</td>
                                        <td>{{ $list->mahasiswa->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$list->foto) }}" alt=""
                                                style="height: 100px; width: 150px;">
                                        </td>
                                        <td>{{ $list->pelanggaran->nama_pelanggaran }}</td>
                                        <td>{{ $list->item->nama_item }}</td>
                                        <td>{{ $list->user->name }}</td>
                                        <td class="text-center">
                                            <form action="{{route('mahasiswa.dataDelete', [$list->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger show-alert-delete-box">
                                                    &#10006
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Yakin ni mau balikin barang sitaannya?",
                text: "Pastiin dulu si bangsat ini ga ngulangin pelanggarannya.",
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