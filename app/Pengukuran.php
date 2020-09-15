<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Pengukuran extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'pengukurans';

    protected $appends = [
        'file_dwg',
    ];

    protected $dates = [
        'tanggal_pengukuran',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_berkas_id',
        'desa_id',
        'kecamatan_id',
        'no_gu',
        'no_su_baru',
        'tanggal_pengukuran',
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

    public function id_berkas()
    {
        return $this->belongsTo(BerkasMasuk::class, 'id_berkas_id');
    }

    public function pembantu_ukurs()
    {
        return $this->belongsToMany(Team::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function getTanggalPengukuranAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTanggalPengukuranAttribute($value)
    {
        $this->attributes['tanggal_pengukuran'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getFileDwgAttribute()
    {
        return $this->getMedia('file_dwg');
    }
}
