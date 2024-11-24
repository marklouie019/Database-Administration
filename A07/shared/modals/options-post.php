<!-- POST OPTIONS MODAL -->
<div class="modal fade p-0" id="optionsModal<?php echo $postCard['postID'] ?>" tabindex="-1"
    aria-labelledby="optionsModalLabel" aria-hidden="true" data-bs-theme="dark"
    style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex justify-content-center" id="optionsModallLabel">Post Options
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <button <?php echo ($postCard['userID'] != 1) ? 'hidden' : '' ?> class="btn-options btn btn-secondary mb-2"
                        data-bs-toggle="modal" id="btnEditPost<?php echo $postCard['postID'] ?>"
                        data-bs-target="#editPostModal<?php echo $postCard['postID']; ?>" onclick="editPost(
                              '<?php echo $postCard['postID'] ?>',
                              '<?php echo $postCard['profilePic'] ?>',
                              '<?php echo htmlspecialchars($postCard['content']); ?>',
                              '<?php if (!empty($postCard['attachment'])) {
                                  echo $postCard['attachment'];
                              } ?>',
                              '<?php if (!empty($postCard['provinceName'])) {
                                  echo $postCard['provinceName'];
                              } ?>',
                              '<?php if (!empty($postCard['cityName'])) {
                                  echo $postCard['cityName'];
                              } ?>',
                              '<?php echo $postCard['privacy'] ?>'
                            )">Edit</button>
                    <button
                        onclick="confirmDeletion('btnDeletePost<?php echo $postCard['postID'] ?>', '<?php echo $postCard['postID'] ?>')"
                        class="btn-options btn btn-danger" id="btnDeletePost<?php echo $postCard['postID'] ?>"
                        data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>