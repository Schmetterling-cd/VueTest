<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\EquipmentType;
use App\Models\EquipmentTypeSpecializations;

class EquipmentTypeController extends Controller
{
    public function create($id)
    {
        return Inertia::render('TypeCard', ['type' => EquipmentType::readEquipmentType($id)]);
    }

    public function store(Request $request)
    {
        $type = $request;
        EquipmentType::createEquipmentType($type);
    }

    public function fetch(Request $request){
        $typeId = $request->id;
        return EquipmentType::readEquipmentType($typeId);
    }

    public function fetchAll(){
        return EquipmentType::readAllEquipmentTypes();
    }

    public function update(Request $request){
        $type = $request;
        EquipmentType::updateEquipmentType($type);
    }

    public function delete(Request $request){
        $typeId = $request->id;
        EquipmentType::deleteEquipmentType($typeId);
    }

    public function addSpecialization(Request $request){
        $specialization = $request;
        return EquipmentTypeSpecializations::createEquipmentTypeSpecializations($specialization);
    }

    public function deleteSpecialization(Request $request){
        $specialization = $request;
        return EquipmentTypeSpecializations::deleteEquipmentTypeSpecializations($specialization);
    }

    public function fetchSpecializations(Request $request){
        $typeId = $request->id;
        return EquipmentTypeSpecializations::readEquipmentTypeSpecializations($typeId);
    }
}
