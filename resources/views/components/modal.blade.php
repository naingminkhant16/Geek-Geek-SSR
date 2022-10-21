<!-- Modal -->
<div class="modal fade" id="postCreateModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="postCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="postCreateModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                <form action="{{route('post.store')}}" method="POST" id="postCreateForm">
                    @csrf
                    <div class="mb-3">
                        <textarea name="status" id="" cols="30" rows="20" class="form-control"
                            placeholder="What's on your mind today?..."></textarea>
                    </div>
                    <div class="mb-0">
                        <input type="file" name="photos[]" multiple class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Delete</button>
                <button type="submit" form="postCreateForm" class="btn btn-primary text-white">Upload</button>
            </div>
        </div>
    </div>
</div>
