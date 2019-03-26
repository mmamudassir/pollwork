@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-head">
                        <h4 class="text-white"> poll </h4>
                    </div>
                    <div class="card-body">
                        <form id="myForm">
                            <ul>
                                <li>
                                    <h4> {!! $poll->question !!}</h4>
                                </li>
                                <li>
                                    @foreach($poll->options as $option)
                                        <div class="question"><input style="color: black" type="radio" name="poll_answer" class="radio-input" value="{!! $option->id !!}" />{!! $option->name !!}</div>
                                    @endforeach
                                </li>
                            </ul>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input name="create" type="submit" value="Vote Now" class="btn btn-primary pull-right mr-16">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#myForm").submit(function(e){
                e.preventDefault();
                if($("input[name='poll_answer']:checked").length != 0){
                    var poll_value = $("input[name='poll_answer']:checked").val();
                    var url = "{!! route('poll.vote') !!}";
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            poll_value: poll_value

                        },
                        beforeSend: function() {
                            $("#overlay").show();
                        },
                        success: function(responseHTML){
                            $("#overlay").hide();
                            $("#poll-content").html(responseHTML);
                        }
                    });

                }
            });
        });
    </script>
@endsection
