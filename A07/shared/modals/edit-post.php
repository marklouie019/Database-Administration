<!-- EDIT POST MODAL -->
<div class="modal fade p-0" id="editPostModal<?php echo $postCard['postID'] ?>" tabindex="-1"
    aria-labelledby="editPostModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5);"
    data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="editPostModalLabel">Edit Blink post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- CONTENT -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="profile pb-3">
                        <img src="assets/img/users/user-avatar.jpg" alt="Profile" class="profile-pic"
                            id="editShowDP<?php echo $postCard['postID']; ?>">
                        <span id="editShowUserName"
                            class="username mx-3"><?php echo $postCard["firstName"] . " " . $postCard["lastName"]; ?></span>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here"
                            id="editContent<?php echo $postCard['postID']; ?>" name="caption"
                            style="height: 100px"></textarea>
                        <label for="caption">Write a status so you can Blink ;></label>
                    </div>
                    <div class="additionals pt-3">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <div onclick="uploadFile2('fileInput<?php echo $postCard['postID']; ?>')"
                                        class="upload-file p-2 d-flex align-items-center gap-2 mb-3" id="uploadFile">
                                        <i class="fa-regular fa-image"></i>Add pictures
                                        <!-- FILE UPLOAD -->
                                        <input type="hidden" name="existingAttachment"
                                            value="<?php echo $postCard['attachment']; ?>">
                                        <input type="file" id="fileInput<?php echo $postCard['postID']; ?>" hidden
                                            onchange="previewImage2(event, 'imagePreview<?php echo $postCard['postID']; ?>')"
                                            name="attachment" id="editAttachment<?php echo $postCard['postID'] ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- IMAGE PREVIEW -->
                            <div class="row">
                                <div class="col my-sm-3 mb-lg-3">
                                    <img id="imagePreview<?php echo $postCard['postID'] ?>" alt="Image preview"
                                        class="previewAttachment" onerror="this.style.display='none';">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="edit-input-location" id="addLocation">
                                        <div class="row">
                                            <div class="col my-2">
                                                Add location
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" id="cityName<?php echo $postCard['postID'] ?>"
                                                    class="form-control info-input info-input mb-2" placeholder="City"
                                                    name="cityName">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" id="provinceName<?php echo $postCard['postID'] ?>"
                                                    class="form-control info-input info-input mb-2"
                                                    placeholder="Province" name="provinceName">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="set-privacy">
                                        <select class="form-select mb-3" aria-label="Default select example"
                                            name="privacy">
                                            <option value="Public" <?php echo ($postCard['privacy'] == 'Public') ? 'selected' : '' ?>>
                                                Public
                                            </option>
                                            <option value="Friends" <?php echo ($postCard['privacy'] == 'Friends') ? 'selected' : '' ?>>
                                                Friends
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $postCard['postID']; ?>" name="postID">
                    <button type="submit" class="btn-edit w-100 text-center align-content-center"
                        data-bs-dismiss="modal" name="btnEditPost" id="btnEditPost">
                        Save</button>
                </form>
            </div>
        </div>
    </div>
</div>