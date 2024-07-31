@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Client Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a client name
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Client</button>
    </form>
</div>
@endsection
