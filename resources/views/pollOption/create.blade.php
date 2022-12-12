@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="mb-4 mt-4">Create New Poll Options</h4>
            <div class="card">
                <div class="card-header">Survey Title: {{ $poll->name }}</div>

                <div class="card-body">
                    <form action="/poll/{{ $poll->id }}/pollOptions" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <input type="hidden" id="poll_id" name="poll_id" value="{{ $poll->id }}">

                            <div class="mb-3 mt-3">
                                <label for="option1" class="form-label">Option 1:</label>
                                <input type="text" class="form-control" id="option1" placeholder="Enter option 1" name="options[]" required>
                                @error('options.0')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="option2" class="form-label">Option 2:</label>
                                <input type="text" class="form-control" id="option2" placeholder="Enter option 2" name="options[]" required>
                                @error('options.1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="option3" class="form-label">Option 3:</label>
                                <input type="text" class="form-control" id="option3" placeholder="Enter option 3" name="options[]" required>
                                @error('options.2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="option4" class="form-label">Option 4:</label>
                                <input type="text" class="form-control" id="option4" placeholder="Enter option 4" name="options[]" required>
                                @error('options.3')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
