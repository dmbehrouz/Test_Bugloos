<?php

namespace Tests\Unit;

use App\Models\LogService;
use App\Models\User;
use Tests\TestCase;

class LogsControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_log_service_example()
    {
        $user = User::factory()->create();
        $token = $user->createToken('Test Token')->plainTextToken;
        $logs = LogService::factory()->count(10)->create();
        $this->withHeader('Authorization', 'Bearer ' . $token)->get('/logs/count');

        //Sample Name
        [$service_name_record1,$service_name_record2] = [
            $logs[0]->service_name, $logs[5]->service_name
        ];

        //Sample status_code
        $status_code_record1 = $logs[9]->status_code;

        //Without filter
        $response = $this->get("/logs/count");
        $response->assertOk();
        $response->assertJson(['count' => 10]);

        //Filter by serviceNames
        $response = $this->get("/logs/count?serviceNames=$service_name_record1,$service_name_record2");
        $response->assertOk();
        $response->assertJson(['count' => is_int($response['count']) && $response['count'] >= 1]);

        $startDate = $logs->min('execute_time');
        $endDate = $logs->max('execute_time');
        //Filter by startDate and endDate
        $response = $this->get("/logs/count?startDate=$startDate&endDate=$endDate");
        $response->assertOk();
        $response->assertJson(['count' => is_int($response['count']) && $response['count'] > 1]);

//        Filter by startDate and endDate
        $response = $this->get("/logs/count?statusCode=$status_code_record1");
        $response->assertOk();
        $response->assertJson(['count' => is_int($response['count']) && $response['count'] >= 1]);

//        All filter together
        $response = $this->get("/logs/count?serviceNames=$service_name_record1&startDate=$startDate&endDate=$endDate&statusCode=$status_code_record1");
        $response->assertOk();
        $response->assertJson(['count' => is_int($response['count']) && $response['count'] >= 1]);

        //Delete all sample record
        $logIds = $logs->pluck('id')->toArray();
        LogService::destroy($logIds);

        //Delete user created for test
        $userId = $user->pluck('id')->toArray();
        User::destroy($userId);
    }
}
