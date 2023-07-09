<?php

namespace App\Http\Controllers;

use App\Http\Facades\LogsFacade;
use App\Http\Requests\LogRequest;
use App\Interfaces\LogServiceRepositoryInterface;

class LogController extends Controller
{
    private $logServiceRepository;

    public function __construct(LogServiceRepositoryInterface $LogServiceRepository)
    {
        $this->logServiceRepository = $LogServiceRepository;
    }

    public function count_logs(LogRequest $requestFilter)
    {
        $requestFilter->validated();
        $filter = $requestFilter->only(['statusCode', 'serviceNames', 'startDate', 'endDate']);
        if (isset($filter['serviceNames']))
            $filter['serviceNames'] = explode(',', $filter['serviceNames']);

        $result = LogsFacade::countLogs($filter);
        return response()->json($result);
    }
}
