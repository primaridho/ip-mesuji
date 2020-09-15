<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Kecamatan extends Model
{
    use Auditable;

    public $table = 'kecamatans';

    public static $searchable = [
        'kode_kecamatan',
        'nama_kecamatan',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kode_kecamatan',
        'nama_kecamatan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function idKecamatanPeta()
    {
        return $this->hasMany(Petum::class, 'id_kecamatan_id', 'id');
    }
}
