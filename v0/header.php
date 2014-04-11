<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<h1>ETSIM: Electricity Trading Simulator</h1>
<?php 
	if (login_check($mysqli) == true) : 
	$player_name = htmlentities($_SESSION['username']);
?>
	<p>
		Logged in as <?php echo $player_name; ?> | <a href="logout.php">Log out</a> | <a href="index.php">Main page</a> | <a href="javascript:history.go(0)">Refresh page</a> 
		<?php
			$role = htmlentities($_SESSION['role']);
			if($role=="Admin"):
				echo "| <a href=\"admin.php\">Admin panel</a>";
			endif;
		?>
	</p>
	</br>
<?php endif; ?>