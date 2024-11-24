<?php
// DELETE A POST FROM THE DATABASE
if (isset($_POST['btnDeletePost'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
    header("Location: index.php");
}
?>