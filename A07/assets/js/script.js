var fileInput = document.getElementById('fileInput');
var addLocation = document.getElementById('addLocation');

// SHOW MODAL(BOOTSTRAP) TO CREATE A POST
function selectSideNavOpt(btnID) {

    if (btnID === 'btnCreate') {
        var modal = new bootstrap.Modal(document.getElementById("confirmationModal"));
        modal.show();
    }
}

// SHOW MODAL(BOOTSTRAP) TO CONFIRM POST DELETION
function confirmDeletion(btnID, ID) {

    if (btnID === `btnDeletePost${ID}`) {
        var modal = new bootstrap.Modal(document.getElementById(`deleteModal${ID}`));
        modal.show();
    }
}

// CLICKS THE FILE INPUT ELEMENT
function uploadFile() {
    fileInput.click();
}

// DISPLAY THE LOCATION INPUTS
function inputLocation() {
    addLocation.style.display = "block";
}

// FUNCTION TO PREVIEW THE IMAGE UPLOADED BY THE USER
// CHECK FILE > LOAD FILE > READ FILE
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        preview.src = '';
    }
}

// FUNCTION TO CHECK IF POST IS EMPTY OR NOT
function validateForm() {
    var caption = document.getElementById('caption').value.trim();
    var fileInput = document.getElementById('fileInput');
    var btnUploadPost = document.getElementById('btnUploadPost');

    if (caption.length > 0 || fileInput.files.length > 0) {
        btnUploadPost.disabled = false;
        btnUploadPost.style.background =
            "linear-gradient(91deg, #FFD600 0.19%, #FF7C1C 0.2%, #FFCA38 70.96%, #B86E00 116.39%)";
    } else {
        btnUploadPost.disabled = true;
        btnUploadPost.style.background = "#626161";
    }
}

document.getElementById('fileInput').addEventListener('change', validateForm);




