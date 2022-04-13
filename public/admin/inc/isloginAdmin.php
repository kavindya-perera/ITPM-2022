<?php

    $AdminFirstName = Session::get('AdminFirstName');
    $AdminLastName = Session::get('AdminLastName');
    $AdminDesignation = Session::get('AdminDesignation');
    $AdminContactNumber = Session::get('AdminContactNumber');
    $AdminAddress = Session::get('AdminAddress');
    $AdminSystemRole = Session::get('AdminSystemRole');
    if( ($AdminSystemRole != 'Administrator') || ($AdminFirstName === NULL) || ($AdminFirstName === NULL) || ($AdminDesignation === NULL) || ($AdminContactNumber === NULL) || ($AdminAddress === NULL)) {
        echo "<script>window.top.location='/login'</script>";
    }
?>