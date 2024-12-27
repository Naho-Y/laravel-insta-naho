@extends('layouts.app')

@section('title','Edit Profile')


@section('content')
    
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{route('profile.update')}}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h2 class="mb-3 fw-light text-muted">Update Profile</h2>
                <div class="row mb-3">
                    <div class="col-4">
                        @if ($user->avatar)
                        <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thmbnail rounded-circle avatar-lg">
                            
                        @else
                        <i class="fa-solid fa-circle-user text-secondary d-block text-center text-dark icon-lg"></i>
                        @endif
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm mt-1">
                    <div class="form-text">
                        Accrptable format jpeg, png, jpg, gif only<br>
                        Max file is 1048kb
                    </div>
                    {{-- Error --}}
                    @error('avatar')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-labal fw-bold">Name</label>
                    <input type="text" value="{{ old('name', $user->name) }}" name="name" id="name" class="form-control">
                    {{-- Error --}}
                    @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-labal fw-bold">Email</label>
                    <input type="email" value="{{ old('email', $user->email) }}" name="email" id="email" class="form-control">
                    {{-- Error --}}
                    @error('email')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="introduction" class="form-labal fw-bold">Introduction</label>
                    <textarea name="introduction" id="introduction" cols="" rows="5" placeholder="Describe introduction" class="form-control">{{ old('introduction', $user->introduction) }}</textarea>
                    {{-- Error --}}
                    @error('introduction')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning px-5">Update</button>
            </form>
        </div>
    </div>
@endsection