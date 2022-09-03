<table class="table table-bordered mb-0" id="myTable">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Program Studi</th>
            <th>Jumlah Pelanggaran</th>
        </tr>
    </thead>
    <tbody>

        {{-- {{ dd($program_studi) }} --}}
        @foreach ($program_studi as $item)

        {{-- {{ $item->mahasiswa }} --}}


        <tr>
            {{-- {{ dd($item) }} --}}
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->program_studi->nama_prodi }}</td>
            <td class="text-center">{{ $item->total }}</td>
            {{-- <td>{{ $item->program_studi->nama_prodi }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->role }}</td>
            <td class="text-center">
                <a class="btn btn-primary" href="{{ route('admin.edit', $item->id) }}">
                    <i class="fa-solid fa-file-pen"></i>
                </a>
                <a class="btn btn-danger" href="{{ route('admin.delete', $item->id) }}">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td> --}}
        </tr>

        @endforeach

    </tbody>
</table>