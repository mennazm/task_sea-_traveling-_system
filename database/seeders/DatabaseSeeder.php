<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Trip;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       
        
        $ali = Client::create(['name' => 'Ali']);
        $ahmed = Client::create(['name' => 'Ahmed']);
        $ibrahem = Client::create(['name' => 'Ibrahem']);

        
        $contract1 = Contract::create([
            'client_id' => $ali->id,
            'contract_number' => 'AV121',
            'start_date' => '2023-09-01',
            'end_date' => '2023-10-01',
            'trips_count' => 7,
        ]);

        $contract2 = Contract::create([
            'client_id' => $ahmed->id,
            'contract_number' => 'AC4246',
            'start_date' => '2024-01-01',
            'end_date' => '2024-05-23',
            'trips_count' => 10,
        ]);

        $contract3 = Contract::create([
            'client_id' => $ibrahem->id,
            'contract_number' => 'BB78754',
            'start_date' => '2023-12-05',
            'end_date' => '2024-09-05',
            'trips_count' => 3,
        ]);

        
        
        for ($i = 0; $i < 4; $i++) {
            Trip::create([
                'contract_id' => $contract1->id,
                'trip_date' => Carbon::parse('2023-09-01')->addDays($i * 7),
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Trip::create([
                'contract_id' => $contract2->id,
                'trip_date' => Carbon::parse('2024-01-01')->addDays($i * 7),
            ]);
        }

        Trip::create([
            'contract_id' => $contract3->id,
            'trip_date' => Carbon::parse('2023-12-05'),
        ]);
    }
}
