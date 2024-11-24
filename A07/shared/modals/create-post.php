<!-- CREATE POST MODAL -->
<div class="container-fluid">
    <div class="modal fade p-0" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5);" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="confirmationModalLabel">Create a Blink post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- CONTENT -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="profile pb-3">
                            <img src="assets/img/users/louie.jpeg" alt="Profile" class="profile-pic">
                            <span class="username mx-3">Mark Louie Villanueva</span>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="caption"
                                name="caption" style="height: 100px" oninput="validateForm()"></textarea>
                            <label for="caption">Write a status so you can Blink ;></label>
                        </div>
                        <div class="additionals pt-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div onclick="uploadFile()"
                                            class="upload-file p-2 d-flex align-items-center gap-2 mb-3"
                                            id="uploadFile">
                                            <i class="fa-regular fa-image"></i>Add pictures
                                            <input type="file" id="fileInput" hidden onchange="previewImage(event)"
                                                name="attachment">
                                        </div>
                                    </div>
                                </div>
                                <!-- IMAGE PREVIEW -->
                                <div class="row">
                                    <div class="col my-sm-3 mb-lg-3">
                                        <img id="imagePreview" alt="Image Preview" class="previewAttachment" style="display:none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-location" id="addLocation">
                                            <div class="row">
                                                <div class="col my-2">
                                                    Add location
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" id="cityName"
                                                        class="form-control info-input info-input mb-2"
                                                        placeholder="City" name="cityName">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" id="provinceName"
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
                                                <option selected value="Public"><i class="fa-solid fa-globe"></i>Public
                                                </option>
                                                <option value="Friends"><i class="fa-solid fa-user-group"></i>Friends
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-post w-100 text-center align-content-center"
                            data-bs-dismiss="modal" name="btnUploadPost" id="btnUploadPost" disabled>
                            Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>