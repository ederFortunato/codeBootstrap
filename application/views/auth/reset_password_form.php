<?php

$new_password = array(
  'id'  => 'new_password',
  'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
  'value' => '',
  'type'  => 'password',
  'label' => 'New Password',
  'required' => 'true',  
  'errors' => isset($errors['new_password'])?$errors['new_password']:'' . form_error('new_password')
);

$confirm_new_password = array(
  'id'  => 'confirm_new_password',
  'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
  'value' => '',
  'type'  => 'password',
  'label' => 'Confirm New Password',
  'required' => 'true',  
  'errors' => isset($errors['confirm_new_password'])?$errors['confirm_new_password']:'' . form_error('confirm_new_password')
);
  
?>

<form class="form-horizontal" action="<?php echo site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Change Password</legend>
	      
    <?php echo htmlMountInputForm($new_password)?>

    <?php echo htmlMountInputForm($confirm_new_password)?>

    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary" name="change">Change Password</button>
      </div>                  
    </div> 

  </fieldset>
</form>
