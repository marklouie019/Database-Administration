<?php
// FETCH DATA FROM THE DATABASE
$query = "SELECT * FROM posts 
LEFT JOIN userInfo ON posts.userID = userInfo.userID 
LEFT JOIN address ON posts.addressID = address.addressID
LEFT JOIN cities ON address.cityID = cities.cityID
LEFT JOIN provinces ON address.provinceID = provinces.provinceID
ORDER BY dateTime DESC
";
$result = executeQuery($query);
?>