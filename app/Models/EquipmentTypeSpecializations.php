<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentTypeSpecializations extends Model{

    use HasFactory;

    protected $table = "equipment_type_specializations";
    protected $fillable = [
        'id',
        'name',
        'type',
        'equipment_type_id',
        'create_at',
        'update_at',
    ];

    public static function createEquipmentTypeSpecializations($specialization){
        EquipmentTypeSpecializations::create([
            'name' => $specialization->name,
            'type' => $specialization->type,
            'equipment_type_id' => $specialization->equipment_type_id,
        ]);

        return EquipmentTypeSpecializations::where('equipment_type_id', $specialization->equipment_type_id)
                            ->get();
    }

    public static function readEquipmentTypeSpecializations($typeId){
        $responseSpec = EquipmentTypeSpecializations::where('equipment_type_id', $typeId)
                            ->get();

        $specializations =[];
        foreach($responseSpec as $specialization){
            $specialization->value = null;
            array_push($specializations, $specialization);
        }

        return $specializations;
    }

    public static function deleteEquipmentTypeSpecializations($specialization)
    {
        EquipmentTypeSpecializations::find($specialization->id)->delete();
        return EquipmentTypeSpecializations::where('equipment_type_id', $specialization->equipment_type_id)
            ->get();
    }
}