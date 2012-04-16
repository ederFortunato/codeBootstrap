<?php

$email = array(
  'id'  => 'email',
  'value' => set_value('email'),
  'type'  => 'email',
  'label' => 'Email Address',
  'required' => 'true',  
  'errors' => isset($errors['email'])?$errors['email']:'' . form_error('email')
);
  
?>

<form class="form-horizontal" action="<?php echo site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Change Password</legend>
	      
    <?php echo htmlMountInputForm($email)?>

    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary" name="send">Send</button>
      </div>                  
    </div> 

  </fieldset>
</form>