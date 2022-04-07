<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\ApplyInterface;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    protected $AuthInterface;
    public function __construct(ApplyInterface $authInterface)
    {
        $this->AuthInterface = $authInterface;
    }
    public function apply(Request $request)
    {
        return $this->AuthInterface->apply($request);
    }

    public function details(Request $request,$id)
    {
        return $this->AuthInterface->details($request, $id);
    }
}
