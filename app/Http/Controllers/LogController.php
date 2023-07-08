<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogRequest;
use App\Interfaces\LogServiceRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    private $LogServiceRepository;
    public function __construct(LogServiceRepositoryInterface $LogServiceRepository)
    {
        $this->LogServiceRepository = $LogServiceRepository;

    }

    public function show(LogRequest $request)
    {
        $request->validated();
        dd('OKKK');
    }
}
