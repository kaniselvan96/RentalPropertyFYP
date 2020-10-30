<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TenancyRequest;
use App\Models\Tenant;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function photohouse($id)
    {
        $houseView = DB::table('houses')->where('house_id', $id)->first();

        $saveimages = DB::table('houses')
        ->join('photos', 'photos.house_id', '=', 'houses.house_id')
        ->where('houses.house_id', $id)
        ->get();

        return view('photo.housephoto', compact('houseView', 'saveimages'));
    }

    public function photostore(Request $request)
    {
       
        $input=$request->all();
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                // dd( $name);
                $file->move('images',$name);
                $images[]=$name;
                $photo = Photo::insert( [
                    'photolink'=>  $name,
                    'house_id' =>$input['house_id'],
                    //you can put other insertion here
                ]);
            }
        }
       
    
        return response()->json($photo, 201);
    }
    public function photoremove(Request $request)
    {
        $shark = Photo::find($request->photo_id);
        $shark->delete();
       
    
        return response()->json($shark, 201);
    }
}
