<div class="modal fade" id="editModal" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form-action" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="editTitle">Title</label>
                        <input class="form-control" id="editTitle" type="text" name="title" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea class="form-control" name="editDescription" id="description" cols="150" rows="3" required></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editPublished" name="published">
                        <label class="form-check-label" for="editPublished">Published</label>
                    </div>
                    <div class="form-group">
                        <img src="/storage/{{$post->image_path}}" alt="{{$post->title}}" height="400" width="400">
                    </div>
                    <a href="/posts" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
           </div>
        </div>
    </div>
</div>