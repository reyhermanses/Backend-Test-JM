<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';

    protected $fillable = [
        'name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public function belongsToKaryawan(){
        return $this->belongsTo(Karyawan::class, 'id', 'unit_id');
    }
}
