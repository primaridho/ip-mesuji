<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class BerkasKeluar extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'berkas_keluars';

    protected $dates = [
        'tgl_keluar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'berkasmasuk_id',
        'tgl_keluar',
        'penerima_keluar',
        'pemberi_keluar_id',
        'pengukuran_id',
        'keterangan',
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

    public function berkasmasuk()
    {
        return $this->belongsTo(BerkasMasuk::class, 'berkasmasuk_id');
    }

    public function getTglKeluarAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTglKeluarAttribute($value)
    {
        $this->attributes['tgl_keluar'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function pemberi_keluar()
    {
        return $this->belongsTo(Team::class, 'pemberi_keluar_id');
    }

    public function pengukuran()
    {
        return $this->belongsTo(Pengukuran::class, 'pengukuran_id');
    }

    public function isiberkas_keluars()
    {
        return $this->belongsToMany(IsiBerka::class);
    }
}
