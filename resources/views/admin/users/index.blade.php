@extends('layouts.app')

@section('title','Admin::Users')

@section('content')

<table class="table table-hover align-middle bg-white border text-secondry">
    <thead class="small table-success text-secondry">
        <th></th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>CREATED AT</th>
        <th>STATUS</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($all_users as $user)
            <tr>
                <td>
                    @if ($user->avatar)
                        <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle d-block avatar-md mx-auto"> 
                    @else
                        <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                    @endif
                </td>
                <td>
                    <a href="{{route('profile.show', $user->id)}}" class="text-dark text-decoration-none fw-bold">{{$user->name}}</a>
                </td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>
                    @if ($user->trashed())
                        <i class="fa-solid fa-circle text-danger"></i>
                    @else
                        <i class="fa-solid fa-circle text-success"></i>
                    @endif
                </td>
                <td>
                    @if (Auth::user()->id !== $user->id)
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div class="dropdown-menu">
                                @if ($user->trashed())
                                    <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#activate-user-{{$user->id}}">
                                        <i class="fa-solid fa-user-slash"></i> Activate {{$user->name}}
                                    </button>
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{$user->id}}">
                                        <i class="fa-solid fa-user-slash"></i> Deactivate {{$user->name}}
                                    </button>
                                @endif
                            </div>
                        </div>

                        @include('admin.users.modals.status')
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection