<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

// Route untuk menampilkan form (GET)
Route::get('/form-mahasiswa', function () {
    return view('form-mahasiswa');
});

// Route untuk memproses form (POST)
Route::post('/form-mahasiswa', function (Request $request) {
    // 1. Sanitasi Data (Membersihkan spasi dan tag HTML)
    $dataBersih = [
        'nama' => strip_tags(trim((string) $request->input('nama'))),
        'email' => filter_var((string) $request->input('email'), FILTER_SANITIZE_EMAIL),
        'usia' => trim((string) $request->input('usia')),
        'nim' => trim((string) $request->input('nim')), // Menghapus spasi awal/akhir NIM
    ];

    // 2. Validasi Server-side
    $validator = Validator::make($dataBersih, [
        'nama' => ['required', 'min:3', 'max:50'],
        'email' => ['required', 'email'],
        'usia' => ['required', 'integer', 'min:17', 'max:60'],
        'nim' => ['required', 'digits_between:8,12'], // NIM wajib 8-12 digit angka
    ], [
        'nama.required' => 'Nama wajib diisi.',
        'nama.min' => 'Nama minimal 3 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'usia.required' => 'Usia wajib diisi.',
        'usia.integer' => 'Usia harus berupa angka.',
        'usia.min' => 'Usia minimal 17 tahun.',
        'usia.max' => 'Usia maksimal 60 tahun.',
        'nim.required' => 'NIM wajib diisi.',
        'nim.digits_between' => 'NIM harus berupa angka dengan panjang 8 hingga 12 digit.',
    ]);

    // 3. Penanganan Error
    if ($validator->fails()) {
        return redirect('/form-mahasiswa')
            ->withErrors($validator)
            ->withInput();
    }

    // 4. Lolos Validasi
    $data = $validator->validated();
    $data['usia'] = (int) $data['usia'];
    
    return view('hasil-form', ['data' => $data]);
});