<?php
// CHECK IF FORM IS SUBMITTED
if (isset($_POST['btnUploadPost'])) {
    $userID = 1;
    $caption = nl2br($_POST['caption']);
    $cityName = $_POST['cityName'];
    $provinceName = $_POST['provinceName'];
    $privacy = $_POST['privacy'];
    $timeStamp = date('Y-m-d H:i:s');

    // PROCESS FILE UPLOAD IF FILE IS PRESENT
    // CHECK FILE > RETRIEVE TEMPORARY FILE PATH > MOVE FILE
    $attachmentName = '';
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $attachmentTmpPath = $_FILES['attachment']['tmp_name'];
        $attachmentName = basename($_FILES['attachment']['name']);
        $uploadDir = 'assets/img/users/';
        $uploadFilePath = $uploadDir . $attachmentName;
        move_uploaded_file($attachmentTmpPath, $uploadFilePath);
    }

    // CHECK OR INSERT CITY & PROVINCE
    $cityQuery = "SELECT cityID FROM cities WHERE cityName = '$cityName'";
    $cityResult = executeQuery($cityQuery);

    if (mysqli_num_rows($cityResult) > 0) {
        $city = mysqli_fetch_assoc($cityResult);
        $cityID = $city['cityID'];
    } else {
        $insertCityQuery = "INSERT INTO cities(cityName) VALUES ('$cityName')";
        executeQuery($insertCityQuery);
        $cityID = mysqli_insert_id($conn);
    }

    $provinceQuery = "SELECT provinceID FROM provinces WHERE provinceName = '$provinceName'";
    $provinceResult = executeQuery($provinceQuery);

    if (mysqli_num_rows($provinceResult) > 0) {
        $province = mysqli_fetch_assoc($provinceResult);
        $provinceID = $province['provinceID'];
    } else {
        $insertprovinceQuery = "INSERT INTO provinces(provinceName) VALUES ('$provinceName')";
        executeQuery($insertprovinceQuery);
        $provinceID = mysqli_insert_id($conn);
    }

    // INSERT OR GET ADDRESS ID
    $addressQuery = "SELECT addressID FROM address WHERE cityID = '$cityID' AND provinceID = '$provinceID'";
    $addressResult = executeQuery($addressQuery);

    if (mysqli_num_rows($addressResult) > 0) {
        $addressRow = mysqli_fetch_assoc($addressResult);
        $addressID = $addressRow['addressID'];
    } else {
        $addressInsertQuery = "INSERT INTO address (cityID, provinceID) VALUES ('$cityID', '$provinceID')";
        executeQuery($addressInsertQuery);
        $addressID = mysqli_insert_id($conn);
    }

    // INSERT THE POST INTO THE DATABASE
    $postQuery = "INSERT INTO posts(content, attachment, privacy, dateTime, addressID, userID) 
                VALUES ('$caption', '$attachmentName', '$privacy', '$timeStamp', '$addressID', '$userID')";
    executeQuery($postQuery);

    header("Location: index.php");
}

?>