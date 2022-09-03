<x-guest-layout>
    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    <div class="col-md-5 col-11">
        <form method="POST" action="{{ route('login') }}">
            @csrf()


            <div class="card ">
                <div class="card-body p-4">
                    <div class="text-center w-75 mx-auto">
                        <div class="p-2 border border-5 rounded-circle logo mx-auto overflow-hidden w-25 h-25 mb-4">
                            <img class="w-100" src="/image/logo_unpam.png" alt="">
                        </div>
                    </div>
                    <x-jet-validation-errors class="alert alert-danger" />
                    <main class="form-signin ">

                        <form>
                            <div class="form-floating mb-3">
                                <input class="form-control border" id="floatingInput" placeholder="E-mail" type="email"
                                    name="email" :value="old('email')" autofocus>
                                <label for="floatingInput"><i class="bi bi-envelope-fill pe-2"></i> E-mail</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control border" id="floatingPassword"
                                    placeholder="Password" name="password" autocomplete="current-password">
                                <label for="floatingPassword"><i class="bi bi-key-fill pe-2"></i> Password</label>
                            </div>

                            <button class="w-100 btn btn-lg btn-primary mt-4 fw-bolder" type="submit">Login</button>
                        </form>
                    </main>
                </div>
            </div>

        </form>
    </div>
</x-guest-layout>