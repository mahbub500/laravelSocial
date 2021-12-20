@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h3>{{$question->title}}</h3>
                            <h3 class="ml-auto">
                                <a class="btn btn-outline-secondary" href="{{route('questions.index')}}">
                                    Back To All Question
                                </a>
                            </h3>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column votes-control">
                            <a class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1205</span>
                            <a class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a class="favorite mt-3 fabs">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="faborite">
                                    1234
                                </span>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Questioned  {{$question->create_date}}
                                </span>
                                <div class="media">
                                    <a class="pr-2" href="{{$question->user->url}}">
                                        <img src="{{$question->user->avatar}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{$question->user->url}}">
                                            {{$question->user->name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------------------ Answer --------------------->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>Your Answer</h2>
                        @include('layouts._message')
                        <form action="{{route('questions.answers.store',$question->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea rows="7" class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}" name="body"></textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-secondary">Submit</button>
                            </div>
                        </form>
                        <hr>
                        <h3>{{$question->answers_count}}
                            {{str_plural('Answers',$question->answers_count)}}
                        </h3>
                    </div>
                    <hr>
                    @foreach($question->answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column votes-control">
                            <a class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1205</span>
                            <a class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a class="favorite mt-3 {{$answer->status}}"
                               onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit()">
                                <i class="fas fa-check fa-2x"></i>
                                <form action="{{route('accept.answers',$answer->id)}}" id="accept-answer-{{$answer->id}}" style="display: none" method="post">
                                    @csrf
                                </form>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-md-4">
                                     <div class="ml-auto">
                                   @can('update', $answer)
                                   <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-sm btn-outline-primary">
                                       Edit
                                   </a>
                                   @endcan
                              
                              @can('delete', $answer)
                               <form class="form-delete" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" method="post">
                                   @method('DELETE')
                                   @csrf
                                   <button onclick="return confirm('Are You Sure')" class="btn btn-sm btn-outline-secondary" type="submit">
                                       Delete
                                   </button>
                               </form>
                               @endcan
                                </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                <span class="text-muted">
                                    Answered  {{$answer->create_date}}
                                </span>
                                <div class="media">
                                    <a class="pr-2" href="{{$answer->user->url}}">
                                        <img src="{{$answer->user->avatar}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{$answer->user->url}}">
                                            {{$answer->user->name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
