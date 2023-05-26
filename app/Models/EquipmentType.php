<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\EquipmentTypeSpecializations;

class EquipmentType extends Model{

    use HasFactory;

    protected $table = "equipment_type";
    protected $fillable = [
        'id',
        'name',
        'create_at',
        'update_at',
    ];

    public static function createEquipmentType($type)
    {
        return EquipmentType::insertGetId([
            'name' => $type->name,
        ]);
    }

    public static function readEquipmentType($typeId)
    {
        return DB::transaction(function() use($typeId){
            $type = EquipmentType::find($typeId);

            $typeSpecializations = 
                EquipmentTypeSpecializations::where('equipment_type_id', $typeId)
                    ->get();
            
            return (object)[
                'id' => $typeId,
                'name' => $type->name,
                'specializations' => $typeSpecializations,
            ];
        });
    }

    public static function readAllEquipmentTypes(){
        return EquipmentType::get();
    }

    public static function updateEquipmentType($type)
    {
        EquipmentType::where('id',$type->id)->update(['name' => $type->name]);
    }

    public static function deleteEquipmentType($typeId)
    {
        DB::transaction(function() use($typeId){
            EquipmentTypeSpecializations::where('equipment_type_id', $typeId)->delete();
            EquipmentType::where('id', $typeId)->delete();
        });
    }


}