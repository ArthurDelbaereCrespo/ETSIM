<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ETSIM: create new game</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
		<?php include('header.php'); ?>
		
		<?php if (login_check($mysqli) == true) : ?>
            <p>
				<form name="htmlform" method="post" action="includes/new_game.inc.php">
				<table width="450px">
				</tr>
				<tr>
				 <td valign="top">
				  <label for="gamename">Game name *</label>
				 </td>
				 <td valign="top">
				  <input  type="text" name="gamename" maxlength="50" size="30">
				 </td>
				</tr>
				 
				<tr>
				 <td valign="top"">
				  <label for="location">Location *</label>
				 </td>
				 <td valign="top">
				  <input  type="text" name="location" maxlength="50" size="30">
				 </td>
				</tr>
				
				<tr>
				 <td valign="top">
				  <label for="comments">Comments to players *</label>
				 </td>
				 <td valign="top">
					<textarea  name="comments" maxlength="1000" cols="25" rows="6">Start time, specific instructions, ...</textarea>
				 </td>
				</tr>
				
				<tr>
				 <td colspan="2" style="text-align:left">
				  <input type="submit" value="Create the game">
				 </td>
				</tr>
				</table>
				</form>
            </p>
			<p></p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a> or <a href="register.php">register</a>.
            </p>
        <?php endif; ?>
		<?php include('footer.php'); ?>
		</body>
</html>