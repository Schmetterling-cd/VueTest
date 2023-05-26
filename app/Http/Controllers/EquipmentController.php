<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EquipmentController extends Controller
{
    public function create($id){
        return Inertia::render('EquipmentCard', ['equipment' => Equipment::readEquipment($id)]);
    }

    public function createProductCard($id){
        return Inertia::render('EquipmentInfo', ['equipment' => Equipment::readEquipment($id)]);
    }

    public function store(Request $request){
        $equipment =json_decode($request->equipment);
        $picture = file_get_contents($_FILES['file']['tmp_name']);
        Equipment::createEquipment($equipment, $picture);
    }

    public function fetch(Request $request){
        $equipmentId = $request->id;
        return Equipment::readEquipment($equipmentId);
    }

    public function fetchEquipments(){
        $respEquip = Equipment::readEquipments();

        $equipments = [];
        foreach($respEquip as $equipment){
            $equipment->photo = base64_encode($equipment->photo);
            array_push($equipments, $equipment);
        }
        return $equipments;
    }

    public function fetchUserEquipments(Request $request){
        $userId = $request->id;
        return Equipment::readUserEquipments($userId);
    }

    public function update(Request $request){
        $equipment = $request;
        Equipment::updateEquipment($equipment);
        return Equipment::readEquipment($equipment->id);
    }

    public function delete(Request $request){
        $equipmentId = $request->id;
        Equipment::deleteEquipment($equipmentId);
        return $this->fetchEquipments();
    }
}
