@if($questions->count())
    @foreach($questions as $question)
        <div class="question">
            <h2><a href="{{ url($question->id) }}">{{$question->title}}</a></h2>
            <div class="info">Asked by {{$question->user->name}} | {{$question->created_at_formatted}}</div>
            
            <div class="buttons">
                <a href="#" class="btn btn-default btn-xs">Follow | {{$question->follows->count()}}</a>
                <a href="#" class="btn btn-default btn-xs">Answers | {{$question->answers->count()}}</a>
                
                @foreach($question->tags as $tag)
                    <a href="{{url('tags/' . $tag->id . '/' . $tag->slug)}}" class="badge">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    @endforeach
@else
    <p>There are currently no questions</p>
@endif