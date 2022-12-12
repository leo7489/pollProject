@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Poll Question') }}</div>

                <div class="card-body">
                    <form action="/polls/{{ $poll->id }}" method="post">
                        @method('PUT')
                        @csrf

                        <input type="hidden" id="id" name="id" value="{{ $poll->id }}">

                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Question Name:</label>
                            <input type="text" class="form-control" 
                                id="name" value="{{ $poll->name }}" 
                                placeholder="Enter Questionnaire name" name="name" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" class="form-control" id="description" value="{{ $poll->description }}"
                                placeholder="Enter description for this questionnaire" name="description">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="start_date" class="form-label">Start Date: {{ $poll->start_date }}</label>
                            <input type="date" class="form-control" id="start_date" value="{{ $poll->start_date }}"
                                placeholder="Enter strat date" name="start_date" required>
                            @error('start_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="finish_date" class="form-label">Finish Date: {{ $poll->finish_date }}</label>
                            <input type="date" class="form-control" id="finish_date" value="{{ $poll->finish_date }}" 
                                placeholder="Enter finish date" name="finish_date" required>
                            @error('finish_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
