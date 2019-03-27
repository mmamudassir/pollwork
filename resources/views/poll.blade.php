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
                        <div id="success-box" class="alert alert-success text-center m-16 dp-none">
                            <a class="close hide-me">&times;</a>
                            <span class="success-msg">
                            </span>
                        </div>
                        <div id="error-box" class="alert alert-danger text-center m-16 dp-none">
                            <a class="close hide-me">&times;</a>
                            <span class="error-msg">
                            </span>
                        </div>
                        <form id="myForm">
                            <ul>
                                <li>
                                    <h4 class="mb-0"> {!! $poll->question !!}</h4>
                                </li>
                                <li class="voting-li-item">
                                    @foreach($poll->options as $option)
                                        <div class="question">
                                            <input type="radio" name="poll_answer" class="radio-input" value="{!! $option->id !!}" />{!! $option->name !!}
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input name="create" type="submit" value="Vote Now" class="btn btn-primary pull-right mr-16">
                        </form>
                        <ul class="voter-result-list dp-none">
                            <li>
                                <h4 class="mb-0"> {!! $poll->question !!}</h4>
                            </li>
                            <li class="votes-result">

                            </li>
                        </ul>
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

            $('.hide-me').click(function () {
                $(this).parent().hide();
            });

            $("#myForm").submit(function(e){
                e.preventDefault();
                if($("input[name='poll_answer']:checked").length != 0){
                    $('.alert').hide();
                    var poll_value = $("input[name='poll_answer']:checked").val();
                    var url = "{!! route('poll.vote') !!}";
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            poll_value: poll_value

                        },
                        success:function(data){
                            if(typeof data.poll !== 'undefined'){
                                $("#myForm").hide();
                                $(".votes-result").html(data.poll)
                                $(".voter-result-list").show();
                                $(".success-msg").text(data.message);
                                $(".success-msg").removeClass('dp-none');
                                $("#success-box").show();
                            }else{
                                $(".error-msg").text(data.message);
                                $("#error-box").show();
                            }

                     /*       $('.broker_row_' + row).html(data.broker);*/

                        }

                    });

                }
                else{
                    $(".error-msg").text("Please select an option for voting!");
                    $("#error-box").show();
                }
            });
        });
    </script>
@endsection
