<?php

namespace App\Http\Controllers;

use App\sys_menu_category_mf;
use App\sys_mf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\Routing\Tests\Fixtures\AnnotationFixtures\DefaultValueController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {

        $parent=sys_menu_category_mf::all();

        $data=[];
        $data2=null;
        $items=null;
        //$aaa=array();
        $parents=[];
        foreach ($parent as $item){
           // $i=0;
            array_push($parents,['name'=>$item->cat_name,'id'=>$item->id]);
            $data2=DB::table('sys_mfs')->where('sys_menu_cat_code','=','1')->get();
                //$data2=DB::raw(DB::select("select sys_mf_desc from sys_mfs where sys_menu_cat_code=".$item->id." "));
                //$items=array($data2);


      array_push($data,['name'=>$data2[0]->sys_mf_desc,'cat_code'=>$data2[0]->sys_menu_cat_code]);
        }
        dd($data2);
        $menu=DB::select(DB::raw("select sys_mf_desc,sys_menu_cat_code ,sys_menu_category_mfs.cat_name from sys_mfs inner join sys_menu_category_mfs on sys_mfs.sys_menu_cat_code=sys_menu_category_mfs.id "));


        $array=[

            'settings'=>[
                '0'=>'Add User',
                '1'=>'Add company'

            ],
            'Inventory'=>[
                '0'=>'Add Invoice',
                '1'=>'Add GRN'
            ]
        ];
        //dd($parent);
        return view('home')->with('menu',$parents)->with('submenu',$data);

    }



       //SEND PUSH NOTIFICATION
        function sendMessage()
        {
            $content = array(
                "en" => 'English Messages',
                'body'=>'ssss'
            );
            $hashes_array = array();
            array_push($hashes_array, array(
                "id" => "like-button",
                "text" => "Like",
                "icon" => "http://i.imgur.com/N8SN8ZS.png",
                "url" => "http://techzonelk.co"
            ));

            $fields = array(
                'app_id' => "YOUR_ONE_SIGNAL_APP_ID",
                'included_segments' => array(
                    'All'
                ),
                'data' => array(
                    "foo" => "bar"
                ),
                'contents' => $content,
                'web_buttons' => $hashes_array
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic YOUR_REST_API_KEY'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;



        }

    /**
     *
     */
    public function send(){
    $response = $this->sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode($return);



    print("\n\nJSON received:\n");
    print($return);
    print("\n");

}

}
