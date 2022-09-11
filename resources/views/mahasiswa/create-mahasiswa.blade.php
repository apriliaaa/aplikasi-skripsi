<x-app-layout>
    <header class="navbar navbar-expand navbar-light bg-primary mb-3">
        <h5 class="text-white mx-3">Mahasiswa</h5>
    </header>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <section class="section">
        <form action="{{ route('mahasiswa.save') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Pelanggaran Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <x-jet-validation-errors class="alert alert-danger" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">NIM</label>
                                <input type="text" onkeyup="getData()" name="nim" class="form-control" id="nim"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Nama Mahasiswa</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Dosen Penanggungjawab</label>
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                <input type="text" name="nama_dosen" class="form-control" id="basicInput" placeholder=""
                                    value="{{ Auth::user()->name }}" disabled readonly>
                                <input type="hidden" name="id_prodi" value="{{ Auth::user()->id_prodi }}">
                            </div>
                        </div>
                        <div class="col-md-6">

                            @if (auth()->user()->role === "SuperAdmin")
                            <div class="form-group">
                                <label for="programStudi">Program Studi</label>
                                <select class="form-select" id="id_prodi" name="id_prodi">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($program_studi as $prodi)

                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>

                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="programStudi">Jenis Pelanggaran</label>
                                <select class="form-select" id="id_pelanggaran" name="id_pelanggaran">
                                    <option value="">Pilih Jenis Pelanggaran</option>
                                    @foreach ($pelanggaran as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama_pelanggaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="programStudi">Item Disita</label>
                                <select class="form-select" id="id_item" name="id_item">
                                    <option value="">Pilih item disita</option>
                                    @foreach ($item as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" id="foto" name="foto" value="" />
                        </div>

                        <div class="row gx-0">
                            <video class="d-none col-md-6 col-11 mx-auto" onclick="snapshot(this);" id="video"
                                autoplay></video>
                        </div>

                        <p class="d-none text-center" id="ss">Hasil Gambar :
                            <p>
                                <canvas class="d-none mx-auto" id="myCanvas" width="400" height="300"></canvas>
                                <div class="col-12 text-center">
                                    <button type="button" class=" btn btn-success d-none" id="buttonSnap"
                                        onclick="snapshot()">Ambil Gambar</button>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary  mb-1 me-2"
                                        onclick="startWebcam()">Buka
                                        Kamera</button>
                                    <button type="submit" class="btn btn-success mb-1">Save</button>
                                </div>
                    </div>
                </div>
        </form>
    </section>


    <script>
        let video;
        let webcamStream;

        function startWebcam() {
            document.getElementById('video').classList.remove('d-none')
            document.getElementById('video').classList.add('d-block')

            document.getElementById('buttonSnap').classList.add('d-md-inline')

            if (navigator.getUserMedia) {
                navigator.getUserMedia(
                    // constraints
                    {
                        video: {
                            facingMode: 'environment'
                        },
                        audio: false
                    },
                    // successCallback
                    function (localMediaStream) {
                        video = document.querySelector('video');
                        video.srcObject = localMediaStream;
                        webcamStream = localMediaStream;
                    },
                    // errorCallback
                    function (err) {
                        console.log("The following error occured: " + err);
                    }
                );
            } else {
                console.log("getUserMedia not supported");
            }
        }

        function stopWebcam() {
            webcamStream.stop();
        }
        //---------------------
        // TAKE A SNAPSHOT CODE
        //---------------------
        let canvas, ctx;

        function init() {
            // Get the canvas and obtain a context for
            // drawing in it
            canvas = document.getElementById("myCanvas");
            ctx = canvas.getContext('2d');
        }

        function snapshot() {
            document.getElementById('myCanvas').classList.remove('d-none')
            document.getElementById('myCanvas').classList.add('d-block')
            document.getElementById('ss').classList.remove('d-none')
            document.getElementById('ss').classList.add('d-block')
            init()

            // Draws current image from the video element into the canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            sendData()
        }

        function sendData() {
            const dataUrl = canvas.toDataURL()
            document.getElementById('foto').value = dataUrl;
        }

        const getData = () => {
            const nim = $("#nim").val();
            $.ajax({
                type: "GET",
                url: '/mahasiswa/exist',
                data: {
                    nim: nim
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if (response) {
                        $('#name').val(`${response.name}`).prop('readonly', true)
                        $('#id_prodi').val(`${response.id_prodi}`).prop('disabled', true)
                    } else {
                        $('#name').val("").prop('readonly', false)
                        $('#id_prodi').val("").prop('disabled', false)
                    }

                }
            });
        }
    </script>
</x-app-layout>