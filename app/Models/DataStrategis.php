<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStrategis extends Model
{
    use HasFactory;

    protected $table = 'data_strategis'; // sesuaikan dengan nama tabel kamu di phpMyAdmin

    protected $primaryKey = 'id_data';

    public $timestamps = false; // karena di tabel kamu tidak ada kolom created_at / updated_at

    protected $fillable = [
        'nama',
        'icon',
    ];
}
