<?php
    if(isset($_SESSION['skin_id_fabric'])){
        echo "var src_body = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_fabric']."';";
    }else{
        echo "var src_body;";
    }

    if(isset($_SESSION['skin_id_collar'])){
        echo "var src_collar = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_collar']."';";
    }else{
        echo "var src_collar;";
    }

    if(isset($_SESSION['skin_id_cuffs'])){
        echo "var src_cuff = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_cuffs']."';";
    }else{
        echo "var src_cuff;";
    }

    if(isset($_SESSION['skin_id_button'])){
        echo "var src_button = '".base_url("assets/img/upload/")."material_buttons/".$_SESSION['skin_id_button']."';";
    }else{
        echo "var src_button;";
    }

    if(isset($_SESSION['skin_id_button_hole'])){
        echo "var src_button_hole = '".base_url("assets/img/upload/")."material_buttons/".$_SESSION['skin_id_button_hole']."';";
    }else{
        echo "var src_button_hole;";
    }

    if(isset($_SESSION['skin_id_button_thread'])){
        echo "var src_button_thread = '".base_url("assets/img/upload/")."material_buttons/".$_SESSION['skin_id_button_thread']."';";
    }else{
        echo "var src_button_thread;";
    }
    echo "var src_pocket;";
    /*
    if(isset($_SESSION['skin_id_pocket'])){
        echo "var src_pocket = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_pocket']."';";
    }else{
        echo "var src_pocket;";
    }
    */

    // Added Placket
    if(isset($_SESSION['skin_id_front_placket'])){
        echo "var src_front_placket = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_front_placket']."';";
    }else{
        echo "var src_front_placket;";
    }
    if(isset($_SESSION['skin_id_lower_placket'])){
        echo "var src_lower_placket = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_lower_placket']."';";
    }else{
        echo "var src_lower_placket;";
    }

    // Added Inner Collar
    if(isset($_SESSION['skin_id_inner_collar'])){
        echo "var src_inner_collar = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_inner_collar']."';";
    }else{
        echo "var src_inner_collar;";
    }

    // Added Inner Cuff
    if(isset($_SESSION['skin_id_inner_cuffs'])){
        echo "var src_inner_cuff = '".base_url("assets/img/upload/")."material_fabric/".$_SESSION['skin_id_inner_cuffs']."';";
    }else{
        echo "var src_inner_cuff;";
    }

    // Added 15/05/17 - Andre
    if(isset($_SESSION['obj_id_pocket'])){
        echo "var obj_pocket = '".$_SESSION['obj_id_pocket']."';";
    }else{
        echo "var obj_pocket;";
    }

    if(isset($_SESSION['obj_id_collar'])){
        echo "var obj_collar = '".$_SESSION['obj_id_collar']."';";
    }else{
        echo "var obj_collar;";
    }

    if(isset($_SESSION['obj_id_cuff'])){
        echo "var obj_cuff = '".$_SESSION['obj_id_cuff']."';";
    }else{
        echo "var obj_cuff;";
    }

    if(isset($_SESSION['obj_id_sleeve'])){
        echo "var obj_sleeve = '".$_SESSION['obj_id_sleeve']."';";
    }else{
        echo "var obj_sleeve;";
    }

    /** ADD COLLAR BUTTON **/
    if(isset($_SESSION['obj_collar_button'])){
        echo "var obj_collar_button = '".$_SESSION['obj_collar_button']."';";
    }else{
        echo "var obj_collar_button;";
    }

    if(isset($_SESSION['obj_collar_button_hole'])){
        echo "var obj_collar_button_hole = '".$_SESSION['obj_collar_button_hole']."';";
    }else{
        echo "var obj_collar_button_hole;";
    }

    if(isset($_SESSION['obj_collar_button_thread'])){
        echo "var obj_collar_button_thread = '".$_SESSION['obj_collar_button_thread']."';";
    }else{
        echo "var obj_collar_button_thread;";
    }

    if(isset($_SESSION['obj_collar_inner_collar']) && $_SESSION['obj_collar_inner_collar'] != ''){
        echo "var obj_collar_inner_collar = '".$_SESSION['obj_collar_inner_collar']."';";
    }else{
        echo "var obj_collar_inner_collar;";
    }

    /*
    if(isset($_SESSION['obj_id_body_type'])){
        echo "var obj_body_type = '".base_url("assets/img/upload/")."material_body_type/object/".$_SESSION['obj_id_body_type']."';";
    }else{
        echo "var obj_body_type;";
    }

    /*
    if(isset($_SESSION['obj_id_buttons'])){
        echo "var obj_buttons = '".base_url("assets/img/upload/")."material_buttons/object/".$_SESSION['obj_id_buttons']."';";
    }else{
        echo "var obj_buttons;";
    }
    */

    if (isset($_SESSION['id_cleric'])) {
        if (isset($_SESSION['skin_id_collar_cuff'])) {
            echo "var src_collar = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff']."';";
            echo "var src_inner_collar = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff']."';";
            echo "var src_inner_cuff = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff']."';";
            echo "var src_cuff = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff']."';";
        } else if (isset($_SESSION['skin_id_collar_cuff_front_placket'])) {
            echo "var src_collar = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff_front_placket']."';";
            echo "var src_inner_collar = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff_front_placket']."';";
            echo "var src_inner_cuff = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff_front_placket']."';";
            echo "var src_cuff = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff_front_placket']."';";
            echo "var src_front_placket = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_collar_cuff_front_placket']."';";
        } else if (isset($_SESSION['skin_id_inner_collar_cuff'])) {
            echo "var src_inner_collar = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_inner_collar_cuff']."';";
            echo "var src_inner_cuff = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_inner_collar_cuff']."';";
        } else if (isset($_SESSION['skin_id_inner_collar_cuff_lower_placket'])) {
            echo "var src_inner_collar = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_inner_collar_cuff_lower_placket']."';";
            echo "var src_inner_cuff = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_inner_collar_cuff_lower_placket']."';";
            echo "var src_lower_placket = '".base_url("assets/img/upload/material_cleric/").$_SESSION['skin_id_inner_collar_cuff_lower_placket']."';";
        }
    }
?>

render_objects(src_body, src_collar, src_cuff, src_button, src_button_hole, src_button_thread, src_pocket, src_front_placket, src_lower_placket, src_inner_collar, src_inner_cuff, obj_pocket, obj_collar, obj_cuff, obj_sleeve, obj_collar_button, obj_collar_button_hole, obj_collar_button_thread, obj_collar_inner_collar);