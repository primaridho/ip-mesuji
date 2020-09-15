<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Jodesk extends Model
{
    use Auditable;

    public $table = 'jodesks';

    public static $searchable = [
        'nama_jodesk',
        'deskripsi',
    ];

    const STATUS_SELECT = [
        '1' => 'Belum selesai',
        '2' => 'Selesai',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_jodesk',
        'deskripsi',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function petugas()
    {
        return $this->belongsToMany(Team::class);
    }
}
