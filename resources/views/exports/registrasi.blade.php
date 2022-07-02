<table>
    <thead>
        <tr>
        <th>No</th>
        <th>Tanggal Meninggal</th>
        <th>Nama Ahli Waris</th>
        <th>Alamat Aspirasi</th>
        <th>Nama Meninggal</th>
        <th>Tempat Meninggal</th>
        <th>NIK</th>
        <th>Nama TPU</th>
        <th>Nomor Blok TPU</th>
        <th>Retribusi</th>
        <th>Ambulance</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($data as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{$item->tanggal_meninggal}}</td>
            <td>{{$item->ahliwaris->nama_ahliwaris}}</td>
            <td>{{$item->ahliwaris->alamat_ahliwaris}}</td>
            <td>{{$item->nama_meninggal}}</td>
            <td>{{$item->tempat_meninggal}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->kode_makam}}</td>
            <td>{{$item->blok_makam}}</td>
            <td>{{$item->retribusi}}</td>
            <td>{{$item->ambulance}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
