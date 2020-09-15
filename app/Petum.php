<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Petum extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'peta';

    protected $appends = [
        'scan_peta',
    ];

    const STATUS_PETA_SELECT = [
        '1' => 'Lengkap',
        '2' => 'Tidak Lengkap',
    ];

    protected $dates = [
        'tahun',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'no_peta',
        'no_lembar',
        'tahun',
        'status_peta',
        'keterangan',
    ];

    protected $fillable = [
        'id_kecamatan_id',
        'id_desa_id',
        'no_peta',
        'no_lembar',
        'tahun',
        'status_peta',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function id_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan_id');
    }

    public function id_desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa_id');
    }

    public function getTahunAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTahunAttribute($value)
    {
        $this->attributes['tahun'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getScanPetaAttribute()
    {
        return $this->getMedia('scan_peta');
    }
}
