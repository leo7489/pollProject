@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="mb-4 mt-4">Create New Poll Options</h4>
            <div class="card">
                <div class="card-header">
                    Survey Title: {{ $poll->name }}
                </div>

                <div class="card-body">
                    
                        <form action="/pollOptions/{{ $poll->id }}" method="post">
                            @method('PUT')    
                            @csrf

                            @foreach($poll_options as $index => $poll_option)
                                <div class="form-group">
                                    <input type="hidden" id="option_ids" name="option_ids[].id" value="{{ $poll_option->id }}">

                                    <div class="mb-3 mt-3">
                                        <label for="option{{ $index +1 }}" class="form-label">Option {{ $index + 1 }}:</label>

                                        <input type="text" class="form-control" 
                                            id="option{{ $index + 1 }}" placeholder="Enter option {{ $index +1}}"
                                            value="{{ $poll_option->option }}" 
                                            name="options[].option" required >
                                        @error('options.0')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> 
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-accent">Create</button>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
