<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UnitKerja
 * 
 * Entitas yang merepresentasikan Unit Kerja.
 * 
 * @property int $id Primary key unit kerja.
 * @property string $nama_unit Nama unit kerja.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection|Pegawai[] $pegawais
 */
class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerjas';

    protected $fillable = [
        'nama_unit',
    ];

    /**
     * MENGAPA: Relasi HasMany karena satu Unit Kerja dapat memiliki banyak Pegawai.
     */
    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
