<?php

namespace App\Console\Commands;

use App\Models\LogService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLogFileToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Log:ToDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all lines of log file to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $logFile = storage_path('logs/logs.txt');
        $batchRecords = 1000; // Number of rows to insert in each batch save
        $file = fopen($logFile, 'r');

        while (!feof($file)) {
            $lines = [];
            // Read a chunk of lines from the file
            for ($i = 0; $i < $batchRecords && !feof($file); $i++) {
                try {
                    $line = fgets($file);
                    $lines[] =$this->lines_log_to_db_field($line);
                } catch (\Exception $e) {
                    //Ignores the line that the datetime format is not correct
                    continue;
                }
            }

            // Perform bulk insertion within a transaction
            DB::transaction(function () use ($lines) {
                //Prevent insert duplicate record depend on unique fields.
                LogService::insertOrIgnore($lines);
            });
        }
        fclose($file);
        echo 'Completed!';
        return 1;
    }

    /**
     * @param $dateTime
     * @return string change format of log time in log.txt file to standard date_time format in database
     */
    private function change_format_dateTime_log($dateTime): string
    {
        return Carbon::createFromFormat('d/M/Y:H:i:s', $dateTime)->format('Y-m-d H:i:s');
    }

    /**
     * @param $line
     * @return array change line's of log to field's of database to save
     */
    private function lines_log_to_db_field($line)
    {
        [$service_name, $informationLog] = [explode(" - ", $line)[0], explode(" - ", $line)[1]];
        $startPosService = strpos($informationLog,' "');
        $endPosService = strpos($informationLog,'" ');
        $length = $endPosService - $startPosService;

        // Get Date time
        $dateTimeLog = $this->change_format_dateTime_log( substr($informationLog, 1, 20) );

        // Get service call
        $servicePattern = substr($informationLog, $startPosService + 2, $length - 2);
        // Get status code
        $statusCode = substr($informationLog, $endPosService + 2, $length + 3);

        return  [
            'service_name' => $service_name,
            'service_type_call' => $servicePattern,
            'status_code' => (int) $statusCode,
            'execute_time' => $dateTimeLog,
        ];

    }
}
