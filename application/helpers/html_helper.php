<?php
/**
 * Arquivo para colocarmos funcoes uteis a todo o sistema/site.
 * 
 * Em geral, sao funcoes para auxiliar na parte de geração HTML.
 * 
 */


/**
 * Gera elementos inputs
 * 
 * @param array $options
 * @return string elementos gerados
 */
function htmlMountInputForm(array $options){  
  $error = (isset($options['errors']) && $options['errors']!='')?'error':'';
  $req   = (isset($options['required']) && $options['required']=='true')?'required':'';
  $atrr  = (isset($options['atrr']))?$options['atrr']:'';

  $str = '';

  if($options['type'] == 'hidden'){ 

    $str .= '<input '.$atrr.' id="' . $options['id'] . '" name="' . $options['id'] . '" value="' . $options['value'] . '" type="' . $options['type'] . '">';

  }else{

    $str .= '<div class="control-group '.  $error . '">';
    $str .= '  <label class="control-label" for="' . $options['id'] . '">' . $options['label'] . '</label>';
    $str .= '  <div class="controls">';
    
    if($options['type'] == 'combo'){ 
      $optCombo = $options['comboAttr'];
 
      $str .= '<select  id="' . $options['id'] . '" name="' . $options['id'] .'" '.$atrr.'>';
      $str .= '<option value="">Select</option>';     
      foreach ($optCombo['dataProvider'] as $keyOption => $valueOption) {
        $selectCombo = ($valueOption->$optCombo['dataField'] == $optCombo['selectedValue'])?' selected="selected" ':'';

        $str .= '<option value="'.$valueOption->$optCombo['dataField'].'" '.$selectCombo.'>'.$valueOption->$optCombo['labelField'].'</option>';
      }
      $str .= '</select>';

    }else if($options['type'] == 'arrayCheckbox'){
      $opArray = $options['arrayAttr'];
      $count = 1;
      
      foreach ($opArray['dataProvider'] as $keyOption => $valueOption) {
        $select  = (in_array($valueOption->$opArray['dataField'], $opArray['selectedValues']))?' checked="checked" ':'';

        $str .= '<label class="checkbox" for="'.$options['id'].'">';
        $str .= '  <input name="'.$options['id'].'[]'.'" value="'.$valueOption->$opArray['dataField'].'"  '. $select.' type="checkbox" '.$atrr.'>';
        $str .= $valueOption->$opArray['labelField'];
        $str .= '</label>';
      }

    }else if($options['type'] == 'checkbox'){
       $select  = ($options['value'] == '1')?' checked="checked" ':'';
       // $str .= '<label class="checkbox">';
        $str .= '  <input id="' . $options['id'] . '" name="' . $options['id'] . '" value="1"  '. $select.' type="checkbox" '.$atrr.'>';
       // $str .= '</label>';

    }else if($options['type'] == 'view'){ 
      $str .= '<span>'.$options['value'].'</span>';

    }else if($options['type'] == 'textArea'){ 
      $str .= '    <textArea class="span3" '.$req.' '.$atrr.'  id="' . $options['id'] . '" name="' . $options['id'] . '" rows="3" ">'.$options['value'].'</textArea>';

    }else if($options['type'] == 'richEditor'){
      $str .= '    <textArea class="span3 mceEditor" '.$req.' '.$atrr.'  id="' . $options['id'] . '" name="' . $options['id'] . '" rows="3" ">'.$options['value'].'</textArea>';
    
    }else{ //if($options['type'] == 'text'){ 
      $str .= '    <input class="span3" '.$req.' '.$atrr.' id="' . $options['id'] . '" name="' . $options['id'] . '" value="' . $options['value'] . '" type="' . $options['type'] . '">';
    }
 
    if($error != ''){
      $str .= '    <span class="help-inline">' . $options['errors'] . '</span>';
    }

    $str .= '  </div>';
    $str .= '</div>';
  }

	return $str;
}


/**
 * Retorna a string 'active' se o link passado for o atual, ou 'dentro' do atual
 * 
 * @param string $link
 */
function isActiveLink($link){
  $ci = &get_instance();
 
  $d = ($ci->router->directory == '')?'':$ci->router->directory;
  $c = $ci->router->class.'/';
  $m = $ci->router->method;
  $link = strtoupper($link);

  return (strtoupper($d . $c .$m) == $link || !(strrpos(strtoupper($d . $c .$m), $link) === false))?'active':'';
}


/**
 * Gera uma lista com a páginação
 * 
 * @param string $totalItens
 * @param string $perPage
 * @param string $startPage
 * @param string $linkBase
 * @param string $getParans
 */
function generatePagination($totalItens, $perPage, $startPage, $linkBase, $getParans){

  $p = new pagination();
  
  $p->items($totalItens);

  $urlParans = implode(
          array_map(
            create_function('$key,$value', 'return $key."=".$value."&";' ),
            array_keys($getParans),
            array_values($getParans)
          )
        );

  $p->target($linkBase . '?' . $urlParans);
  $p->limit($perPage);
  $p->currentPage($startPage);
  return $p->getOutput();

}