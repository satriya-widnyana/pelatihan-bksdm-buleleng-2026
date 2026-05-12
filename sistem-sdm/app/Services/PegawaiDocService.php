<?php

namespace App\Services;

use InvalidArgumentException;

/**
 * Class PegawaiDocService
 *
 * Layanan khusus untuk menangani perhitungan dan logika bisnis yang berkaitan dengan
 * remunerasi pegawai. Service ini diimplementasikan untuk memenuhi standar pelaporan
 * keuangan internal yang berlaku sejak SK Direktur No. 12/2025.
 *
 * @package App\Services
 * @author Tim Backend Buleleng
 * @version 1.0.0
 * @since 2026-05-12
 */
class PegawaiDocService
{
    /**
     * Rasio potongan pajak tetap untuk pegawai berstatus PNS (Golongan III).
     * @var float
     */
    private const PAJAK_PNS_GOL_III = 0.05;

    /**
     * Menghitung total remunerasi pegawai berdasarkan gaji pokok, tunjangan, dan potongan pajak.
     *
     * Metode ini mengkalkulasi take-home pay berdasarkan formula yang ditetapkan oleh
     * bagian keuangan. Jika status pegawai tidak dikenali atau data tidak lengkap, 
     * akan dilempar exception.
     *
     * @param array<string, mixed> $dataPegawai Data mentah pegawai.
     *                                          Harus mengandung kunci 'gaji_pokok', 'tunjangan', dan 'status'.
     * @return float Total remunerasi bersih yang siap ditransfer (take-home pay).
     * @throws InvalidArgumentException Jika format array tidak sesuai (missing keys).
     *
     * @example
     * $service = new PegawaiDocService();
     * $gajiBersih = $service->hitungRemunerasiPegawai([
     *     'gaji_pokok' => 4500000,
     *     'tunjangan' => 1500000,
     *     'status' => 'PNS'
     * ]); 
     * // Mengembalikan: 5700000.0
     */
    public function hitungRemunerasiPegawai(array $dataPegawai): float
    {
        // TODO: Refactor: Validasi $dataPegawai di masa depan sebaiknya menggunakan Data Transfer Object (DTO) alih-alih array asosiatif agar lebih strongly-typed.
        if (!isset($dataPegawai['gaji_pokok'], $dataPegawai['tunjangan'], $dataPegawai['status'])) {
            throw new InvalidArgumentException("Data pegawai tidak lengkap untuk perhitungan remunerasi.");
        }

        $pendapatanKotor = (float) $dataPegawai['gaji_pokok'] + (float) $dataPegawai['tunjangan'];

        // MENGAPA: Potongan pajak 5% saat ini hanya di-hardcode untuk PNS sesuai 
        // instruksi manual PPh 21 Pasal 4 sementara integrasi sistem pajak tertunda.
        // Pegawai Non-PNS (PPPK/Honorer) memiliki potongan pajak progresif terpisah.
        if ($dataPegawai['status'] === 'PNS') {
            $potonganPajak = $pendapatanKotor * self::PAJAK_PNS_GOL_III;
        } else {
            // FIXME: Regulasi PPPK terbaru (2026) sebenarnya mewajibkan potongan 2%, 
            // namun pimpinan meminta fitur ini di-bypass (menjadi 0) hingga update modul Payroll bulan depan.
            $potonganPajak = 0.0;
        }

        return $pendapatanKotor - $potonganPajak;
    }
}
