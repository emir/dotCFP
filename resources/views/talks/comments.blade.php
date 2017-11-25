<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Comments <small>({{ count($talk->comments) }})</small></h4>
    </div>
    <div class="panel-body">
        <ul class="media-list">
            @forelse($talk->comments as $comment)
                <li class="media">
                    <div class="media-left">
                        <a href="{{ route('users.show', $comment->user_id) }}"
                           data-toggle="modal"
                           data-target="#userModal"
                           data-remote="false">
                            <img width="70px" class="media-object img-circle" src="{{ $comment->user->avatar }}"
                                 alt="{{ $comment->user->name }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="{{ route('users.show', $comment->user_id) }}" data-toggle="modal"
                               data-target="#userModal" data-remote="false">{{ $comment->user->name }}</a>
                            <small>{{ $comment->created_at->format('d-m-Y H:i') }}</small>

                            @if(auth()->user()->role == 'admin' || auth()->id() == $comment->user_id)
                            <span class="pull-right">
                                <a href="{{ route('comments.destroy', $comment->id) }}"><i class="fa fa-times"></i></a>
                            </span>
                            @endif
                        </h4>
                        <p>{{ $comment->comment }}</p>
                    </div>
                </li>
            @empty
                <p class="text-muted">There are no comments.</p>
            @endforelse
        </ul>

        <hr>

        <div class="comment">
            <p>You're logged in as <strong>{{ auth()->user()->name }}</strong></p>

            {!! BootForm::open()->action(route('talks.comments', $talk->slug)) !!}

            {!! BootForm::textarea('Comment', 'comment')->rows(3) !!}

            {!! BootForm::submit('Submit', 'btn-primary')->addClass('pull-right') !!}

            {!! BootForm::close() !!}

        </div>
    </div>
</div>
