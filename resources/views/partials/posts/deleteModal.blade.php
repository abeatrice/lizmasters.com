<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle">Delete Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="delete-form-action" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label for="editTitle">Title</label>
                        <input class="form-control" id="deleteTitle" type="text" name="title" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deleteDescription">Description</label>
                        <textarea class="form-control" name="description" id="deleteDescription" cols="150" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="deletePublished" name="published" disabled>
                        <label class="form-check-label" for="deletePublished">Published</label>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <img id="deleteImage" src="" height="400" width="400">
                    </div>
                    <a href="/posts" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
           </div>
        </div>
    </div>
</div>