<?php

namespace App\Http\Services;

use App\Interfaces\LogServiceRepositoryInterface;

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
     * @description return count of log depend on conditions.
     */
    public function countLogs(array $params = [])
    {
        $result = $this->logServiceRepository->getCountLog($params);
        return [
            'count' => $result
        ];
    }

}
