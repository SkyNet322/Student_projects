<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Models\DataSpecial;

class LoadDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'загрузка данных';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reader = Reader::createFromPath(storage_path('data/exportimport.csv'), 'r');
		$reader->setDelimiter(';');
		//$csv->setHeaderOffset(0);
        $records = $reader->getRecords();
        $counter = 0;
        foreach ($records as $record) {
            $data = new DataSpecial();
            $data->GUID = $record[0] ?? null;
            $data->name = $record[1] ?? null;
            $data->status_IS = $record[2] ?? null;
            $data->criticality = $record[3] ?? null;
            $data->expert = $record[4] ?? null;
            $data->responsible_for_development = $record[5] ?? null;
            $data->responsible_for_maintenance = $record[6] ?? null;
            $data->functions_IS = $record[7] ?? null;
            $data->producer_IS = $record[8] ?? null;
            $data->domain = $record[9] ?? null;
            $data->subdomain = $record[10] ?? null;
            $data->save(); 
            $counter++; 
        }
        
        $this->info($counter);
        //return 1;
    }
}
