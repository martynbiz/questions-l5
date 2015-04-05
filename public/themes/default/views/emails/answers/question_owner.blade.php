Hi {{ $answer->question->user->name }},

{{ $answer->user->name }} gave an answer for your question:

{{ $answer->question->title }}
{{ Config::get('app.url') }}/{{ $answer->question->id }}/{{ $answer->question->slug }}

Best regards,
JapanTravel team