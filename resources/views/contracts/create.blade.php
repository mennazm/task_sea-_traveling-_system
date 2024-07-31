@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('contracts.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="" disabled selected>Select a client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please select a client.
            </div>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a start date.
            </div>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
            <div class="invalid-feedback">
                Please provide an valid end date.
            </div>
        </div>
        <div class="form-group">
            <label for="trips_count">Trips Count</label>
            <input type="number" name="trips_count" id="trips_count" class="form-control" required>
            <div class="invalid-feedback">
                Please provide the number of trips.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create Contract</button>
    </form>
</div>
@endsection

    