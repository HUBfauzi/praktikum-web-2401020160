<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Tambahkan kode di bawah ini untuk Pertemuan 2
Route::get('/latihan-php', function () {
    // 1. Variabel nama dan array dengan 5 nilai angka
    $nama = 'Muhammad Fauzi';
    $nilai = [60, 65, 55, 70, 50]; // Rata-rata 83.6 (Lulus)

    // 2. Fungsi anonim untuk menghitung rata-rata
    $hitungRataRata = function (array $data): float {
        $total = 0;
        foreach ($data as $angka) {
            $total += $angka;
        }
        return $total / count($data);
    };

    // 3. Memanggil fungsi dan menyimpan hasil
    $rataRata = $hitungRataRata($nilai);

    // 4. Struktur kontrol (Percabangan)
    if ($rataRata >= 75) {
        $status = 'Lulus';
    } else {
        $status = 'Perlu Perbaikan';
    }

    // 5. Mengirim data ke view
    return view('latihan-php', compact('nama', 'nilai', 'rataRata', 'status'));
});