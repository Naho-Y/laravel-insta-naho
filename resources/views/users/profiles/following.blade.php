@extends('layouts.app')

@section('title','Profile')


@section('content')
   @include('users.profiles.header')


    {{-- show all posts here --}}
        <div style="margin-top:100px">
            <h1 class="text-center mb-4">Following</h1>
            @if ($user->followings->isNotEmpty())
                <div class="container d-flex justify-content-center">
                    <ul class="list-group w-50">
                        @foreach ($user->followings as $following)
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                
                                <!-- icon -->
                                <div class="me-3">
                                    <a href="{{ route('profile.show', $following->followingUser->id) }}">
                                        @if ($following->followingUser->avatar)
                                            <img src="{{ $following->followingUser->avatar }}" alt="{{ $following->followingUser->name }}" class="rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </div>
            
                                <!-- name -->
                                <div>
                                    <p class="mb-0">{{ $following->followingUser->name }}</p>
                                </div>

                                <!-- follow -->
                                @if (Auth::user()->id == $following->followingUser->id)
                                    
                                @else
                                    <div class="ms-auto">
                                        <form action="{{route('follow.delete',$following->followingUser->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-secondary btn-sm">Unfollow</button>
                                        </form>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="container d-flex justify-content-center w-50">
                    No Followings
                </div>
            
            @endif

        </div>
@endsection
