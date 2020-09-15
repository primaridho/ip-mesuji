<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class SuratUkur extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'surat_ukurs';

    protected $appends = [
        'gambar',
    ];

    protected $dates = [
        'tahun',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_kecamatan_id',
        'id_desa_id',
        'no_su',
        'tahun',
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

    public function getGambarAttribute()
    {
        $file = $this->getMedia('gambar')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
