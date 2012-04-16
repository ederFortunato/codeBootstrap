<?php

$password = array(
  'id'    => 'password',
  'value' => set_value('password'),
  'type'  => 'password',
  'label' => 'Password',
  'required' => 'true',  
  'errors'=> isset($errors['password'])?$errors['password']:'' . form_error('password')
);

$email = array(
  'id'    => 'email',
  'value' => set_value('email'),
  'type'  => 'email',
  'label' => 'New email address',
  'required' => 'true',
  'errors'=> isset($errors['email'])?$errors['email']:'' . form_error('email')
);

?>

<form class="form-horizontal" action="<?php echo site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Change Email</legend>

    <?php echo htmlMountInputForm($password)?>

    <?php echo htmlMountInputForm($email)?>

    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary" name="change">Send confirmation email</button>                            
      </div>                  
    </div>

  </fieldset>
</form>