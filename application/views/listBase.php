<div class="page-header">

  <h2><?php echo $title?></h2>

  <!-- Alert Messenger -->
  <?php if(isset($feedback)){ ?>
    <div class="alertNoty hide" data-alert-type="<?php echo $feedback?>">
      <?php echo $msg;?>
    </div>
  <?php } ?>
  <!--/ Alert Messenger -->

  <!-- ADD button -->
  <div class="row">
      <?php echo anchor($linkBase.'/add', '<i class="icon-plus icon-white"></i> Create new', 'class="btn-large btn-primary btn pull-right"'); ?>
  </div>
  <!--/ ADD button -->

  <!-- search row -->
  <?php if(isset($searchInfo)){ ?>
    <div class="row">
      <hr>
      <div class="span9">
        <form class="form-inline" action="<?php echo $_SERVER['REQUEST_URI']?>" method="get" >
          <?php
            foreach ($searchInfo as $keySearch => $valueSearch) {
              echo ' <label class="control-label" for="'.$keySearch.'">'.$valueSearch['title'].': </label> ';
              echo ' <input class="span2" type="'.$valueSearch['value'].'"id="'.$keySearch.'" name="'.$keySearch.'" value="'.$valueSearch['value'].'">';  
            }
          ?>
          <button type="submit" class="btn"><i class="icon-search"></i> Search</button>
        </form> 
      </div>
    </div> 
  <?php } ?><!--/ search row -->

</div><!--/.page-header -->

<table class="table table-striped table-bordered table-condensed">

  <thead>
    <tr>
      <?php foreach($listHead as $key => $value){ ?>
        <th width="<?php echo $value['width']?>" ><?php echo $value['title']?></th>
      <?php } ?>
        <th class="center">Actions</th>
    </tr>
  </thead>

  <tbody>

  <?php
    $startPage  = (isset($pageNumber))?$pageNumber:1;  
    $countPage  = ($startPage - 1) * $perPage;
    $endPage = (count($list) < ($perPage + $countPage))?count($list):($perPage + $countPage);
    $cont = 0;

    foreach($list as $keyList => $valueList){
      $cont++;
      if($cont <= $countPage){
        continue; 
      }else if($cont > $endPage){
        break;
      }
  ?>

    <tr>
    <?php
      foreach($listHead as $key => $value){
        $td = '';

        if(isset($value['labelFunction'])){
          $val = $value['labelFunction']($valueList->$key);
        }else{
          $val = $valueList->$key;
        }

        if($value['type'] == 'date'){
          $td = date('d/m/Y', strtotime($val));

        }else if($value['type'] == 'action-active'){

          $valStr = ($val==1)?'Ativo':'Desativo';
          $css = ($val==1)?'label label-success':'label';
          $td = anchor('/save/stat?id='.$valueList->$idRecordSet.'&stat='.$val , $valStr, ' class="'.$css.'"');
          
        }else{
          $td = $val;
        }
        
        echo '<td>'.$td.'</td>';
      }
    ?>   

      <td width="<?php echo (($showOnlyViewButton)?50:0)+(($showEditButton)?65:0)+(($showRemoveButton)?65:0)?>">

        <?php if($showOnlyViewButton){ ?>
          <a class="btn btn-info btn-mini" href="<?php echo site_url($linkBase.'/view'.'/'.$valueList->$idRecordSet);?>"><i class="icon-eye-open icon-white"></i> View</a>          
        <?php } ?>

        <?php if($showEditButton){ ?>      
          <a class="btn btn-info btn-mini" href="<?php echo site_url($linkBase.'/edit'.'/'.$valueList->$idRecordSet);?>"><i class="icon-edit icon-white"></i> Edit</a>
        <?php } ?>

        <?php if($showRemoveButton){ ?>
          <a class="btn btn-danger btn-mini" data-toggle="modal" data-confirm-id="<?php echo $valueList->$idRecordSet?>" href="#ModalConfirmRemove" ><i class="icon-trash icon-white"></i> Delete</a>
        <?php } ?>

      </td>

    </tr>

  <?php } ?>

  </tbody>

</table>

<?
  if(count($list) == 0){
    echo '<div class="alert center"><strong>No records found</strong></div>';
  }
?>


<div class="row">
    <?php if($perPage < count($list)){ ?>
      <span class="label label-info pull-right">Showing <?php echo (1 + $countPage)?>-<?php echo ($endPage)?> of <?php echo count($list)?></span>
    <?php } ?>
</div>

<div class="row">
  <div class="span8"> <!-- Pagging -->
    <?php echo generatePagination(count($list), $perPage, $startPage, site_url($linkBase), $searchParans); ?> 
  </div>
</div><!-- End Pagging -->