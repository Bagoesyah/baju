<?php
# @Author: Awan Tengah
# @Date:   2017-03-22T17:50:06+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T15:36:43+07:00
?>
<div class="box-member">
    <div class="col-sm-6">
        <div class="profile-title">
            <h3>Edit Profile</h3>
            <small>Manage your account here.</small>
        </div>
        <?php alert_message('ep_message'); ?>
        <div class="profile-content">
            <?php echo form_open('dashboard/profile/edit_profile'); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name.." value="<?php echo isset($profile) ? $profile->DATA->NAME : set_value('name'); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email.." value="<?php echo isset($profile) ? $profile->DATA->EMAIL : set_value('email'); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number.." value="<?php echo isset($profile) ? $profile->DATA->PHONE : set_value('phone'); ?>">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Enter your address.." rows="5" cols="80"><?php echo isset($profile) ? $profile->DATA->ADDRESS : set_value('address'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control" name="gender">
                    <option value="">Select your gender..</option>
                    <option value="MALE" <?php echo isset($profile) ? set_select('gender', 'MALE', $profile->DATA->GENDER == '1' ? true : false)  : set_select('gender', 'MALE'); ?>>Male</option>
                    <option value="FEMALE" <?php echo isset($profile) ? set_select('gender', 'FEMALE', $profile->DATA->GENDER == '2' ? true : false)  : set_select('gender', 'FEMALE'); ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-white btn-block" value="Save">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="profile-title">
            <h3>Change Password</h3>
            <small>Use a password that you've never used on other sites.</small>
        </div>
        <?php alert_message('cp_message'); ?>
        <div class="profile-content">
            <?php echo form_open('dashboard/profile/change_password'); ?>
            <div class="form-group">
                <label for="recent_password">Recent Password</label>
                <input type="password" name="recent_password" id="recent_password" class="form-control" placeholder="Enter your recent password..">
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter your new password..">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter your confirm password..">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-white btn-block" value="Save">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
