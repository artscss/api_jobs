<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\JobInterface;
use App\Http\Requests\StoreJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $JobInterface;
    public function __construct(JobInterface $jobInterface)
    {
        $this->JobInterface = $jobInterface;
    }
    public function index()
    {
        return $this->JobInterface->index();
    }
    public function create()
    {
        return $this->JobInterface->create();
    }

    public function store(StoreJobRequest $request)
    {
        return $this->JobInterface->store($request);
    }
    public function show($id)
    {
        return $this->JobInterface->show($id);
    }

    public function edit($id)
    {
        return $this->JobInterface->edit($id);
    }

    public function update(Request $request)
    {
        return $this->JobInterface->update($request);
    }
    public function destroy($id)
    {
        return $this->JobInterface->destroy($id);
    }
}
