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
            <td class="text-center">{{ $item->jumlah }}</td>
        </tr>
        @php
        $no++
        @endphp
        @endforeach

    </tbody>
</table>