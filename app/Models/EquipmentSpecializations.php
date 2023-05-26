<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentSpecializations extends Model{

    use HasFactory;

    protected $table = "equipment_specializations";
    protected $fillable = [
        'id',
        'equipment_type_spec_id',
        'equipment_id',
        'value',
        'create_at',
        'update_at',
    ];
}