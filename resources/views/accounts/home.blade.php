@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <!-- <div class="card-header">{{ $userData->name }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <button class="btn btn-primary">
                            <a href="{{ route('index') }}" class="text-decoration-none text-white">{{ __('Index') }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection