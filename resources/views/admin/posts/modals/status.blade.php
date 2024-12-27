<!-- Deactivate Modal -->
<div class="modal fade" id="hide-post-{{$post->id}}">
    <div class="modal-dialog border-danger">
        <div class="modal-content">
            <div class="modal-header text-danger">
                <h5 class="modal-title" id="modalTitleId">
                    <i class="fa-solid fa-ban"></i> Hide Post
                </h5>
                {{-- <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button> --}}
            </div>
            <div class="modal-body">
                {{-- <div class="container-fluid">Add rows here</div> --}}
                <p class="text-danger">Are you sure to hide this post?</p>
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="{{ $post->description }}" class="img-thumbnail">
                    <p class="text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.posts.hide', $post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Activate Modal -->
<div class="modal fade" id="visible-post-{{$post->id}}">
    <div class="modal-dialog border-success">
        <div class="modal-content">
            <div class="modal-header text-success">
                <h5 class="modal-title" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i> Visible Post
                </h5>
                {{-- <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button> --}}
            </div>
            <div class="modal-body">
                {{-- <div class="container-fluid">Add rows here</div> --}}
                <p class="text-success">Are you sure to Visible? </p>
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="{{ $post->description }}" class="img-thumbnail">
                    <p class="text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.posts.activate', $post->id)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-sm btn-success">Visible</button>
                </form>
            </div>
        </div>
    </div>
</div>

