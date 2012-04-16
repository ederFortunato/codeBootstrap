<?php

$password = array(
	'id'	  => 'password',
  'label' => 'Password',
  'value' => '',
  'type'  => 'password',
  'errors' => isset($errors['password'])?$errors['password']:'' . form_error('password')
);   

?>

<form class="form-horizontal" action="<?php echo site_url($this->uri->uri_string())?>" method="post" accept-charset="utf-8" >
  <fieldset>
    <legend>Unregister</legend>
      
    <?php echo htmlMountInputForm($password)?>

    <div class="control-group">
      <div class="controls">
        <a type="submit" class="btn btn-primary" data-toggle="modal" href="#ModalConfirmUnregister" >Delete account</a>                            
      </div>                  
    </div>

  </fieldset>

  <div id="ModalConfirmUnregister" class="modal hide fade">
    <div class="modal-header">
      <a class="close" data-dismiss="modal" >&times;</a>
      <h3>Atenção</h3>
    </div>
    <div class="modal-body">
      <h4>Deseja Mesmo Deletar sua conta?</h4>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal" >Não</a>
      <button class="btn btn-danger" type="submit"><i class="icon-ok icon-white"></i> Sim</button>
    </div>
  </div>

</form>

 
