<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class BerkasMasuk extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'berkas_masuks';

    protected $appends = [
        'gambar_berkas',
    ];

    public static $searchable = [
        'no_berkas',
        'nama_pemohon',
        'jenis_kegiatan',
        'no_surattugas',
    ];

    protected $dates = [
        'tgl_masuk',
        'tgl_surattugas',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tgl_masuk',
        'petugas_loket',
        'penerima_masuk_id',
        'no_berkas',
        'nama_pemohon',
        'desa_id',
        'kecamatan_id',
        'jenis_kegiatan',
        'no_surattugas',
        'tgl_surattugas',
        'no_su',
        'no_hak',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const JENIS_KEGIATAN_SELECT = [
        '1'  => 'Pengukuran',
        '2'  => 'Pemecahan/Penggabungan',
        '3'  => 'Konversi/Pendaftaran',
        '4'  => 'Pengecekan Sertifikat',
        '5'  => 'Pemindahan',
        '6'  => 'Perubahan',
        '7'  => 'Peralihan',
        '8'  => 'Roya',
        '9'  => 'Penerbitan Sertifikat Pengganti',
        '10' => 'Revisi/Perbaikan',
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

    public function getTglMasukAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTglMasukAttribute($value)
    {
        $this->attributes['tgl_masuk'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function penerima_masuk()
    {
        return $this->belongsTo(Team::class, 'penerima_masuk_id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function getTglSurattugasAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglSurattugasAttribute($value)
    {
        $this->attributes['tgl_surattugas'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function isiberkas()
    {
        return $this->belongsToMany(IsiBerka::class);
    }

    public function getGambarBerkasAttribute()
    {
        $files = $this->getMedia('gambar_berkas');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
