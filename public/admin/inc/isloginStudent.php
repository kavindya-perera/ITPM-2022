<?php

$S_NUMBER = Session::get('S_NUMBER');
$S_FIRST_NAME = Session::get('S_FIRST_NAME');
$S_CLASS_ROOM_ID = Session::get('S_CLASS_ROOM_ID');
if( ($S_NUMBER === NULL) || ($S_FIRST_NAME === NULL) || ($S_CLASS_ROOM_ID === NULL) ){
        echo "<script>window.top.location='/StudentLogin'</script>";
    }
?>