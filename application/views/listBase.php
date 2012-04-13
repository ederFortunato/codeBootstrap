<div class="page-header">

  <h2><?=$title?></h2>

  <!-- Alert Messenger -->
  <?php if(isset($feedback)){ ?>
    <div class="alertNoty hide" data-alert-type="<?=$feedback?>">
      <?=$msg;?>
    </div>
  <?php } ?>
  <!--/ Alert Messenger -->

  <!-- ADD button -->
  <div class="row">
      <?php echo anchor($linkBase.'/add', '<i class="icon-plus icon-white"></i> Criar Novo', 'class="btn-large btn-primary btn pull-right"'); ?>
  </div>
  <!--/ ADD button -->

  <!-- search row -->
  <? if(isset($searchInfo)){ ?>
    <div class="row">
      <hr>
      <div class="span9">
        <form class="form-inline" action="<?=$_SERVER['REQUEST_URI']?>" method="get" >
          <?
            foreach ($searchInfo as $keySearch => $valueSearch) {
              echo ' <label class="control-label" for="'.$keySearch.'">'.$valueSearch['title'].': </label> ';
              echo ' <input class="span2" type="'.$valueSearch['value'].'"id="'.$keySearch.'" name="'.$keySearch.'" value="'.$valueSearch['value'].'">';  
            }
          ?>
          <button type="submit" class="btn"><i class="icon-search"></i> Buscar</button>
        </form> 
      </div>
    </div> 
  <? } ?><!--/ search row -->

</div><!--/.page-header -->

<table class="table table-striped table-bordered table-condensed">

  <thead>
    <tr>
      <? foreach($listHead as $key => $value){ ?>
        <th width="<?=$value['width']?>" ><?=$value['title']?></th>
      <? } ?>
        <th width="130" class="center">Ações</th>
    </tr>
  </thead>

  <tbody>

  <?
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
    <?
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

      <td>

        <? if($showOnlyViewButton == true){ ?>
          <a class="btn btn-info btn-mini" href="<?=site_url($linkBase.'/view'.'/'.$valueList->$idRecordSet);?>"><i class="icon-eye-open icon-white"></i> Ver</a>          
        <? } ?>

        <? if($showEditButton == true){ ?>      
          <a class="btn btn-info btn-mini" href="<?=site_url($linkBase.'/edit'.'/'.$valueList->$idRecordSet);?>"><i class="icon-edit icon-white"></i> Editar</a>
        <? } ?>

        <? if($showRemoveButton == true){ ?>
          <a class="btn btn-danger btn-mini" data-toggle="modal" data-confirm-id="<?=$valueList->$idRecordSet?>" href="#ModalConfirmRemove" ><i class="icon-trash icon-white"></i> Deletar</a>
        <? } ?>

      </td>

    </tr>

  <? } ?>

  </tbody>

</table>

<div class="row">
    <? if($perPage < count($list)){ ?>
      <span class="label label-info pull-right">Exibindo <?=(1 + $countPage)?>-<?=($endPage)?> de <?=count($list)?></span>
    <? } ?>
</div>

<div class="row">
  <div class="span8"> <!-- Pagging -->
    <? echo generatePagination(count($list), $perPage, $startPage, site_url($linkBase), $searchParans); ?> 
  </div>
</div><!-- End Pagging -->