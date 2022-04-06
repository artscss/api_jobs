<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplyController extends Controller
{
    protected $job_id;
    public function apply(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->job_id = $request->id;

        $search = Apply::where("user_id", $user_id)->where("job_id", $this->job_id)->first();

        if($search){
            return redirect("/dashboard")->with("danger", "job already apply");
        }else{
            $data = new Apply();
            $data->user_id = $user_id;
            $data->job_id = $this->job_id;
            $data->save();
        }
        return view("job.details", compact("data"))->with("success", "job apply successful");
    }

    public function details(Request $request)
    {
        $user_id = Auth::user()->id;
        $job_id = $request->job_id;

        DB::table('job_user')
        ->where('user_id', $user_id)
        ->where('job_id', $job_id)
        ->update([
            'expected_salary' => $request->expected_salary,
            'current_salary' => $request->current_salary,
        ]);
        return redirect("/dashboard")->with("success", "job details successful");
    }
}
