
<?php

foreach ($js as $_js){
    ?>
    <script src="<?php echo $_js; ?>"></script>
    <?php
}
if(!empty($view_scripts)){
	
foreach ($view_scripts as $_view_scripts){
        ?>
		
<script src="<?php echo $_view_scripts; ?>"></script>
<?php
}
}

?>
