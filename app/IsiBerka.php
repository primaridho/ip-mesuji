<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class IsiBerka extends Model
{
    public $table = 'isi_berkas';

    public static $searchable = [
        'nama_isi',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_isi',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
