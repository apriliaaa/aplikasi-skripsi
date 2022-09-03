<x-app-layout>


    <header class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Tambah Data Admin</h5>
    </header>


    <div class="page-title">

    </div>


    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <section class="section">
        <form action="{{ route('admin.save') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Admin</h4>
                </div>
                <div class="card-body">

                    <x-jet-validation-errors class="alert alert-danger" />

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="programStudi">Program Studi</label>
                                <select class="form-select" id="id_prodi" name="id_prodi">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($program_studi as $key=>$item)
                                    <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="role" value="Admin">

                            <div class="form-group">
                                <label for="basicInput">Nama Admin</label>
                                <input type="text" name="name" class="form-control" id="basicInput" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">E-mail</label>
                                <small class="text-muted">eg.<i>someone@example.com</i></small>
                                <input type="e-mail" name="email" class="form-control" id="basicInput" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <input type="text" name="password" class="form-control" id="basicInput" placeholder="">
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>




</x-app-layout>