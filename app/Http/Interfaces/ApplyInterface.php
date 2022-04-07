<?php

namespace App\Http\Interfaces;

use Illuminate\Support\Facades\Request;

interface ApplyInterface {
    public function apply(Request $request);
    public function details(Request $request);
}