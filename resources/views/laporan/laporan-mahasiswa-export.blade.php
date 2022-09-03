<table class="table table-bordered mb-0">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Program Studi</th>
            <th>Jumlah Pelanggaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswa as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->mahasiswa->name }}</td>
            <td>{{ $item->mahasiswa->nim }}</td>
            <td>{{ $item->mahasiswa->program_studi->nama_prodi }}</td>
            <td>{{ $item->total }}</td>

            @endforeach

    </tbody>
</table>