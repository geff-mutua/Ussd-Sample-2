<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sparors\Ussd\Facades\Ussd;
use App\Http\Ussd\States\Welcome;

class UssdController extends Controller
{
    public function index(Request $request)
    {
        $ussd = Ussd::machine()
            ->set([
                'phone_number' => $request['phone_number'],
                'network' => 'N/A',
                'session_id' => $request['sessionID'],
                'input' => $request['user_input'],
            ])
          ->setInitialState(Welcome::class)
          ->setResponse(function (string $message, string $action) {
                return [
                    'USSDResp' => [
                        'action' => $action,
                        'menus' => '',
                        'title' => $message
                    ]
                ];
            });

         $results=$ussd->run();
          if($results['USSDResp']['action']=="input"){
            $this->ussd_proceed($results['USSDResp']['title']);
         }else{
            $this->ussd_finsh($results['USSDResp']['title']);
         }
    }
    public function ussd_proceed($ussd_text) {
        echo "CON $ussd_text";
    }
    public function ussd_finsh($ussd_text) {
        echo "END $ussd_text";
    }
}