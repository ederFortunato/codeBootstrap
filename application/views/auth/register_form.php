<?php

$username = array(
  'id'    => 'username',
  'value' => set_value('username'),
  'type'  => 'text',
  'label' => 'User Name',
  'required' => 'true',
  'errors'=> isset($errors['username'])?$errors['username']:'' . form_error('username')
);

$email = array(
  'id'  => 'email',
  'value' => set_value('email'),
  'type'  => 'email',
  'label' => 'Email Address',
  'required' => 'true',
  'errors' => isset($errors['email'])?$errors['email']:'' . form_error('email')
);

$password = array(
  'id'  => 'password',
  'value' => set_value('password'),
  'type'  => 'password',
  'label' => 'Password',
  'required' => 'true',
  'errors' => isset($errors['password'])?$errors['password']:'' . form_error('password')
);

$confirm_password = array(
  'id'  => 'confirm_password',
  'value' => set_value('confirm_password'),
  'type'  => 'password',
  'label' => 'Confirm Password',
  'required' => 'true',
  'errors' => isset($errors['confirm_password'])?$errors['confirm_password']:'' . form_error('confirm_password')
);

?>

<form class="form-horizontal" action="<?=site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Register</legend>
	      
    <?php if ($use_username) { ?>

      <?=htmlMountInputForm($username)?>

    <?php } ?>
    
    <?=htmlMountInputForm($email)?>

    <?=htmlMountInputForm($password)?>

    <?=htmlMountInputForm($confirm_password)?>

    <?php if ($captcha_registration) { ?>

      <?php if ($use_recaptcha) { ?>

        <div class="control-group">         
    			<div id="recaptcha_image"></div>
    			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
    			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
    			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
    			<div class="recaptcha_only_if_image">Enter the words above</div>
    			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
    		  <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
          <div style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></div>
          <?php echo $recaptcha_html; ?>
        </div>

      <?php } else { ?>

        <div class="control-group">                     
          <label class="control-label" >Confirmation Code</label>
          <div class="controls">
             <?php echo $captcha_html; ?>
          </div>
        </div>

        <div class="control-group <?php echo (form_error('captcha') != '')?'error':''; ?>">                  
          <label class="control-label" for="captcha">Enter the code</label>
          <div class="controls">
            <input class="span3" id="captcha" name="captcha" value="" maxlength="8" type="text">
            <span class="help-inline">
              <?php  echo form_error('captcha');  ?>                          
              Enter the code exactly as it appears
            </span>
          </div>
        </div>

      <?php } ?>

    <?php } ?>
     
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>                  
    </div> 

  </fieldset>
</form>