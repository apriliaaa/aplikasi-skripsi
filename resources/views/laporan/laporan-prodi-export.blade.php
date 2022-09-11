<table class="table table-bordered mb-0" id="myTable">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Program Studi</th>
            <th>Jumlah Pelanggaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($program_studi as $item)

        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->program_studi->nama_prodi }}</td>
            <td class="text-center">{{ $item->total }}</td>
        </tr>

        @endforeach

    </tbody>
</table>