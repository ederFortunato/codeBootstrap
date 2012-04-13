<?php

$login = array(
  'id'    => 'login',
  'value' => set_value('login'),
  'type'  => 'text',
  'label' =>  ($this->config->item('use_username', 'tank_auth'))?'Email or login':'Email',
  'required' => 'true',
  'errors'=> isset($errors['login'])?$errors['login']:'' . form_error('login')
);

?>

<form class="form-horizontal" action="<?=site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Forgot Password</legend>

    <?=htmlMountInputForm($login)?>

    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary">Get a new password</button>
      </div>                  
    </div> 

  </fieldset>
</form>