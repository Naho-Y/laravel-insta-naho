@extends('layouts.app')

@section('title','Show Post')

@section('content')

<div class="row boeder shadow">
    <div class="col p-0 border-end">
        <img src="{{$post->image}}" alt="" class="w-100">
    </div>
    <div class="col-4 px-0 bg-white">
        <div class="card border-0">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="{{route('profile.show',$post->user->id)}}">
                            @if ($post->user->avatar)
                                <img src="{{$post->user->avatar}}" alt="{{$post->user->name}}" class="rounded-circle avatar-sm">
                                
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0">
                        <a href="{{route('profile.show',$post->user->id)}}" class="text-decoration-none text-dark">{{$post->user->name}}</a>
                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            {{--if you are the owner of the post, you can EDIT of DELETE the post--}}
                            @if (Auth::user()->id === $post->user->id)
                                <div class="dropdown-menu">
                                    <a href="{{route('post.edit',$post->id)}}" class="dropdown-item">
                                        <i class="fa-regular fa-pen-to-square"></i>Edit
                                    </a>
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}">
                                        <i class="fa-regular fa-trash-can"></i>Delete
                                    </button>
            
                                </div>
                            @else
                                {{-- If you are not the OWNER of the post, Show an "Unfollow" button.[To be discuss soon]--}}
                                <div class="dropdown-item">
                                    <div class="dropdown-menu">
                                        @if ($post->user->isFollowed())
                                            <form action="{{route('follow.delete',$post->user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                                            </form>
                                        @else
                                            <form action="{{route('follow.store',$post->user->id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-primary">Follow</button>
                                            </form>
                                        @endif
                                    
                                    </div>
                                </div>
                                
                            @endif
                        </div>
                        @include('users.posts.contents.modals.delete')
                    </div>
                </div>
            </div>
            <div class="card-body w-100">
                <div class="row align-items-center">
                    <div class="col-auto">
                        @if ($post->isLiked())
                            <form action="{{route('like.delete',$post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm p-0"><i class="fa-solid fa-heart text-danger"></i></button>
                            </form>  
                            
                        @else
                            <form action="{{route('like.store',$post->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-heart"></i></button>
                            </form>  
                            
                        @endif
                    </div>
                    <div class="col-auto px-0">
                        <span>{{ $post->likes->count() }}</span>
                    </div>
                    <div class="col text-end">
                        @foreach ($post->categoryPost as $category_post)
                            <div class="badge bg-secondary bg-opacity-50">
                                {{$category_post->category->name}}
                            </div>
                            
                        @endforeach
                    </div>
                </div>
            
                {{-- Owner + description of the post --}}
                <a href="#" class="text-decoration-none text-dark fw-bold">{{$post->user->name}}</a>
                &nbsp;
                <p class="d-inline fw-light">{{$post->description}}</p>
                <p class="text-muted xsmall">{{$post->created_at->diffForHumans()}}</p>
                <div class="mt-3">
                    <form action="{{route('comment.store',$post->id)}}" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea name="body" id="" rows="1" class="form-control form-control-sm"></textarea>
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
                @if ($post->comments->isNotEmpty())
                    <ul class="mt-2 list-group">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item border-0 p-0 mb-2">
                                <a href="#" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                                &nbsp;
                                <p class="d-inline fw-light">{{$comment->body}}</p>
                                <form action="{{route('comment.delete',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <span class="text-muted small">{{$comment->created_at->diffForHumans()}}</span>
                                    @if ($comment->user_id === Auth::user()->id)
                                        &middot;
                                        <button type="submit" class="btn border-0 text-danger p-0 small">
                                            Delete
                                        </button>
                                    @endif
                                 </form>
                                
                            </li>
                        
                        @endforeach
                        
                    </ul>
                @endif
            
            </div>
        </div>
    </div>
</div>


@endsection