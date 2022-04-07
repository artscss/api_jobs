<?php

namespace App\Http\Interfaces\Api;

interface ApplyInterface {
    public function apply($request);
    public function details($request, $id);
}