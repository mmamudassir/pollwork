@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-head">
                        <h4 class="text-white">Current Active polls </h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            @if(count($polls) == 0)
                                <li> No Request to show </li>
                            @else
                                @foreach($polls as $poll)
                                    <li>
                                        <a href="{!!  route('poll', ['poll_id'=>$poll->id]) !!}">
                                            <article class="message">
                                                <p class="mb-0">
                                                    {!! $poll->question !!}
                                                </p>
                                            </article>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="text-center">
                        {!! $polls->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
