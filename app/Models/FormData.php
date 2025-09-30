<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'form_data';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id_data',
        'id_pegawai',
        'nilai',
        'satuan',
        'periode',
        'link_publikasi',
    ];

    // Laravel otomatis atur timestamps, 
    // tapi kalau tabel hanya punya "tanggal_input", nonaktifkan timestamps bawaan
    public $timestamps = false;

     // Relasi ke DataStrategis
    public function dataStrategis()
    {
        return $this->belongsTo(DataStrategis::class, 'id_data', 'id_data');
    }

    // Relasi ke Pegawai
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pegawai', 'id');
    }
}
