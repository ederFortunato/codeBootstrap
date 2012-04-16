<?php

$isEdit = (isset($recordSet));

?>

<!-- Form -->
<form  action="<?php echo site_url($linkBase.'/save'); ?>" method="post" class="form-horizontal" accept-charset="utf-8" >
    <fieldset>
    <legend><?php echo $title?></legend>

    <?php if($isEdit){ ?>
    <input type="hidden" name="<?php echo $idRecordSet?>" value="<?php echo $recordSet->$idRecordSet?>" class="hidden" />
    <?php } ?>

    <?
      foreach($formInfo as $key => $field){
        $field['value'] = ($isEdit)?(property_exists($recordSet, $key)?$recordSet->$key:''):'';
        $field['id'] = $key; 
        
        if($key == '__LINE_HORIZONTAL__'){
          echo '<hr>';
        }else{
          echo htmlMountInputForm($field);
        }
      }
    ?>

    <!-- Form Buttons -->
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Gravar</button>
        <a href="<?php echo site_url($linkBase); ?>" class="btn btn-small"><i class="icon-remove"></i> Cancelar</a>               
    </div>
    <!-- End Form Buttons -->

  </fieldset>
</form><!-- End Form -->
