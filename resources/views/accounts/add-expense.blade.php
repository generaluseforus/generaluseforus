@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('save-expense') }}">
        @csrf
        <div class="mb-3">
            <label for="dateField" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" id="dateField">
        </div>

        <div class="mb-3">
            <label for="amount_spent" class="form-label">Amount Spent</label>
            <input type="text" name="amount_spent" class="form-control" id="amount_spent">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="description">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection