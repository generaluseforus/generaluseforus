@extends('layouts.app')

@section('content')
<div class="container">
    @if($action == 'add')
    <form method="POST" action="{{ route('save-expense') }}">
    @else
    <form method="POST" action="{{ route('update-expense', $actionData[0]->id) }}">
    @endif
        @csrf
        <div class="mb-3">
            <label for="dateField" class="form-label">Date</label>
            <input type="date" name="date" value="<?php if($actionData) { echo $actionData[0]->date; } ?>" class="form-control" id="dateField">
        </div>

        <div class="mb-3">
            <label for="amount_spent" class="form-label">Amount Spent</label>
            <input type="text" name="amount_spent" value="<?php if($actionData) { echo $actionData[0]->amount_spent; } ?>" class="form-control" id="amount_spent">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" value="<?php if($actionData) { echo $actionData[0]->description; } ?>" class="form-control" id="description">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection