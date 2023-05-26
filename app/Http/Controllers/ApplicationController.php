<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Equipment;
use DateTime;
use DateInterval;
use DatePeriod;

class ApplicationController extends Controller
{
    public function create($equipmentId)
    {
        $equipment = Equipment::readEquipment($equipmentId);
        $datesResp = Application::readFreeDates($equipmentId);

        $dates = [];
        foreach ($datesResp as $date) {
            $period = new DatePeriod(
                new DateTime($date->date_from),
                new DateInterval('P1D'),
                new DateTime($date->date_to.' 23:59')
            );

            foreach ($period as $key => $value) {
                array_push($dates, $value->format('Y-m-d'));
            }
        }
        return Inertia::render('Application', [
            'equipment' => $equipment,
            'dates' => $dates,
        ]);
    }

    public function fetchUserAddress(Request $request){
        $userId = $request->user_id;
        return Address::readUserAddress($userId);
    }

    public function fetchUserApplications(Request $request){
        $userId = $request->user_id;
        return Application::readUserApplications($userId);
    }

    public function fetchUserOrders(Request $request){
        $userId = $request->user_id;
        return Application::readUserOrders($userId);
    }

    public function changeOrderStatus(Request $request){
        $order = $request;
        Application::changeOrderStatus($order);
    }

    public function store(Request $request){
        $application = $request;
        return Application::createApplication($application);
    }
}
