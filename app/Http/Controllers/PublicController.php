<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function allhouse()
    {

        $myhouse = DB::table('houses')
            ->where('houses.status', 'Available')
            ->get();

        $myhousephoto = DB::table('houses')
            ->leftjoin('photos', 'photos.house_id', '=', 'houses.house_id')
            ->where('houses.status', 'Available')
            ->get();

        $myhousephoto = json_decode(json_encode($myhousephoto), true);

        $seenItems = array();

        foreach ($myhousephoto as $index => $item) {
            if (in_array($item["house_id"], $seenItems)) {
                unset($myhousephoto[$index]);
            } else {
                $seenItems[] = $item["house_id"];
            }

        }

        foreach ($myhouse as $houseindex => $house) {
            foreach ($myhousephoto as $index => $photo) {
                $myhouse[$houseindex]->photolink = "default.png";
            }
        }
        foreach ($myhouse as $houseindex => $house) {
            foreach ($myhousephoto as $index => $photo) {
                if ($photo["house_id"] == $house->house_id) {
                    $myhouse[$houseindex]->photolink = $photo["photolink"];
                }

            }
        }

        $myhousephoto = array_values($myhousephoto);
        $myhousemain['myhouse'] = $myhouse;
        $myhousemain['myhousephoto'] = $myhousephoto;
        
        return response()->json($myhousemain, 201);
    }

    public function publicviewhouse($id)
    {
        $houseView = DB::table('houses')->where('house_id', $id)->first();
        $savedfacilities = $houseView->facilities;
        $housephoto = DB::table('photos')
            ->where('house_id', '=', $id)
            ->pluck('photolink')->toArray();
        $housephotolink = array();
        foreach ($housephoto as $k => $photo) {
            array_push($housephotolink, "/images/" . $photo);
        }
        if (empty($housephotolink)) {
            array_push($housephotolink, "/images/default.png");
        }
        return view('house.view', compact('houseView', 'savedfacilities', 'housephotolink'));
    }
}
