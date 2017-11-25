<div class="tab-content">
    <div id="profile" class="tab-pane fade in active">
        <div class="media" style="margin-bottom: 20px;">
            <div class="media-left media-top">
                <img alt="{{ $user->name }}" src="{{ $user->avatar }}" class="media-object img-circle"
                     style="width:140px">
            </div>
            <div class="media-body">
                <h4 class="media-heading"><strong>{{ $user->name }}</strong>
                    <ul class="social list-inline pull-right">
                        <li>
                            <a target="_blank" href="https://github.com/{{ $user->username }}"><i
                                        class="fa fa-github"></i></a>
                        </li>
                        @if($user->twitter_handle)
                            <li>
                                <a target="_blank" href="https://twitter.com/{{ $user->twitter_handle }}"><i
                                            class="fa fa-twitter"></i></a>
                            </li>
                        @endif
                        @if($user->url)
                            <li>
                                <a target="_blank" href="{{ $user->url }}"><i class="fa fa-rss"></i></a>
                            </li>
                        @endif
                    </ul>
                </h4>
                <p>{{ $user->bio }}</p>
            </div>
        </div>

        <table class="table table-condensed">
            <tbody>
            <tr>
                <td class="col-md-5"><strong>Email</strong></td>
                <td class="col-md-7"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
            </tr>
            <tr>
                <td class="col-md-5"><strong>Airport Code</strong></td>
                <td class="col-md-7"><a target="_blank"
                                        href="https://www.google.com/flights/#search;f={{ config('dotcfp.airport_code') }};t={{ $user->airport_code }};d={{ config('dotcfp.start_date') }};r={{ config('dotcfp.end_date') }}">{{ $user->airport_code }}</a>
                </td>
            </tr>
            <tr>
                <td class="col-md-5"><strong>Need Travel?</strong></td>
                <td class="col-md-7">{{ $user->desire_transportation ? 'yes' : 'no' }}</td>
            </tr>
            <tr>
                <td class="col-md-5"><strong>Need Accommodation?</strong></td>
                <td class="col-md-7">{{ $user->desire_accommodation ? 'yes' : 'no' }}</td>
            </tr>
            <tr>
                <td class="col-md-5"><strong>Company Sponsorship?</strong></td>
                <td class="col-md-7">{{ $user->is_sponsor ? 'yes' : 'no' }}</td>
            </tr>
            </tbody>
        </table>

        @if(auth()->user()->role === 'admin')
            <form method="POST" action="{{ route('users.roles', $user->id) }}" id="role" class="form-inline">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="sr-only" for="selectRole">Role</label>
                    <select id="selectRole" name="role" class="form-control">
                        <option {{ ($user->role === 'user') ? 'selected' : '' }} value="user">User</option>
                        <option {{ ($user->role === 'reviewer') ? 'selected' : '' }} value="reviewer">Reviewer</option>
                        <option {{ ($user->role === 'admin') ? 'selected' : '' }} value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        @endif
    </div>

    <div id="talks" class="tab-pane fade">
        <div class="list-group">
            @foreach($user->talks as $talk)
                <a href="{{ route('talks.show', $talk->slug) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">
                        @if($talk->is_favorite)<i class="fa fa-star"></i>@endif
                        {{ $talk->title }}
                        <small>(Average Vote: {{ $talk->average_vote }})</small>
                    </h4>
                    <p class="list-group-item-text">{{ $talk->description }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="clearfix"></div>