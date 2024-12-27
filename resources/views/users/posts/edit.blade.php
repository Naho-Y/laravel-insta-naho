@extends('layouts.app')

@section('title','Edit Post')

@section('content')
<form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="category" class="form-label d-block fw-bold">
            Category <span class="text-muted fw-noemal">(Up to 3)</span>
        </label>
        @foreach ($all_categories as $category)
            @if (in_array($category->id, $selected_categories))
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input" checked>
                    <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
                </div>
            @else
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input">
                    <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
                </div>
                
            @endif
            @error('category')
            <p class="text-danger small">{{$message}}</p>
            @enderror
        @endforeach

    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind?">{{old('description',$post->description)}}</textarea>
        @error('descriotion')
            <p class="text-danger small">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="image" class="form-label fw-bold">Image</label>
        <img src="{{$post->image}}" alt="" class="img-thumbnail d-block">
        <input type="file" name="image" id="{{old('image',$post->image)}}" class="form-control" placeholder="image-info">
        <div class="form-text" id="image-info">
            The acceptable formats are jpeg, jpg, png, and git only.<br>
            Max file is 1048kb.
        </div>
        @error('image')
            <p class="text-danger small">{{$message}}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary px-5">Update</button>
</form>

@endsection