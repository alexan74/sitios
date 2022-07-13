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
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php //echo $this->fetch('title') ?>
        UECARA DEL INTERIOR
    </title>
    <?= $this->Html->meta('icon') ?>

	
	<?= $this->Html->css('/vendor/fontawesome-free/css/all.min.css') ?>
  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
  	<?= $this->Html->css('sb-admin-2.min.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
	
	<?= $this->Html->script('/vendor/jquery/jquery.min.js'); ?>
	
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="bg-gradient-uecara">
    <?= $this->Flash->render() ?>
    <div class="clearfix">
        <?= $this->fetch('content') ?>
    </div>
        
    <?= $this->Html->script('/vendor/jquery/jquery.validate.min.js'); ?>
    <!-- Bootstrap core JavaScript-->
  	<?= $this->Html->script('/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>

    <!-- Core plugin JavaScript-->
  	<?= $this->Html->script('/vendor/jquery-easing/jquery.easing.min.js'); ?>
  	
  	<?= $this->Html->script('/vendor/jquery/bootbox.min.js'); ?>

    <!-- Custom scripts for all pages-->
  	<?= $this->Html->script('sb-admin-2.min.js'); ?>
  
  <script type="text/javascript">
	var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

    $(document).ready(function(){
		$('.card.bg-danger, .card.bg-success').fadeOut(30000);
		$('.card.bg-danger, .card.bg-success').click(function() { $(this).hide();})
	});
  </script>
</body>
</html>
