<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    {{-- Menampilkan status filter NIM jika ada --}}
    @if ($nim)
        <p>Filter NIM: {{ $nim }}</p>
    @else
        <p>Menampilkan semua data.</p>
    @endif

    {{-- Tabel HTML sederhana tanpa CSS --}}
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Usia</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Perulangan data mahasiswa dari Controller/Route --}}
            @forelse ($daftarMahasiswa as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa['nim'] }}</td>
                    <td>{{ $mahasiswa['nama'] }}</td>
                    <td>{{ $mahasiswa['email'] }}</td>
                    <td>{{ $mahasiswa['usia'] }}</td>
                    <td>{{ $mahasiswa['nama_prodi'] }}</td>
                </tr>
            @empty
                {{-- Tampilan jika data kosong / NIM tidak ditemukan --}}
                <tr>
                    <td colspan="5">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tautan untuk kembali menampilkan seluruh data --}}
    @if ($nim)
        <p><a href="{{ url('/mahasiswa') }}">Tampilkan semua data</a></p>
    @endif
</body>
</html>