<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\JobInterface;
use App\Http\Requests\StoreJobRequest;
use App\Models\Job;

class AuthRepository implements JobInterface
{
    public function index()
    {
        $jobs = Job::all();
        return view("job.dashboard", compact("jobs"));
    }
    public function create()
    {
        return view("job.create");
    }
    public function store(StoreJobRequest $request)
    {
        $data = new Job();
        $data->name = $request->name;
        $data->description = $request->description;

        if($request->hasFile("image")){
            $image = $request->file("image");
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . "." . $extension;
            $image->move(public_path("images/"), $image_name);
            $data->image = $image_name;
        }else{
            $data->image = "job.png";
        }

        $data->save();
        return redirect("/dashboard")->with("success", "job created successfully");
    }
    public function show($id)
    {
        $jobs = Job::find($id);
        return view("job.show", compact("jobs"));
    }
    public function edit($id)
    {
        $jobs = Job::find($id);
        return view("job.edit", compact("jobs"));
    }
    public function update($request)
    {
        $data = Job::find($request->id);

        if(collect($request->name)->isEmpty()) // null
        {
            $data->name = $data->name;
        }else{
            $data->name = $request->name;
        }
        if(collect($request->description)->isEmpty()) // null
        {
            $data->description = $data->description;
        }else{
            $data->description = $request->description;
        }

        if($request->hasFile("image")){
            if($data->image !== "job.png"){
                unlink(public_path("images/") . $data->image);
            }
            $image = $request->file("image");
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . "." . $extension;
            $image->move(public_path("images/"), $image_name);
            $data->image = $image_name;
        }
        
        $data->save();
        return redirect("/dashboard")->with("success", "job update successfully");
    }
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();
        if($job->image !== "job.png"){
            unlink(public_path("images/") . $job->image);
        }
        return redirect("/dashboard")->with("danger", "job delete successfully");
    }
}