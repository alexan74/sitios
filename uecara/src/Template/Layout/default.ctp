<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<?php if(1==3): ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php //echo $this->fetch('title') ?>
        UECARA - Administración
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
	
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>

<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>UECARA - Administración</title>

  <!-- Custom fonts for this template-->
  <?= $this->Html->css('/vendor/fontawesome-free/css/all.min.css') ?>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <?= $this->Html->css('sb-admin-2.min.css') ?>
  <?= $this->Html->css('base.css') ?>
  <?= $this->Html->css('style.css') ?>
  <?= $this->Html->css('jquery-ui.css') ?>
  
  <?= $this->Html->script('/vendor/jquery/jquery.min.js'); ?>
  
  
  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php echo $this->element('sidebar') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php echo $this->element('topbar') ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content --> 
        <div class="container-fluid">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php echo $this->element('footer') ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  
  <!-- Scroll to Top Button-->
  <?php echo $this->element('scroll-to-top') ?>

  <!-- Logout Modal-->
  <?php echo $this->element('logout-modal') ?>

  <script type="text/javascript">
    $(document).ready(function(){
		$('.card.bg-danger, .card.bg-success').fadeOut(30000);
		$('.card.bg-danger, .card.bg-success').click(function() { $(this).hide();})
	});
  </script>
  
  <?= $this->Html->script('/vendor/jquery/jquery.validate.min.js'); ?>
  <!-- Bootstrap core JavaScript-->
  <?= $this->Html->script('/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>
  
  <?= $this->Html->script('/vendor/jquery/jquery-ui.js'); ?>

  <!-- Core plugin JavaScript-->
  <?= $this->Html->script('/vendor/jquery-easing/jquery.easing.min.js'); ?>
  
  <?= $this->Html->script('/vendor/jquery/bootbox.min.js'); ?>

  <!-- Custom scripts for all pages-->
  <?= $this->Html->script('sb-admin-2.min.js'); ?>

  <!-- Page level plugins -->
  <!--<?= $this->Html->script('/vendor/chart.js/Chart.min.js'); ?>-->

  <!-- Page level custom scripts -->
  <!--<?= $this->Html->script('demo/chart-area-demo.js'); ?>
  <?= $this->Html->script('demo/chart-pie-demo.js'); ?>-->

</body>

</html>
