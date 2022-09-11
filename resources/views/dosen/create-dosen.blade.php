<x-app-layout>

    <header class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Data Dosen</h5>
    </header>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <section class="section">
        <form action="{{ route('dosen.save') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Dosen</h4>
                </div>
                <div class="card-body">

                    <x-jet-validation-errors class="alert alert-danger" />

                    <div class="row">
                        <div class="col-md-6">
                            @if(auth()->user()->role === "Admin")
                            <div class="form-group">
                                <label for="programStudi">Program Studi</label>
                                {{-- <input type="text" name="id_prodi" value="{{ Auth::user()->id_prodi }}"> --}}
                                <select class="form-select" name="id_prodi" id="id_prodi" disabled>
                                    <option value="{{ auth()->user()->id_prodi }}">
                                        {{ Auth::user()->program_studi->nama_prodi }}</option>
                                </select>
                            </div>
                            @endif

                            @if(auth()->user()->role === "SuperAdmin")
                            <div class="form-group">
                                <label for="programStudi">Program Studi</label>
                                <select class="form-select" id="id_prodi" name="id_prodi">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($program_studi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <input type="hidden" name="role" value="Dosen">

                            <div class="form-group">
                                <label for="basicInput">Nama Dosen</label>
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
        </form>
    </section>

</x-app-layout>