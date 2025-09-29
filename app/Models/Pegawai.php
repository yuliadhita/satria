<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Nama tabel (opsional kalau sama dengan jamak dari model, 
    // tapi karena kamu pakai 'pegawai' bukan 'pegawais', kita set manual)
    protected $table = 'pegawai';

    // Primary key
    protected $primaryKey = 'id_pegawai';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'email',
        'nama',
        'password',
    ];

    // Karena id_pegawai auto_increment
    public $incrementing = true;

    // Jika primary key bukan tipe string
    protected $keyType = 'int';

    // Kalau tabel tidak ada kolom created_at dan updated_at
    public $timestamps = false;
}
