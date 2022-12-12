@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Survey Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Here is your survey report</h3>
                        </div>
                        <div class="col-md-4">
                        <a href="/home" class="btn btn-primary">Home Page</a>
                        </div>
                    </div>
                </div>
            </div>

            <form action="#">
                @csrf

                @foreach($records as $index => $question)
                    <div class="card  mt-4">
                        <div class="card-header">
                            <strong>{{ ($index+1)."." }}</strong> {{ $question->name }}
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                
                                <label>
                                    <li class="list-group-item">
                                        <input type="radio"  class="mr-2" disabled>
                                        {{ $question->option }}
                                    </li>
                                </label>
                                
                            </ul>
                        </div>
                    </div>
                @endforeach
            </form> 
        </div>
    </div>
</div>
@endsection
