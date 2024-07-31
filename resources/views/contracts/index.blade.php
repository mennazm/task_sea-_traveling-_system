@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Contracts</h1>
        <a href="{{ route('contracts.create') }}" class="btn btn-primary">Add Contract</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Client name</th>
                <th>Contract number</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Trips total count</th>
                <th>Trips done</th>
                <th>Contract status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts as $contract)
                <tr>
                    <td>{{ $contract->client->name }}</td>
                    <td>{{ $contract->contract_number }}</td>
                    <td>{{ $contract->start_date }}</td>
                    <td>{{ $contract->end_date }}</td>
                    <td>{{ $contract->trips_count }}</td>
                    <td>{{ $contract->trips_done }}</td>
                    <td class="
                        @if($contract->status == 'Ended')
                            bg-danger text-white
                        @elseif($contract->status == 'Completed')
                            bg-success text-white
                        @elseif($contract->status == 'Current')
                            bg-info text-white
                        @else
                            bg-secondary text-white
                        @endif
                    ">
                        {{ $contract->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


