<x-app-layout>

    <header class="navbar navbar-expand navbar-light bg-primary mb-3">


        <h5 class="text-white mx-3">Edit Data Admin</h5>

    </header>


    <div class="page-title">

    </div>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <section class="section">

        <form action="{{ route('admin.update', $admin->id) }}" method="post">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Admin</h4>
                </div>
                <div class="card-body">

                    <x-jet-validation-errors class="alert alert-danger" />

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="programStudi">Program Studi</label>
                                <select disabled class="form-select" id="id_prodi" name="id_prodi">
                                    <option disabled value>Pilih Program Studi</option>
                                    <option value="{{ $admin->id_prodi }}">{{ $admin->program_studi->nama_prodi }}</option>

                                    @foreach ($program_studi as $key=>$item)
                                    <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Nama Admin</label>
                                <input disabled type="text" name="name" class="form-control" id="basicInput" placeholder="" value="{{ $admin->name }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">E-mail</label>
                                <small class="text-muted">eg.<i>someone@example.com</i></small>
                                <input disabled type="e-mail" name="email" class="form-control" id="basicInput" placeholder="" value="{{ $admin->email }}">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Role</label>
                                <select name="role" class="form-select" id="id_prodi">
                                    <option value>Pilih Jabatan</option>
                                    @if($admin->role === "Admin")
                                    <option selected value="Admin">Admin</option>
                                    @else
                                    <option value="Admin">Admin</option>
                                    @endif

                                    @if($admin->role === "Dosen")
                                    <option selected value="Dosen">Dosen</option>
                                    @else
                                    <option value="Dosen">Dosen</option>
                                    @endif
                                </select>
                            </div>


                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </section>




</x-app-layout>