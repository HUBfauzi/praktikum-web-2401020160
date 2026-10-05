USE praktikum_web_2401020160;

-- 1. Insert minimal 2 program studi
INSERT INTO program_studi (nama_prodi) VALUES
('Teknik Informatika'),
('Sistem Informasi');

-- 2. Insert 4 mahasiswa (1 data sementara untuk dihapus)
INSERT INTO mahasiswa (nim, nama, email, usia, program_studi_id) VALUES
('2401020160', 'Muhammad Fauzi', 'fauzi@example.com', 20, 1),
('2401020161', 'Fikri Aditya', 'fikri@example.com', 21, 1),
('2401020162', 'Andrian Yuza Swanda', 'yuza@example.com', 20, 2),
('9999999999', 'Data Buangan', 'buang@example.com', 18, 2);

-- 3. Lakukan 1 UPDATE
UPDATE mahasiswa 
SET email = 'fauzi.update@example.com' 
WHERE nim = '2401020160';

-- 4. Lakukan 1 DELETE pada data sementara
DELETE FROM mahasiswa 
WHERE nim = '9999999999';

-- 5. Lakukan SELECT JOIN[cite: 16]
SELECT m.nim, m.nama, m.email, m.usia, p.nama_prodi
FROM mahasiswa AS m
JOIN program_studi AS p 
ON p.id = m.program_studi_id
ORDER BY m.nim;