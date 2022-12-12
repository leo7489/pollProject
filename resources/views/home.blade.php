@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Main Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('isAdmin')
                        <a href="/poll/create" class="btn btn-accent">Create New Poll</a>
                    @endcan

                    @can('isUser')
                        @if(!$hasDone)
                            <a href="/survey" class="btn btn-primary">Take Survey</a>
                        @endif

                        @if($hasDone)
                            <h4>Congratulations, you have finished the survey.</h4>
                            <a href="/survey/report" class="btn btn-primary">Check My Survey</a>
                        @endif
                    @endcan
                    
                </div>
            </div>

            @can('isAdmin')
                @foreach($questions as $index => $question)
                    <div class="card  mt-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <strong> {{ ($index+1).". "}}</strong>{{ $question['poll_name'] }}
                                    <br><small>{{ $question['description'] }}</small>
                                </div>
                                
                                <div class="col-md-3 mt-1">
                                    @if(!in_array($question['poll_id'], $no_edit))
                                        <a href="/polls/edit/{{ $question['poll_id'] }}" class="btn btn-secondary">Edit This Poll Question</a>
                                    @endif

                                    <form method="POST" action="/polls/{{ $question['poll_id'] }}">
                                        @method('DELETE') 
                                        @csrf
                                        <input type="hidden" id="poll_id" name="poll_id" value="{{ $question['poll_id'] }}">
                                        <button type="submit" class="btn btn-danger mt-1">Delete Poll & Choices</button>
                                    </form>

                                    @if(!in_array($question['poll_id'], $no_edit))
                                        <a href="/pollOptions/{{ $question['poll_id'] }}/edit" class="btn btn-secondary mt-1">Edit Following Options</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($question['options'] as $option)
                                    <li class="list-group-item">{{ $option->option }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            @endcan  
        </div>
    </div>
</div>
@endsection
