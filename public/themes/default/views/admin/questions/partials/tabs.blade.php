<ul class="nav nav-tabs">
    <li role="presentation" @if ($page) class="active" @endif>
        <a href="{{route('admin.questions.index')}}">List</a>
    </li>
    @if ($total_pending > 0)
        <li role="presentation" @if ($page == 'Approve') class="active" @endif>
            <a href="{{route('admin.questions.approve')}}">Approve</a>
        </li>
    @endif
</ul>