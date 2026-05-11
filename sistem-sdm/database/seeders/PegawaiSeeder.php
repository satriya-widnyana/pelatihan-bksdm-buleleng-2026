<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Unit Kerja
        $units = [
            ['nama_unit' => 'Fakultas Teknik'],
            ['nama_unit' => 'Fakultas Ekonomi'],
            ['nama_unit' => 'Biro Kepegawaian'],
        ];

        foreach ($units as $unitData) {
            $unit = UnitKerja::create($unitData);

            // 2. Buat Pegawai untuk setiap unit
            Pegawai::create([
                'unit_kerja_id' => $unit->id,
                'nama' => 'Dr. ' . $unitData['nama_unit'] . ' Admin',
                'nip' => '19800101' . rand(1000, 9999),
                'status_kepegawaian' => 'PNS',
                'golongan' => 'IV/a',
            ]);

            Pegawai::create([
                'unit_kerja_id' => $unit->id,
                'nama' => 'Staff ' . $unitData['nama_unit'],
                'nip' => '19900101' . rand(1000, 9999),
                'status_kepegawaian' => 'PPPK',
                'golongan' => 'III/c',
            ]);
        }
    }
}
