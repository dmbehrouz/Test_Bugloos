<?php

namespace App\Repositories;

use App\Interfaces\LogServiceRepositoryInterface;
use App\Models\LogService;
use Illuminate\Support\Facades\DB;

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
     * @see LogServiceRepositoryInterface::getLogById()
     */
    public function getLogById(int $logId)
    {
        return LogService::findOrFail($logId);
    }

    /**
     * @see LogServiceRepositoryInterface::deleteLog()
     */
    public function deleteLog(int $logId)
    {
        LogService::destroy($logId);
    }

    /**
     * @see LogServiceRepositoryInterface::createLog()
     */
    public function createLog(array $logDetails)
    {
        return LogService::create($logDetails);
    }


    /**
     * @see LogServiceRepositoryInterface::getCountLog()
     */
    public function getCountLog(array $conditions = [])
    {
        if (count($conditions)){
            $query = DB::table('log_services')->selectRaw('COUNT(*) as count_log');
            return $this->prepareConditions($query,$conditions)->pluck('count_log')->first();
        }
        else
            return DB::table('log_services')->selectRaw('COUNT(*) as count_log')->pluck('count_log')->first();

    }

    /**
     * @param $query
     * @param $params
     * @return mixed
     * @description Add conditions of table wot query
     */
    private function prepareConditions($query, $params)
    {
        if( isset($params['startDate']) )
            $query->where('execute_time' , '>=' , $params['startDate']);

        if( isset($params['endDate']) )
            $query->where('execute_time' , '<=' , $params['endDate']);

        if( isset($params['statusCode']) )
            $query->where('status_code' , '=' , $params['statusCode']);

        if( isset($params['serviceNames']) )
            $query->whereIn('service_name', $params['serviceNames']);

        return $query;
    }

}
