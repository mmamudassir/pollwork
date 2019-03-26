@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container-box col-md-8 col-md-offset-2">
                @include('includes.alerts')
                <form method="POST" action="{!! route('poll.save') !!}">
                {{ csrf_field() }}
                    <h1 class="text-center"> Create a poll </h1>
                <!-- Question Input -->
                    <div class="form-group">
                        <label for="question">Question:</label>
                        <textarea id="question" name="question"  cols="30" rows="2" class="form-control" placeholder="Example: Who is the best footballer in the world?">{{ old('question') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Options</label>
                        <ul id="options">
                            <li>
                                <input id="option_1" type="text" name="options[0]" class="form-control add-input" value="{{ old('options.0') }}" placeholder="Example: Cristiano Ronaldo"/>
                            </li>
                            <li>
                                <input id="option_2" type="text" name="options[1]" class="form-control add-input" value="{{ old('options.1') }}" placeholder="Please enter your option" />
                            </li>
                            <li>
                                <input id="option_3" type="text" name="options[2]" class="form-control add-input" value="{{ old('options.2') }}" placeholder="Please enter your option"/>
                            </li>
                            <li>
                                <input id="option_4" type="text" name="options[3]" class="form-control add-input" value="{{ old('options.3') }}" placeholder="Please enter your option" />
                            </li>
                            <li>
                                <input id="option_5" type="text" name="options[4]" class="form-control add-input" value="{{ old('options.4') }}" placeholder="Please enter your option"/>
                            </li>
                        </ul>

                    </div>

                    <div class="form-group">
                        <input name="create" type="submit" value="Create" class="btn btn-primary create-btn"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
