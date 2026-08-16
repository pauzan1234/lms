<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        DB::transaction(function () use ($rows) {

            foreach ($rows as $index => $row) {

                // Abaikan baris yang benar-benar kosong
                if (
                    empty($row['nim']) &&
                    empty($row['nama']) &&
                    empty($row['email']) &&
                    empty($row['program_studi']) &&
                    empty($row['semester']) &&
                    empty($row['phone'])
                ) {
                    continue;
                }

                /*
                 * Validasi NIM
                 */
                if (empty($row['nim'])) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) . ': NIM wajib diisi.'
                    );
                }

                if (!is_numeric($row['nim'])) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) . ': NIM harus berupa angka.'
                    );
                }

                /*
                 * Validasi nama
                 */
                if (empty($row['nama'])) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) . ': Nama mahasiswa wajib diisi.'
                    );
                }

                /*
                 * Validasi email
                 */
                if (empty($row['email'])) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) . ': Email wajib diisi.'
                    );
                }

                if (!filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) . ': Format email tidak valid.'
                    );
                }

                /*
                 * Cek NIM sudah ada
                 */
                if (Student::where('nim', (string) $row['nim'])->exists()) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) .
                            ': NIM "' . $row['nim'] . '" sudah terdaftar.'
                    );
                }

                /*
                 * Cek email sudah ada
                 */
                if (User::where('email', trim($row['email']))->exists()) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) .
                            ': Email "' . $row['email'] . '" sudah digunakan.'
                    );
                }

                /*
                 * Cari program studi
                 */
                $prodi = Prodi::whereRaw(
                    'LOWER(TRIM(nama_prodi)) = ?',
                    [strtolower(trim($row['program_studi']))]
                )->first();

                if (!$prodi) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) .
                            ': Program studi "' .
                            $row['program_studi'] .
                            '" tidak ditemukan di database.'
                    );
                }

                /*
                 * Validasi semester
                 */
                if (
                    !is_numeric($row['semester']) ||
                    (int) $row['semester'] < 1 ||
                    (int) $row['semester'] > 14
                ) {
                    throw new \Exception(
                        'Baris ' . ($index + 2) .
                            ': Semester harus berupa angka 1 sampai 14.'
                    );
                }

                /*
                 * Buat akun user
                 */
                $user = User::create([
                    'name' => trim($row['nama']),
                    'email' => trim($row['email']),
                    'password' => Hash::make((string) $row['nim']),
                    'role' => 'student',
                ]);

                /*
                 * Buat data mahasiswa
                 */
                Student::create([
                    'user_id' => $user->id,
                    'nim' => (string) $row['nim'],
                    'prodi_id' => $prodi->id,
                    'semester' => (int) $row['semester'],
                    'phone' => !empty($row['phone'])
                        ? (string) $row['phone']
                        : null,
                ]);
            }
        });
    }
}
