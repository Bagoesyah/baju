<?php
# @Author: Awan Tengah
# @Date:   2017-03-17T15:04:50+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T03:46:23+07:00
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<style>
    .container-row{
        display: flex;
    }
    /*button pertama*/
    .dropdown {
        position: relative;
        /* z-index: 99999; */
        /* left: 68rem; */
    }
    .dropdown-menu {
        left: 15px;
    }
    .btn-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 16rem;
        color: #000;
        background-color: #f5f5f5;
        font-size: medium;
        font-weight: 500;
    }
    .btn-label:hover {
        color: #000;
    }
    .btn-label:focus {
        color: #000;
    }
    .btn-dropdown {
        width: 12rem;
        position: relative;
        background-color: #f5f5f5;
    }
    .btn-dropdown:hover {
        background-color: #f5f5f5;
        color: #000;
    }

</style>

<div class="container container-row">
    <div class="col-sm-7 col-lg-7"></div>
    <div class="btn-group dropdown col-sm-5 col-lg-5">
      <a class="btn dropdown-toggle btn-label btn-select" data-toggle="dropdown" href="#">
        <div>Custom</div>
        <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <li><a href="javascript:void(0);" data-menu="fabric" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">01 Fabric</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="collar" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">02 collar</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="cuffs" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">03 cuff</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="body_type" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">Body</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="pocket" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">05 Pocket</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="buttons" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">08 Button</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="cleric" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">10 Cleric</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="embroidery" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">14 Embroidery</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="option" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">Option</button>
                </a></li>
            <li><a href="javascript:void(0);" data-menu="other" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">Size</button>
                </a></li>
            <li class="divider"></li>
            <li><a id="goto_verify" href="javascript:void(0);" data-menu="verify" class="nav_menu">
                    <button type="button" class="btn btn-dropdown nav_menu_item">Verify</button>
                </a></li>
        </ul>
    </div>
</div>
<br>
<div id="cr_verify"></div>

<script>
$(".dropdown-menu li a").click(function(){
  var selText = $(this).text();
  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+'<span class="caret"></span>');
});
</script>

<?php
if ($this->session->flashdata('check_verify')) {
    ?> 
    <div class="alert alert-danger alert-flash"><?php echo $this->session->flashdata('check_verify'); ?></div>
    <?php
}
?>

