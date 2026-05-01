<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $this->title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="icon" type="image/png" href="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>">
    <link rel="shortcut icon" type="image/png" href="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>">
	<!-- App css -->
	<?php $this->load->view('admin/includes/layouts.css.php'); ?>

</head>
<body>
