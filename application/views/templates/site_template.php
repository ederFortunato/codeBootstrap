<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/style_site.css" rel="stylesheet">
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">   
    <link href="assets/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo site_url('favicon.ico')?>">
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
          <a class="brand" href="<?php echo site_url()?>">Project</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><?php echo anchor('/auth/Login/', 'Login'); ?></li>
              <li><?php echo anchor('/auth/register/', 'register'); ?></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </header>

    <div class="container">
      <div class="row">
        <div class="span9">
          <?php include(BASEPATH.'../'.VIEWPATH . $content) ?>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery/jquery.js"><\/script>')</script>

    <!-- scripts concatenated and minified via build script -->
    <script src="assets/js/bootstrap/bootstrap-collapse.js"></script>
    <script src="assets/js/script_site.js"></script>
    <!-- end scripts -->

  </body>
</html>
