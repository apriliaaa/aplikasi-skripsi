<x-app-layout>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
     </div>
     <div id="main">
        <header class="navbar navbar-expand navbar-light bg-primary mb-3">
            {{-- <div class="navbar navbar-light bg-primary"> --}}
                <a href="#" class="burger-btn d-block d-xl-none text-white">
                    <i class="bi bi-justify fs-3"></i>
                </a>
                
                <h6 class="text-white mx-3">Data Dosen</h6>
            {{-- </div> --}}
        </header>

         <div class="page-heading">
             {{-- <div class="page-title">
             </div> --}}

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
                                   <div class="form-group">
                                       <label for="programStudi">Program Studi</label>
                                       <input type="text" name="id_prodi" value="{{ Auth::user()->id_prodi }}">
                                       {{-- <select class="form-select" id="id_prodi" name="id_prodi">
                                           <option value="">Pilih Program Studi</option>
                                           @foreach ($program_studi as $item)
                                               <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                           @endforeach
                                       </select> --}}
                                   </div>
   
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
                    </div>
                
                </form>
             </section>
         </div>
</x-app-layout>