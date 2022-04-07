<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ApplyInterface;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    protected $job_id;
    protected $ApplyInterface;
    public function __construct(ApplyInterface $applyInterface)
    {
        $this->ApplyInterface = $applyInterface;
    }
    public function apply(Request $request)
    {
        return $this->AuthInterface->apply($request);
    }

    public function details(Request $request)
    {
        return $this->AuthInterface->details($request);
    }
}
