<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException; // top of the page
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;
use App\User;
use App\MasterPortal;
use App\GamePortal;




class ImageuploadController extends Controller
{
    // Upload images of User

    function add(Request $request, $iid)
    {
    	$tablename = "users";
    	$imagetype = "user_profile";
	    $cover = $request->file('image');
	    $prodimge = $cover->store('public/'.$imagetype);
		$imageencoded = base64_encode(file_get_contents(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$cover->store('public/'.$imagetype)));

							$arr_tojson = array(
					'name' => $prodimge,
					'fileMimeType' => $cover->getMimeType(),
					'filecoded_string'=>$imageencoded,
					);
					$newdatarr = json_encode($arr_tojson);
		DB::table($tablename)->where('id', $iid)->update(['profile_image' => $newdatarr]);
	            $msg = 'Successfully updated '.$imagetype.' image!';
				return response()->json([
					'body' => $imageencoded,
					'status' => 'true',
					'message' => $msg,
					], 200);
	}



}
