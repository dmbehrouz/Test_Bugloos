<?php

namespace App\Http\Services;

use App\Interfaces\LogServiceRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class LogServices
{
    private $logServiceRepository;

    public function __construct(LogServiceRepositoryInterface $LogServiceRepository)
    {
        $this->logServiceRepository = $LogServiceRepository;
    }

    /**
     * @param array $params
     * @return array
     * @description return count of log depend on conditions. If no filters are requested, the number of records will be cached.
     */
    public function countLogs(array $params = [])
    {
        if (count($params))
            $result = $this->logServiceRepository->getCountLog($params);
        else
            $result = Cache::remember('countOfLog',now()->addMinutes(5) , function () use ($params) {
                return $this->logServiceRepository->getCountLog($params);
            });

        return [
            'count' => $result
        ];
    }

}
