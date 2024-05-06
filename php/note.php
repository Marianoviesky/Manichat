<?php

function call(){
    $today = date("d M Y");
    $today_timestamp = strtotime($today);
    echo "$today\n";
    $database_date = date("d M Y");
// Convertir la date de la base de données en timestamp
    $database_date_timestamp = strtotime($database_date);
    var_dump($database_date_timestamp);
// Comparer les dates
    if ($database_date_timestamp < $today_timestamp) {
        echo "Aujourd'hui";
    }elseif ($database_date_timestamp === $today_timestamp) {
        echo "Ok";
    }
     else {
        $date_parts = explode(" ", $database_date);
        $day = $date_parts[0];
        $month = date('m', strtotime($date_parts[1] . ' ' . date('Y')));
        echo $day . "/" . $month;
    }
}
$esse = call();
?>