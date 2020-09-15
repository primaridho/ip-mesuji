<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class GambarUkur extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'gambar_ukurs';

    protected $appends = [
        'scan_gu',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_pengukuran_id',
        'id_kecamatan_id',
        'id_desa_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function id_pengukuran()
    {
        return $this->belongsTo(Pengukuran::class, 'id_pengukuran_id');
    }

    public function id_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan_id');
    }

    public function id_desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa_id');
    }

    public function getScanGuAttribute()
    {
        return $this->getMedia('scan_gu');
    }
}
