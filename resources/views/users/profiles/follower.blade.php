@extends('layouts.app')

@section('title','Profile')


@section('content')
   @include('users.profiles.header')


    {{-- show all posts here --}}
        <div style="margin-top:100px">
            <h1 class="text-center mb-4">Follower</h1>
            @if ($user->followers->isNotEmpty())
                <div class="container d-flex justify-content-center">
                    <ul class="list-group w-50">
                        @foreach  ($user->followers as $follower)
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                
                                <!-- icon -->
                                <div class="me-3">
                                    <a href="{{ route('profile.show', $follower->followerUser->id) }}">
                                        @if ($follower->followerUser->avatar)
                                            <img src="{{ $follower->followerUser->avatar }}" alt="{{ $follower->followerUser->name }}" class="rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </div>
            
                                <!-- name -->
                                <div class="me-3">
                                    <p class="mb-0">{{ $follower->followerUser->name }}</p>
                                </div>

                                <!-- follow -->
                                @if (Auth::user()->id == $follower->followerUser->id)
                                    
                                @else
                                    <div class="ms-auto">
                                        @if ($follower->followerUser->isFollowed())
                                            <form action="{{route('follow.delete',$follower->followerUser->id)}}" method="post" class="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-secondary btn-sm">Unfollow</button>
                                            </form>
                                        @else
                                            <form action="{{route('follow.store',$follower->followerUser->id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn text-primary btn-sm">Follow</button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="container d-flex justify-content-center w-50">
                    No Followers
                </div>

            @endif

        </div>
@endsection
