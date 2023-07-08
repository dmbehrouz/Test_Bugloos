<?php

namespace App\Interfaces;

interface LogServiceRepositoryInterface
{
    /**
     * @return mixed
     * @description get all data
     */
    public function getAll();

    /**
     * @return mixed
     * @param int $logId
     * @description get data with id
     */
    public function getLogServiceById(int $logId);

    /**
     * @return mixed
     * @param int $logId
     * @description delete record with id
     */
    public function deleteLogService(int $logId);

    /**
     * @return mixed
     * @param array $logDetails
     * @description create new log record
     */
    public function createLogService(array $logDetails);

    /**
     * @return mixed
     * @param int $logId
     * @param array $newDetails
     * @description update existing record with id
     */
    public function updateLogService(int $logId, array $newDetails);

    /**
     * @return mixed
     * @param array $conditions
     * @description get count of records based on conditions
     */
    public function getCountLogService(array $conditions = []);

}
