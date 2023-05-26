<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\EquipmentSpecializations;
use Inertia\Inertia;

class Equipment extends Model{

    use HasFactory;

    protected $table = "equipment";
    protected $fillable = [
        'id',
        'user_id',
        'equipment_id',
        'equipment_type_id',
        'coast',
        'photo',
        'create_at',
        'update_at',
    ];

    public static function createEquipment($equipment, $picture)
    {
        DB::transaction(function() use($equipment, $picture){
            $equipmentId = Equipment::insertGetId([
                'user_id' => $equipment->user_id,
                'equipment_type_id' => $equipment->equipment_type_id,
                'name' => $equipment->name,
                'coast' => $equipment->coast,
                'photo' => $picture,
            ]);

            $specializations = [];
            foreach ($equipment->specializations as $specialization){
                $spec_item_array = [
                    'equipment_type_spec_id' => $specialization->id,
                    'equipment_id' => $equipmentId,
                    'value' => $specialization->value,
                ];

                array_push($specializations, $spec_item_array);
            }

            EquipmentSpecializations::insert($specializations);
        });
    }

    public static function readEquipment($equipmentId)
    {
        return DB::transaction(function() use($equipmentId){
            $equipment = Equipment::find($equipmentId);

            $specializations = EquipmentSpecializations::leftJoin('equipment_type_specializations', 'equipment_specializations.equipment_type_spec_id', '=','equipment_type_specializations.id')
                ->where('equipment_specializations.equipment_id', '=', $equipmentId)
                ->select('equipment_specializations.id', 'equipment_specializations.equipment_type_spec_id', 'equipment_type_specializations.name', 'equipment_type_specializations.type', 'equipment_specializations.value')
                ->get();

            // return equipment with all options
            return (object)[
                'id' => $equipmentId,
                'name' => $equipment->name,
                'equipment_type_id' => $equipment->equipment_type_id,
                'coast' => $equipment->coast,
                'photo' => base64_encode($equipment->photo),
                'specializations' => $specializations,
            ];
        });
    }

    public static function readEquipments()
    {
        return Equipment::get();
    }

    public static function readUserEquipments($userId)
    {
        return DB::transaction(function() use($userId){
            $equipmentsResp = Equipment::where('user_id', $userId)->get();

            $equipments =[];
            foreach($equipmentsResp as $equipmentVal){
                $specializations = EquipmentSpecializations::leftJoin('equipment_type_specializations', 'equipment_specializations.equipment_type_spec_id', '=','equipment_type_specializations.id')
                ->where('equipment_specializations.equipment_id', '=', $equipmentVal->id)
                ->select('equipment_specializations.id', 'equipment_specializations.equipment_type_spec_id', 'equipment_type_specializations.name', 'equipment_type_specializations.type', 'equipment_specializations.value')
                ->get();

                $equipment = (object)[
                    'id' => $equipmentVal->id,
                    'name' => $equipmentVal->name,
                    'equipment_type_id' => $equipmentVal->equipment_type_id,
                    'coast' => $equipmentVal->coast,
                    'photo' => base64_encode($equipmentVal->photo),
                    'specializations' => $specializations,
                ];

                array_push($equipments, $equipment);
            }
            
            return $equipments;
        });

    }

    public static function updateEquipment($equipment)
    {
        DB::transaction(function() use($equipment){
            Equipment::where('id', $equipment->id)
                ->update([
                    'equipment_type_id' => $equipment->equipment_type_id,
                    'name' => $equipment->name,
                    'coast' => $equipment->coast,
                    'photo' => base64_decode($equipment->photo),
                ]);

            foreach ($equipment->specializations as $specialization){
                EquipmentSpecializations::where('id','=', $specialization['id'])->update([
                    'equipment_type_spec_id' => $specialization['equipment_type_spec_id'],
                    'equipment_id' => $equipment->id,
                    'value' => $specialization['value'],
                ]);
            }
        });
    }

    public static function deleteEquipment($equipmentId)
    {
        DB::transaction(function() use($equipmentId){
            EquipmentSpecializations::where('equipment_id', $equipmentId)->delete();
            Equipment::where('id', $equipmentId)->delete();
        });
    }
}