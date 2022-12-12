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
                    <!-- <a href="/survey" class="btn btn-dark">Take Survey</a> -->
                    <h3>Please finish all questions. Thank you</h3>
                </div>
            </div>

            <form action="/survey" method="post">
                @csrf

                @foreach($questions as $index => $question)
                    <div class="card  mt-4">
                        <div class="card-header">
                            <strong>{{ ($index+1)."." }}</strong> {{ $question['poll_name'] }}
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($question['options'] as $option)
                                    <label for="{{$option->option_id}}">
                                        <li class="list-group-item">
                                            <input type="radio" id="{{$option->option_id}}" name="feedbacks[{{$index}}][poll_option_id]" class="mr-2" value="{{$option->option_id}}">
                                            {{ $option->option }}
                                        </li>
                                    </label>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-4">Submit Survey</button>
            </form>

            
        </div>
    </div>
</div>
@endsection
