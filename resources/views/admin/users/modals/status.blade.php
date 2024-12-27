<!-- Deactivate Modal -->
<div class="modal fade" id="deactivate-user-{{$user->id}}">
    <div class="modal-dialog border-danger">
        <div class="modal-content">
            <div class="modal-header text-danger">
                <h5 class="modal-title" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i> Deactivate User
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
                <p class="text-danger">Are you sure to Deactivate {{$user->name}} </p>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.users.deactivate', $user->id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Activate Modal -->
<div class="modal fade" id="activate-user-{{$user->id}}">
    <div class="modal-dialog border-success">
        <div class="modal-content">
            <div class="modal-header text-success">
                <h5 class="modal-title" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i> Activate User
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
                <p class="text-success">Are you sure to Activate {{$user->name}} </p>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.users.activate', $user->id)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-sm btn-success">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>

