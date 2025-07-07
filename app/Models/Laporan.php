<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Laporan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'nama',
        'ttg',
        'agama',
        'pekerjaan',
        'alamat_ktp',
        'alamat_domisili',
        'nomor_hp',
        'isi_laporan',
        'bukti_1',
        'bukti_2',
        'bukti_3',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['bukti_urls'];

    /**
     * Get the bukti files URLs.
     *
     * @return array
     */
    public function getBuktiUrlsAttribute()
    {
        $urls = [];
        foreach (['bukti_1', 'bukti_2', 'bukti_3'] as $bukti) {
            if ($this->$bukti) {
                $urls[$bukti] = Storage::url($this->$bukti);
            } else {
                $urls[$bukti] = null;
            }
        }
        return $urls;
    }

    /**
     * Get the created_at attribute in formatted form.
     *
     * @return string|null
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at?->format('d F Y H:i');
    }

    /**
     * Get the updated_at attribute in formatted form.
     *
     * @return string|null
     */
    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at?->format('d F Y H:i');
    }
}