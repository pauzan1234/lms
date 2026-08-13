<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LecturerImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows): void
    {
        DB::transaction(function () use ($rows) {

            foreach ($rows as $row) {

                $programStudi = $this->normalisasiProgramStudi(
                    $row['program_studi']
                );

                $user = User::create([
                    'name' => trim($row['nama']),
                    'email' => trim($row['email']),
                    'password' => Hash::make((string) $row['nidn']),
                    'role' => 'lecturer',
                ]);

                Lecturer::create([
                    'user_id' => $user->id,
                    'nidn' => (string) $row['nidn'],
                    'study_program' => $programStudi,
                    'phone' => !empty($row['phone'])
                        ? (string) $row['phone']
                        : null,
                ]);
            }
        });
    }

    private function normalisasiProgramStudi($programStudi): string
    {
        $programStudi = strtolower(trim($programStudi));

        return match ($programStudi) {

            'teknik komputer' => 'Teknik Komputer',

            'teknik sipil' => 'Teknik Sipil',

            'teknik lingkungan' => 'Teknik Lingkungan',

            default => throw new \Exception(
                'Program studi tidak valid: ' . $programStudi
            ),
        };
    }

    public function rules(): array
    {
        return [

            'nidn' => [
                'required',
                'numeric',
                'digits_between:1,20',
                'unique:lecturer,nidn',
            ],

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'program_studi' => [
                'required',
                'string',
            ],

            'phone' => [
                'nullable',
                'numeric',
                'digits_between:1,20',
            ],
        ];
    }

    public function customValidationMessages(): array
    {
        return [

            'nidn.required' =>
            'NIDN wajib diisi.',

            'nidn.numeric' =>
            'NIDN hanya boleh berisi angka.',

            'nidn.digits_between' =>
            'NIDN harus terdiri dari 1 sampai 20 digit.',

            'nidn.unique' =>
            'NIDN sudah terdaftar.',

            'nama.required' =>
            'Nama dosen wajib diisi.',

            'email.required' =>
            'Email wajib diisi.',

            'email.email' =>
            'Format email tidak valid.',

            'email.unique' =>
            'Email sudah digunakan.',

            'program_studi.required' =>
            'Program studi wajib diisi.',
        ];
    }
}
