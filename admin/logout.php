	<?php
	session_start();
	$_SESSION = array();
	session_destroy();

    echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
	?>  