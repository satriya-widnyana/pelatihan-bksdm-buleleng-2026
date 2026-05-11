<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Pegawai
 * 
 * Entitas yang merepresentasikan data Pegawai (Dosen & Staf) pada sistem SDM.
 * 
 * @property int $id Primary key pegawai.
 * @property int $unit_kerja_id Foreign key untuk relasi ke tabel unit_kerja.
 * @property string $nama Nama lengkap pegawai.
 * @property string $nip Nomor Induk Pegawai.
 * @property string $status_kepegawaian Status pegawai (PNS/PPPK/Honorer).
 * @property string|null $golongan Golongan ruang pegawai (misal: III/c).
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read UnitKerja|null $unitKerja
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Pegawai query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pegawai whereId($value)
 */
class Pegawai extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'pegawais'; // Default laravel uses plural

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     * 
     * MENGAPA: Mendefinisikan $fillable merupakan standar keamanan 
     * untuk melindungi dari eksploitasi Mass Assignment Vulnerability.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_kerja_id',
        'nama',
        'nip',
        'status_kepegawaian',
        'golongan',
    ];

    /**
     * Relasi ke Unit Kerja.
     * 
     * MENGAPA: Digunakan BelongsTo karena satu pegawai secara entitas database 
     * diikat secara spesifik pada satu record unit kerja induknya.
     *
     * @return BelongsTo
     */
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
