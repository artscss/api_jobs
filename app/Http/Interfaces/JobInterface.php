<?php

namespace App\Http\Interfaces;

use App\Http\Requests\StoreJobRequest;

interface JobInterface {
    public function index();
    public function create();
    public function store(StoreJobRequest $request);
    public function show($id);
    public function edit($id);
    public function update($request);
    public function destroy($id);
}