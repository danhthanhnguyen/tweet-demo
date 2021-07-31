@extends('layout.home')

@section('content')
    @if ($user)
        <section class="user-profile">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="user-avatar">
                            <img class="user-profile-avatar rounded-circle" src="/storage/{{ $user[0]->avatar }}" alt="">
                        </div>
                        <div class="user-name text-center">
                            <h5 class="user-profile-name">{{ $user[0]->full_name }}</h5>
                        </div>
                        <div class="user-bio text-center">
                            <h5 class="user-profile-bio">{{ $user[0]->bio }}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            @if ($user[0]->location)
                                <div class="location d-flex align-items-center mr-1 ml-1">
                                    <span class="location-name-country">
                                        <svg viewBox="0 0 24 24" fill="#6e767d" aria-hidden="true"><g><path d="M12 14.315c-2.088 0-3.787-1.698-3.787-3.786S9.913 6.74 12 6.74s3.787 1.7 3.787 3.787-1.7 3.785-3.787 3.785zm0-6.073c-1.26 0-2.287 1.026-2.287 2.287S10.74 12.814 12 12.814s2.287-1.025 2.287-2.286S13.26 8.24 12 8.24z"></path><path d="M20.692 10.69C20.692 5.9 16.792 2 12 2s-8.692 3.9-8.692 8.69c0 1.902.603 3.708 1.743 5.223l.003-.002.007.015c1.628 2.07 6.278 5.757 6.475 5.912.138.11.302.163.465.163.163 0 .327-.053.465-.162.197-.155 4.847-3.84 6.475-5.912l.007-.014.002.002c1.14-1.516 1.742-3.32 1.742-5.223zM12 20.29c-1.224-.99-4.52-3.715-5.756-5.285-.94-1.25-1.436-2.742-1.436-4.312C4.808 6.727 8.035 3.5 12 3.5s7.192 3.226 7.192 7.19c0 1.57-.497 3.062-1.436 4.313-1.236 1.57-4.532 4.294-5.756 5.285z"></path></g></svg>
                                        {{ $user[0]->location }}
                                    </span>
                                </div>
                            @endif
                            @if ($user[0]->birthday)
                                <div class="birthday d-flex align-items-center mr-1 ml-1">
                                    <span class="user-birthday">
                                        <svg viewBox="0 0 24 24" fill="#6e767d" aria-hidden="true"><g><path d="M7.75 11.083c-.414 0-.75-.336-.75-.75C7 7.393 9.243 5 12 5c.414 0 .75.336.75.75s-.336.75-.75.75c-1.93 0-3.5 1.72-3.5 3.833 0 .414-.336.75-.75.75z"></path><path d="M20.75 10.333c0-5.01-3.925-9.083-8.75-9.083s-8.75 4.074-8.75 9.083c0 4.605 3.32 8.412 7.605 8.997l-1.7 1.83c-.137.145-.173.357-.093.54.08.182.26.3.46.3h4.957c.198 0 .378-.118.457-.3.08-.183.044-.395-.092-.54l-1.7-1.83c4.285-.585 7.605-4.392 7.605-8.997zM12 17.917c-3.998 0-7.25-3.402-7.25-7.584S8.002 2.75 12 2.75s7.25 3.4 7.25 7.583-3.252 7.584-7.25 7.584z"></path></g></svg>
                                        Born {{ date_format(date_create($user[0]->birthday), 'Y') }}
                                    </span>
                                </div>
                            @endif
                            <div class="joined d-flex align-items-center mr-1 ml-1">
                                <span class="user-joined">
                                    <svg viewBox="0 0 24 24" fill="#6e767d" aria-hidden="true"><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                                    Joined {{ date_format(date_create($user[0]->created_at), 'M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="tweets-following-follower-counter d-flex justify-content-center pt-1">
                            <div class="user-tweets-counter text-center pr-2 pl-2">
                                <span class="user-profile-tweets-counter">
                                    {{ $tweets->count() }}
                                    @if ($tweets->count() > 1)
                                        Tweets
                                    @else
                                        Tweet
                                    @endif
                                </span>
                            </div>
                            <div class="user-following-counter text-center pr-2 pl-2">
                                <span class="user-profile-following-counter">
                                    {{ $following." Following" }}
                                </span>
                            </div>
                            <div class="user-follower-counter text-center pr-2 pl-2">
                                <span class="user-profile-follower-counter">
                                    {{ $follower }}
                                    @if ($follower > 1)
                                        Followers
                                    @else
                                        Follower
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="following-or-update">
                            @if (Auth::user()->name == $user[0]->name)
                                <a href="{{ route('update') }}" class="btn btn-light action-button text-light btn-control btn-update-profile" role="button"><span class="actions update-profile">Update profile</span></a>
                            @else
                                <button aria-label="{{ $user[0]->name }}" class="btn btn-light action-button btn-control btn-follow text-light follow" role="button">
                                    <span class="actions following">
                                        @if ($followed->count())
                                            Following
                                        @else
                                            Follow
                                        @endif
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="list-tweet mt-2">
            <div class="container">
                @if ($tweets->count())
                    @foreach ($tweets as $tweet)
                        {{-- <x-tweet :tweet="$tweet"/> --}}
                        <div class="jumbotron p-4">
                            <div class="media">
                                <a href="{{ route('user', ['user' => $tweet->name]) }}" class="mr-3 avatar">
                                    <img class="avatar-user align-self-start rounded-circle" src="/storage/{{ $user[0]->avatar }}" alt="">
                                </a>
                                <div class="media-body">
                                    <a href="{{ route('user', ['user' => $tweet->name]) }}" class="full-name-tweet mt-0"><span>{{ $tweet->full_name }}</span></a>
                                    <a href="{{ route('user', ['user' => $tweet->name]) }}" class="user-name-tweet mt-0"><span>{{ "@".$tweet->name }}</span></a>
                                    <small class="time-tweet">{{ \Carbon\Carbon::parse($tweet->created_at)->diffForHumans() }}</small>
                                    <p class="content-tweet">{{ $tweet->tweet }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="like-tweet">
                                    @csrf
                                    @if($tweet->like_id)
                                        <input type="checkbox" class="checkbox" id="{{ $tweet->id }}" checked />
                                    @else
                                        <input type="checkbox" class="checkbox" id="{{ $tweet->id }}" />
                                    @endif
                                    <label class="d-flex" id="heart" for="{{ $tweet->id }}">
                                        <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                                                <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="#AAB8C2"/>
                                                <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/>
                                                <g id="grp7" opacity="0" transform="translate(7 6)">
                                                    <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                                                    <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                                                </g>
                                                <g id="grp6" opacity="0" transform="translate(0 28)">
                                                    <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                                                    <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                                                </g>
                                                <g id="grp3" opacity="0" transform="translate(52 28)">
                                                    <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                                                    <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                                                </g>
                                                <g id="grp2" opacity="0" transform="translate(44 6)">
                                                    <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                                                    <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                                                </g>
                                                <g id="grp5" opacity="0" transform="translate(14 50)">
                                                    <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                                                    <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                                                </g>
                                                <g id="grp4" opacity="0" transform="translate(35 50)">
                                                    <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                                                    <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                                                </g>
                                                <g id="grp1" opacity="0" transform="translate(24)">
                                                    <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                                                    <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </label>
                                </div>
                                <span class="like-counter d-flex align-items-center">
                                    @foreach($likes as $like)
                                        @if($tweet->id == $like->tweet_id)
                                            {{ $like->like_counter }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            @if (Auth::user()->id === $tweet->user_id)
                                <div class="delete-tweet d-flex justify-content-end">
                                    <svg class="trash" version="1.1" fill="#ff0000" id="{{ $tweet->id }}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M64,341.333C64,364.907,83.093,384,106.667,384h170.667C300.907,384,320,364.907,320,341.333v-256H64V341.333z"/>
                                                    <polygon points="266.667,21.333 245.333,0 138.667,0 117.333,21.333 42.667,21.333 42.667,64 341.333,64 341.333,21.333 			"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>There are no tweets</p>
                @endif
            </div>
        </section>
    @else
        <h4 class="text-center p-3">This account doesn’t exist</h4>
    @endif
    
@endsection
@push('scripts')
    <script src="{{ asset('js/follow.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
@endpush
@push('title')
    <title>{{ $user[0]->full_name }}</title>
@endpush