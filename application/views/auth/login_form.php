<?php 

if ($login_by_username AND $login_by_email) {
  $login_label = 'Email or login';
} else if ($login_by_username) {
  $login_label = 'Login';
} else {
  $login_label = 'Email';
}

$login = array(
  'id'    => 'login',
  'label' => $login_label,
  'value' => set_value('login'),
  'type'  => 'text',
  'required' => 'true',
  'errors' => isset($errors['login'])?$errors['login']:'' . form_error('login')
);

$password = array(
  'id'    => 'password',
  'label' => 'Password',
  'value' => set_value('password'),
  'type'  => 'password',
  'required' => 'true',
  'errors' => isset($errors['password'])?$errors['password']:'' . form_error('password')
);

?>

<form class="form-horizontal" action="<?php echo site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Login Form</legend>

    <?php echo htmlMountInputForm($login)?>

    <?php echo htmlMountInputForm($password)?>

    <div class="control-group">
      <div class="controls"><?php echo anchor('/auth/forgot_password/', 'Forgot password?'); ?></div>
    </div>
      
    <?php if ($show_captcha) { ?>

      <?php if ($use_recaptcha) { ?>

        <div class="control-group">
        <br>
        <div id="recaptcha_image"></div>
        <br>
        <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
        <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
        <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
        <br>

        <div class="recaptcha_only_if_image">Enter the words above</div>
        <div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
        <br>
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
            <input class="span3" id="captcha" name="captcha" value=""  maxlength="8" type="text">
            <span class="help-inline"><?php echo form_error('captcha'); ?></span>
            <span class="help-inline">Enter the code exactly as it appears</span>
          </div>
        </div>

      <?php } ?>
      
    <?php } ?>

    <div class="control-group">
      <div class="controls">                      
        <label class="checkbox inline" for="remember">
          <input type="checkbox" name="remember" value="1" id="remember" checked="<?php echo set_value('remember')?>" class="input-xlarge" />
          Remember me
        </label>
      </div>
    </div>

    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary">Let me in</button>                            
         <?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register', 'class="btn btn-small"'); ?> 
      </div>                  
    </div>

  </fieldset>
</form>