@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $poll->name }}</div>

                <div class="card-body">
                    <a href="/poll/{{ $poll->id }}/pollOption/create" class="btn btn-primary">Add New Poll Options</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
