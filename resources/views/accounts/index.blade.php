@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <button class="btn btn-primary">
                            <a href="{{ route('report') }}" class="text-decoration-none text-white">{{ __('View Report') }}</a>
                        </button>
                        <button class="btn btn-primary">
                            <a href="{{ route('add-expense') }}" class="text-decoration-none text-white">{{ __('Add Expense') }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection