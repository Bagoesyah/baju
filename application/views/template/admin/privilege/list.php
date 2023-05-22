<?php
/**
 * User: Awan Tengah
 * Date: 25/04/2016
 * Time: 22:37
 */
?>

<div class='box-header with-border'>
    <h3 class='box-title'>Menu</h3>
</div><!-- /.box-header -->
<table class='table table-hover'>
    <tbody>
    <tr>
        <th>Menu</th>
        <th>View</th>
        <th>Create</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php foreach($menu as $row): ?>
        <?php $ci = & get_instance(); ?>
        <?php $privilege = $ci->get_privilege($id_level, $row->id);?>
        <tr>
            <td>
                <?php echo $row->title; ?>
            </td>
            <td>
                <input type='checkbox' class='flat-red' name='menu[<?php echo $row->id; ?>][view]' <?php echo !empty($privilege) && ($privilege->view == 1) ? 'checked' : '';?>>
            </td>
            <td>
                <input type='checkbox' class='flat-red' name='menu[<?php echo $row->id; ?>][create]' <?php echo !empty($privilege) && ($privilege->create == 1) ? 'checked' : '';?>>
            </td>
            <td>
                <input type='checkbox' class='flat-red' name='menu[<?php echo $row->id; ?>][update]' <?php echo !empty($privilege) && ($privilege->update == 1) ? 'checked' : '';?>>
            </td>
            <td>
                <input type='checkbox' class='flat-red' name='menu[<?php echo $row->id; ?>][delete]' <?php echo !empty($privilege) && ($privilege->delete == 1) ? 'checked' : '';?>>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
</script>