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

    public function updated_by(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
