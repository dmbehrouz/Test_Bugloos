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
    public function getLogById(int $logId);

    /**
     * @return mixed
     * @param int $logId
     * @description delete record with id
     */
    public function deleteLog(int $logId);

    /**
     * @return mixed
     * @param array $logDetails
     * @description create new log record
     */
    public function createLog(array $logDetails);

     /**
     * @return mixed
     * @param array $conditions
     * @description get count of records based on conditions
     */
    public function getCountLog(array $conditions = []);

}
