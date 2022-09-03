<table class="table table-bordered mb-0" id="myTable">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Jenis Pelanggaran</th>
            <th>Jumlah Pelanggaran</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no=1
        @endphp
        @foreach ($pelanggaran as $item)
        <tr>
            <td class="text-center">{{ $no }}</td>
            <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
            {{-- masih belum bisa --}}
            <td class="text-center">{{ $item->jumlah }}</td>
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
        @php
        $no++
        @endphp
        @endforeach

    </tbody>
</table>