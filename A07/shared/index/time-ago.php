<!-- MODIFY THE TIMESTAMP INTO TIME AGO FORMAT USING DATETIME -->
<span class="time-posted">
    <?php
    
    $postTime = new DateTime($postCard['dateTime']);
    $currentTime = new DateTime();

    $postTimeTimestamp = strtotime($postCard['dateTime']);
    $currentTimeTimestamp = time();

    $diffSeconds = $currentTimeTimestamp - $postTimeTimestamp;

    $years = floor($diffSeconds / (365 * 60 * 60 * 24)); 
    $months = floor(($diffSeconds - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diffSeconds - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diffSeconds - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($diffSeconds - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    $seconds = $diffSeconds - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60;

    if ($years > 0) {
        echo $years . " year" . ($years > 1 ? "s" : "") . " ago";
    } elseif ($months > 0) {
        echo $months . " month" . ($months > 1 ? "s" : "") . " ago";
    } elseif ($days > 0) {
        echo $days . " day" . ($days > 1 ? "s" : "") . " ago";
    } elseif ($hours > 0) {
        echo $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
    } elseif ($minutes > 0) {
        echo $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
    } else {
        echo "Just now";
    }

    echo " • " . ucwords($postCard['privacy']);
    ?>
</span>