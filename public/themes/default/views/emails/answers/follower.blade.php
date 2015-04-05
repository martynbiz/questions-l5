Hi {{ $follow->user->name }},

{{ $answer->user->name }} gave an answer to a question you are following:

{{ $answer->question->title }}
{{ Config::get('app.url') }}/{{ $answer->question->id }}/{{ $answer->question->slug }}

Best regards,
JapanTravel team