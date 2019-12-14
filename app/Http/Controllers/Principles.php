<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

class Principles extends Controller
{
    public function createPrinciples (Request $request) {
        // clear previous sessions
        $request->session()->forget('principles-files');

        $name = $request->get('name');
        $title = $request->get('title');
        $bio = $request->get('bio');
        $path = $request->get('path');
        $user = Auth::id();

        if (isset($path)) {
            $payload = [
                'user' => $user,
                'name' => $name,
                'title' =>  $title,
                'bio' => $bio,
                'image' => $path,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ];
            $data = DB::table('principles')->insert($payload);
            return response()->json([
                'response' => $data
            ]);
        } else {
            return response()->json([
                'response' => 'Image not set'
            ]);
        }
    }
    public function getPrinciples(Request $request) {
        // Get Principles
        $userid = Auth::id();
        $principles = DB::table('principles')
            ->where('user', $userid)
            ->get();
        if ($principles) {
            //Add principles to session
            $session_data = session( 's3-data', array() );
            $session_data = array_merge( $session_data, ['account-settings/principles'=> $principles]);
            session( [ 's3-data' => $session_data ] );
            return response()->json([
                'message' => 'Account Settings Principles',
                'response' => $principles,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Failed',
                'status' => 490
            ]);
        }
    }
    public function deletePrinciple(Request $request) {
        // Get Principle
        $userid = Auth::id();
        $id = $request->get('id');

        $principles = DB::table('principles')
            ->where('user', $userid)
            ->where('id', $id)
            ->first();

        if ($principles) {
            // Delete Principle
            DB::table('principles')
            ->where('user', $userid)
            ->where('id', $id)
            ->delete();

            // Delete corresponding file
            DB::table('files')
            ->where('user', $userid)
            ->where('path', $principles->image)
            ->delete();

            // Delete file from s3 storage
            // Storage::disk('s3')->delete($principles->image);

            return response()->json([
                'message' => 'Deleted Successfully',
                'status' => 200
            ]);

        } else {
            return response()->json([
                'message' => 'Failed',
                'status' => 490
            ]);
        }
    }

}
