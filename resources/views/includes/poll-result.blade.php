
{{-- displaying pole results and passing to other view --}}
@foreach($votes_result as $option_result=>$vote )
    <div class="answer-rating">
        <div class="row">
            <div class="col-md-9">
                <span class="answer-text">{!! $vote['casted_option'] !!}</span>
            </div>
            <div class="col-md-3">
                <span class="answer-count">{!! $vote['casted_percentages'].' %' !!}</span>
            </div>
        </div>
    </div>
@endforeach