<?php
function calculateTimeElapsed($start_date) {
    $start_timestamp = strtotime($start_date);
    $current_timestamp = time();
    $elapsed = $current_timestamp - $start_timestamp;

    if ($elapsed < 60) {
        return "قبل " . $elapsed . " ثانية";
    } elseif ($elapsed < 3600) {
        $minutes = floor($elapsed / 60);
        return "قبل " . $minutes . " دقيقة";
    } elseif ($elapsed < 86400) {
        $hours = floor($elapsed / 3600);
        return "قبل " . $hours . " ساعة";
    } elseif ($elapsed < 604800) {
        $days = floor($elapsed / 86400);
        return "قبل " . $days . " يوم";
    } elseif ($elapsed < 2592000) {
        $weeks = floor($elapsed / 604800);
        return "قبل " . $weeks . " أسبوع";
    } elseif ($elapsed < 31536000) {
        $months = floor($elapsed / 2592000);
        return "قبل " . $months . " شهر";
    } else {
        $years = floor($elapsed / 31536000);
        return "قبل " . $years . " سنة";
    }
}
?>