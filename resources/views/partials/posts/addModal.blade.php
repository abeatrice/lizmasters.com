<div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/posts" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="addTitle">Title</label>
                        <input class="form-control" id="addTitle" type="text" name="title" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="addDescription">Description</label>
                        <textarea class="form-control" name="description" id="addDescription" cols="150" rows="3" required></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="published" id="addPublished">
                        <label class="form-check-label" for="addPublished">Published</label>
                    </div>
                    <div class="form-group">
                        <input class="form-control-file" type="file" name="image_path" required>
                    </div>
                    <a href="/posts" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </div>    
    </div>
</div>