<x-app-layout>

    <header class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Edit Profil</h5>

    </header>



    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <section class="section">
        <x-jet-validation-errors class="alert alert-danger" />
        <form action="{{ route('update.user.info') }}" method="POST">
            @method('PUT')
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Informasi Profil</h4>
                </div>
                <div class="card-body">



                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="basicInput">Nama</label>
                                <input type="text" name="name" value="{{Auth()->user()->name}}" class="form-control" id="basicInput" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">E-mail</label>
                                <small class="text-muted">eg.<i>someone@example.com</i></small>
                                <input type="e-mail" name="email" value="{{Auth()->user()->email}}" class="form-control" id="basicInput" placeholder="">
                            </div>
                            <div class="col-sm-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-success me-1 mb-1">Ubah</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </form>
        <form action="{{ route('update.user.auth') }}" method="post">
            @method('put')
            @csrf()
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Informasi Autentikasi</h4>
                </div>
                <div class="card-body">



                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="basicInput">Password Lama</label>
                                <input type="text" name="current_pass" class="form-control" id="basicInput" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password Baru</label>
                                <input type="text" name="new_pass" class="form-control" id="basicInput" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Konfirmasi Password Baru</label>
                                <input type="text" name="confirm_pass" class="form-control" id="basicInput" placeholder="">
                            </div>
                            <div class="col-sm-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-success me-1 mb-1">Ubah</button>
                            </div>
                        </div>

                    </div>

                </div>

        </form>
    </section>

</x-app-layout>