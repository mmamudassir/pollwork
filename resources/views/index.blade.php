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
                            {{--
                             displaying all polls on main page
                            --}}
                            @if(count($polls)  < 1 || is_null($polls))
                                <li> No polls available </li>
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
