<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Desa extends Model
{
    use Auditable;

    public $table = 'desas';

    public static $searchable = [
        'kode_desa',
        'nama_desa',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_kecamatan_id',
        'kode_desa',
        'nama_desa',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function idDesaPeta()
    {
        return $this->hasMany(Petum::class, 'id_desa_id', 'id');
    }

    public function id_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan_id');
    }
}
