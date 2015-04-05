<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation"@if ($active=='Newest') class="active"@endif>
            <a href="{{url('/newest')}}#newest" aria-controls="newest" role="tab" data-toggle="tab">Newest</a>
        </li>
        <li role="presentation"@if ($active=='Popular') class="active"@endif>
            <a href="{{url('/popular')}}#popular" aria-controls="popular" role="tab" data-toggle="tab">Popular</a>
        </li>
        <li role="presentation"@if ($active=='Unanswered') class="active"@endif>
            <a href="{{url('/unanswered')}}#unanswered" aria-controls="unanswered" role="tab" data-toggle="tab">Unanswered</a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in @if ($active=='Newest') active @endif" id="newest">
            @include ('questions.partials.list', ['questions' => $newest])
        </div>
        <div role="tabpanel" class="tab-pane fade in @if ($active=='Popular') active @endif" id="popular">
            @include ('questions.partials.list', ['questions' => $popular])
        </div>
        <div role="tabpanel" class="tab-pane fade in @if ($active=='Unanswered') active @endif" id="unanswered">
            @include ('questions.partials.list', ['questions' => $unanswered])
        </div>
    </div>
</div>

<a href="{{url('ask')}}" class="btn btn-default">Ask a question</a>