<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Address;

class Application extends Model
{
    use HasFactory;

    protected $table = 'application';
    protected $fillable = [
        'id',
        'user_id',
        'equipment_id',
        'status_id',
        'date_from',
        'date_to',
        'create_at',
        'update_at',
        'address',
    ];

        public static function readFreeDates($equipmentId){
            $date = date('Y-m-d');
            return Application::select('date_from', 'date_to')
                        ->where('date_from', '>', $date)
                        ->where('status_id', '!=', 2)
                        ->where('equipment_id', '=', $equipmentId)
                        ->get();
        }

        public static function readUserApplications($userId){
            return DB::transaction(function()use($userId){
                $applicationsResp = Application::where('user_id', '=', $userId)
                                                        ->orderBy('id','DESC')
                                                        ->get();

                $applications = [];
                foreach($applicationsResp as $application){
                    $application->equipment = Equipment::readEquipment($application->equipment_id);
                    $application->address = Address::where('id', '=', $application->address)->get()[0];

                    array_push($applications, $application);
                }

                return $applications;
            });
        }

        public static function changeOrderStatus($order){
            Application::where('id', $order->id)->update([
                'status_id' => $order->status,
            ]);
        }

        public static function readUserOrders($userId){
            return DB::transaction(function() use($userId){
                $equipmentResp = Equipment::where('user_id', '=', $userId)->get();

                $applications = [];
                foreach ($equipmentResp as $equipment){
                    $applicationsResp = Application::where('equipment_id', '=', $equipment->id)->get();
                    $equipment->photo = base64_encode($equipment->photo);
                    foreach($applicationsResp as $application){
                        $application->address = Address::where('id', '=', $application->address)->get()[0];
                        $application->equipment = $equipment;
                        //$application->equipment['photo'] = base64_encode($equipment->photo);
                        array_push($applications, $application);
                    }
                }
                return $applications;
            });
        }

        public static function createApplication($application){
            return DB::transaction(function() use($application){
                if($application->address === null){
                    $address = Address::insertGetId([
                        'user_id' => $application->user_id,
                        'city' => $application->city,
                        'street' => $application->street,
                        'house' => $application->house,
                    ]);
                }else{
                    $address = $application->address;
                }
                

                Application::insert([
                    'user_id' => $application->user_id,
                    'equipment_id' => $application->equipment_id,
                    'status_id' => 0,
                    'date_from' => substr($application->date_from, 0, -14),
                    'date_to' => substr($application->date_to, 0, -14),
                    'first_name' => $application->name,
                    'second_name' => $application->secondname,
                    'mial' => $application->mail,
                    'phone' => $application->phone,
                    'address' => $address,
                    'coast' => $application->coast,
                ]);

            });
        }
}
