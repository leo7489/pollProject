@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Survey Report Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                </div>
            </div>

            
            <div class="card  mt-4">
                <div class="card-header">
                    <div class="col-md-9">
                        <strong>{{ $poll->name }}</strong>
                        <br><small>{{ $poll->description }}</small>
                    </div>   
                </div>

                @foreach($poll->pollOptions as $option)
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>{{ $option->option }}</div>
                                <div>{{ $option->pollResults->count() }}</div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
            <br>
            <a href="/home" class="btn btn-primary mt-6">Home Page</a>
        </div>
    </div>
</div>
@endsection
