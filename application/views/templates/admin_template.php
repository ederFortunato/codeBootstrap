<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Project | <?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->    
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="assets/css/noty/jquery.noty.css" rel="stylesheet" />
    <link href="assets/css/noty/noty_theme_twitter.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?=site_url('favicon.ico')?>">
    <!--[if lt IE 9]>
      <script src="assets/js/html5Shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <header class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?=site_url('admin')?>">Project name</a>
          <div class="nav-collapse">
            <p class="navbar-text pull-right">
              <?php echo anchor('/auth/logout/', 'logout'); ?>
            </p>
            <ul class="nav pull-right">
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Hi, <?=$USER_LOGIN_NAME?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><?=anchor('/auth/change_email/', 'Change Email')?></li>
                  <li><?=anchor('/auth/change_password/', 'Change Password')?></li>
                  <li class="divider"></li>
                  <li><?=anchor('/auth/unregister/', 'Unregister')?></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </header>

    <div class="container">
      <div class="row">
        <div class="span3">

          <div class="well sidebar-nav">
            <ul id="menuPermissions" class="nav nav-list ">
            <?
            if(isset($listMenu)){
              foreach ($listMenu as $keyParent => $rowParent) {
                if($rowParent->parentID == 0){
                  echo '<li class="nav-header"><i class="icon-minus"></i> '.$rowParent->permName.'</li>';
                  foreach ($listMenu as $keyChild => $rowChild) {
                    if($rowChild->parentID == $rowParent->permID){
                      echo '<li class="nav-child '.isActiveLink($rowChild->permKey).'">';
                      echo anchor($rowChild->permKey, $rowChild->permName);
                      echo '</li>';
                    }
                  }
                }
              }
            }
            ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->

        <div class="span9">
          <div class="well">         
            <? include(BASEPATH.'../'.VIEWPATH . $content) ?>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>
 
      <!-- sample modal content -->
      <div id="ModalConfirmRemove" class="modal hide fade">
        <div class="modal-header">
          <a class="close" data-dismiss="modal" >&times;</a>
          <h3>Atenção</h3>
        </div>
        <div class="modal-body">
          <h4>Deseja Mesmo Fazer isso?</h4>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal" >Não</a>
          <a href="#" class="btn btn-primary confirm-link" data-confirm-link="<?php echo site_url($linkBase.'/remove'); ?>" ?><i class="icon-ok icon-white"></i> Sim</a>
        </div>
      </div>


    <!-- JavaScript at the bottom for fast page loading -->

    <!-- scripts concatenated and minified via build script -->
    <script src="assets/js/jquery/jquery.js"></script>
    <script src="assets/js/jquery/jquery.noty.js"></script>
    <script src="assets/js/bootstrap/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap/bootstrap-dropdown.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- end scripts -->
    
  </body>
</html>