<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Trip;
use Illuminate\Support\Carbon;
class ContractController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        return view('contracts.create', compact('clients'));
    }

    public function index()
    {
        $contracts = Contract::with('client')->get();
        return view('contracts.index', compact('contracts'));
    }
   

    
    
    public function store(Request $request)
    {
        
        
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'trips_count' => 'required|integer|min:1',
        ]);
    
        
        
        $latestContract = Contract::latest('id')->first();  
        $lastNumber = $latestContract ? intval(substr($latestContract->contract_number, 3)) : 0;
        $newContractNumber = 'ABC' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    
        
        $contract = Contract::create([
            'client_id' => $validated['client_id'],
            'contract_number' => $newContractNumber,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'trips_count' => $validated['trips_count'],
        ]);
    
        
        
        $interval = Carbon::parse($validated['start_date'])->diffInDays($validated['end_date']) / max($validated['trips_count'], 1);
        for ($i = 0; $i < $validated['trips_count']; $i++) {
            Trip::create([
                'contract_id' => $contract->id,
                'trip_date' => Carbon::parse($validated['start_date'])->addDays($i * $interval)->format('Y-m-d'),
            ]);
        }
    
        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }
    public function generateReport(Request $request)
{
    $fromDate = Carbon::parse($request->input('from_date'));
    $toDate = Carbon::parse($request->input('to_date'));


    
    $contracts = Contract::with(['client', 'trips'])
        ->where(function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('start_date', [$fromDate, $toDate])
                  ->orWhereBetween('end_date', [$fromDate, $toDate]);
        })
        ->orWhereHas('trips', function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('trip_date', [$fromDate, $toDate]);
        })
        ->get();

   
        
    $report = $contracts->map(function ($contract) {
        return [
            'client_name' => $contract->client->name,
            'contract_number' => $contract->contract_number,
            'start_date' => $contract->start_date->format('Y-m-d'),
            'end_date' => $contract->end_date->format('Y-m-d'),
            'trips_total_count' => $contract->trips_count,
            'trips_done' => $contract->trips_done,
            'contract_status' => $contract->status,
        ];
    });

    return response()->json($report);
}


        

}
