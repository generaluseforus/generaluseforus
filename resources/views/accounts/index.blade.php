@extends('layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center">
        <a href="{{ route('report') }}">Click here</a>
        <a href="{{ route('add-expense') }}">Click here</a>
    </div>
</div>
@endsection