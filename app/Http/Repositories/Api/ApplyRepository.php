<?php

namespace App\Http\Repositories\Api;

use App\Http\Interfaces\Api\ApplyInterface;
use App\Models\Apply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplyRepository implements ApplyInterface
{
    protected $job_id;
    public function apply($request)
    {
        $user_id = Auth::user()->id;
        $this->job_id = $request->id;

        $search = Apply::where("user_id", $user_id)->where("job_id", $this->job_id)->first();

        if($search){
            return response()->json(["message" => "job already apply", "status" => 400], 400);
        }else{
            $data = new Apply();
            $data->user_id = $user_id;
            $data->job_id = $this->job_id;
            $data->save();
        }
        return response()->json(["message" => "job apply successful", "status" => 200], 200);
    }
    public function details($request, $id)
    {
        $user_id = Auth::user()->id;
        $job_id = $id;

        DB::table('job_user')
        ->where('user_id', $user_id)
        ->where('job_id', $job_id)
        ->update([
            'expected_salary' => $request->expected_salary,
            'current_salary' => $request->current_salary,
        ]);
        return response()->json(["message" => "job details successful", "status" => 200], 200);
    }
}