<!-- DELETE CONFIRMATION MODAL -->
<div class="modal fade p-0" id="deleteModal<?php echo $postCard['postID'] ?>" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-theme="dark"
    style="background-color: rgba(0, 0, 0, 0.5);" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><i class="fa-solid fa-triangle-exclamation"
                        style="color:#FFD600"></i> Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?<br> Action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-dismiss="modal"
                    onclick="showOptions('btnOptions<?php echo $postCard['postID'] ?>', '<?php echo $postCard['postID'] ?>')">Cancel</button>
                <form method="POST" action="">
                    <input type="hidden" name="postID" value="<?php echo $postCard['postID']; ?>">
                    <button type="submit" name="btnDeletePost" id="confirmDelete" class="btn btn-danger"
                        data-bs-dismiss="modal">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>