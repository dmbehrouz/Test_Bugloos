<?php

namespace App\Repositories;

use App\Interfaces\LogServiceRepositoryInterface;
use App\Models\LogService;

class LogServiceRepository implements LogServiceRepositoryInterface
{
    /**
     * @see LogServiceRepositoryInterface::getAll()
     */
    public function getAll()
    {
        return LogService::all();
    }

    /**
     * @see LogServiceRepositoryInterface::getLogServiceById()
     */
    public function getLogServiceById(int $logId)
    {
        return LogService::findOrFail($logId);
    }

    /**
     * @see LogServiceRepositoryInterface::deleteLogService()
     */
    public function deleteLogService(int $logId)
    {
        LogService::destroy($logId);
    }

    /**
     * @see LogServiceRepositoryInterface::createLogService()
     */
    public function createLogService(array $logDetails)
    {
        return LogService::create($logDetails);
    }

    /**
     * @see LogServiceRepositoryInterface::updateLogService()
     */
    public function updateLogService(int $logId, array $newDetails)
    {
        return LogService::whereId($logId)->update($newDetails);
    }

    /**
     * @see LogServiceRepositoryInterface::getCountLogService()
     */
    public function getCountLogService(array $conditions=[])
    {

//        return LogService::whereId($logId)->update($newDetails);
    }

}
