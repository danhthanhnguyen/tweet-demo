@extends('layout.home')

@section('content')
    <section class="new-tweet">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('tweet') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="tweet-area" name="tweet" rows="5" placeholder="What's happening?"></textarea>
                        </div>
                        {{-- <div class="form-group"> --}}
                        <button type="submit" class="float-right btn btn-light action-button text-light btn-control btn-tweet" role="button"><span class="actions">Tweet</span></button>
                        {{-- </div> --}}
                    </form>
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
                            <a href="{{ route('user', ['user' => $tweet->name]) }}" class="mr-3 avatar rounded-circle">
                                <img class="avatar-user align-self-start rounded-circle" src="/storage/{{ $tweet->avatar }}" alt="">
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
@endsection
@push('scripts')
    <script src="{{ asset('js/like.js') }}"></script>
@endpush