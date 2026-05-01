<?php

foreach ($css as $_css){
    ?>
    <link href="<?php echo $_css ?>" rel="stylesheet">
    <?php
}
if(!empty($view_css)){
	
foreach ($view_css as $_view_css){
        ?>

<link href="<?php echo $_view_css ?>" rel="stylesheet">
<?php
}
}