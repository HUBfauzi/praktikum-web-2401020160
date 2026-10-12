<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// 1. Pengalihan rute utama (/) langsung ke /mahasiswa agar tidak eror 404
Route::redirect('/', '/mahasiswa');

// 2. Rute utama /mahasiswa dengan parameter NIM opsional ({nim?})
Route::get('/mahasiswa/{nim?}', function (?string $nim = null) {
    try {
        // Mengambil objek PDO dari koneksi aktif Laravel
        $pdo = DB::connection()->getPdo();

        // Menyusun kueri SQL dasar (JOIN tabel mahasiswa dan program_studi)
        $sql = 'SELECT m.nim, m.nama, m.email, m.usia, p.nama_prodi
                FROM mahasiswa AS m
                JOIN program_studi AS p
                ON p.id = m.program_studi_id';

        // Jika parameter NIM diberikan pada URL, tambahkan kondisi WHERE
        if ($nim !== null) {
            $sql .= ' WHERE m.nim = :nim';
        }

        $sql .= ' ORDER BY m.nim';

        // Eksekusi kueri dengan Prepared Statement untuk keamanan SQL Injection
        $statement = $pdo->prepare($sql);
        $statement->execute($nim !== null ? ['nim' => $nim] : []);

        // Mengambil hasil kueri sebagai array asosiatif
        $daftarMahasiswa = $statement->fetchAll(\PDO::FETCH_ASSOC);

        // Mengirimkan data ke view mahasiswa.blade.php
        return view('mahasiswa', compact('daftarMahasiswa', 'nim'));

    } catch (\Throwable $error) {
        // Catat rincian galat ke log internal Laravel (storage/logs/laravel.log)
        report($error);

        // Tampilkan respon aman berkode status HTTP 500 bagi pengguna
        return response(
            'Koneksi atau query basis data gagal. Periksa file .env dan layanan MySQL.',
            500
        );
    }
});