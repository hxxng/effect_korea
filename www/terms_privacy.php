<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$query = "select * from terms_t where idx = 1";
$row = $DB->fetch_assoc($query);
?>

<div class="wrap">
    <?=$row['tt_agree2']?>
</div>