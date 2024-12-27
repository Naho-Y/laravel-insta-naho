@foreach ($comments as $comment)
    <div class="row p-2">
        <div class="col-10">
            <span class="fw-bold">{{ $comment->user->name }}</span>&nbsp;
            <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span>
            <p class="mb-0">{{ $comment->body }}</p>
        </div>
    </div>
@endforeach