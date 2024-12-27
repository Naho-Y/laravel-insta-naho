@extends('layouts.app')

@section('title','Admin::Posts')

@section('content')

<table class="table table-hover align-middle bg-white border text-secondry">
    <thead class="small table-success text-secondry">
        <th></th>
        <th></th>
        <th>CATEGORY</th>
        <th>OWNER</th>
        <th>CREATED AT</th>
        <th>STATUS</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($all_posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>
                    <a href="{{route('post.show',$post->id)}}">
                        <img src="{{$post->image}}" alt="post id{{$post->description}}" class="w-100">
                    </a>
                </td>
                <td>
                    @foreach ($post->categoryPost as $category_post)
                        <div class="badge bg-secondary bg-opacity-50">
                            {{$category_post->category->name}}
                        </div>
                    @endforeach
                </td>
                <td>{{$post->user->id}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    @if ($post->trashed())
                        <i class="fa-solid fa-circle text-danger"></i>
                    @else
                        <i class="fa-solid fa-circle text-primary"></i>
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                        <div class="dropdown-menu">
                            @if ($user->trashed())
                                <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#visible-post-{{$post->id}}">
                                    <i class="fa-solid fa-user-slash"></i> Visible Post {{$post->id}}
                                </button>
                            @else
                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post-{{$post->id}}">
                                    <i class="fa-solid fa-user-slash"></i> Hide Post {{$post->id}}
                                </button>
                            @endif
                        </div>
                    </div>

                    @include('admin.posts.modals.status')
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection