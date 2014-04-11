<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ETSIM: Electricity Trading Simulator</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
		<?php include('header.php'); ?>
			
		<?php if (login_check($mysqli) == true) : ?>
			<h3>Open games</h3>
			<p>
                <?php
				$con=mysqli_connect("mysql51-106.perso", "robinrocmod1", "xxxxxxxxxxxxxx","robinrocmod1");
				// Check connection
				if (mysqli_connect_errno())
				  {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  }

				$result = mysqli_query($con,"SELECT * FROM etsim_games WHERE status='Waiting players' OR status='Playing'");
				$num_rows = mysqli_num_rows($result);
				
				if($num_rows==0):
				{
					echo "No game currently open!";
				}
				else:
				{
					Print "<table border cellpadding=3>"; 
					
					while($row = mysqli_fetch_array($result))
					{
						Print "<tr>"; 
						Print "<th>Date:</th> <td>".$row['creationtime'] . "</td> "; 
						Print "<th>Name:</th> <td>".$row['name'] . "</td> "; 
						Print "<th>Location:</th> <td>".$row['location'] . "</td> "; 
						Print "<th>Comments:</th> <td>".$row['comments'] . " </td> "; 
						Print "<th>Status:</th> <td>".$row['status'] . " </td></tr>";
					}
					
					Print "</table>"; 
				}
				endif;
				?>
            </p>
			
			<h3>Join a game</h3>
			<p>
				<?php 
					// Extract all playing games
					$i=0;
					$result = mysqli_query($con,"SELECT * FROM etsim_games WHERE status='Waiting players' OR status='Playing'");
					$num_rows = mysqli_num_rows($result);
					if($num_rows==0):
					{
						echo "No game currently open!";
					}
					else:
					{
				?>
						<form action="join_game.php" method="POST" />
							Select a game to join:  
							<select name="listBox" id="listBox" style="width:300px;height=200px;"> 
							<?php 
								$i=0;
								while($row = mysqli_fetch_array($result))
								{
									echo "<option value=" . $i . ">" . $row['name'] . "@" . $row['creationtime'] . "</option>";
									$i++; 
								} 
							?>
							</select>
							<input type="submit" name="joinButton" id="joinButton" value="Join game" />
							</br>
						</form>
				<?php
					}
					endif;
				?>
			</p>
			
			<h3>Your past games</h3>
			<p>
                <?php
				$result = mysqli_query($con,"SELECT * FROM etsim_games WHERE status='Over'");

				$num_rows = mysqli_num_rows($result);
				if($num_rows==0):
				{
					echo "No past game listed.";
				}
				else:
				{
				
				Print "<table border cellpadding=3>"; 
				
				while($row = mysqli_fetch_array($result))
				{
					Print "<tr>"; 
					Print "<th>Date:</th> <td>".$row['creationtime'] . "</td> "; 
					Print "<th>Name:</th> <td>".$row['name'] . "</td> "; 
					Print "<th>Location:</th> <td>".$row['location'] . "</td> "; 
					Print "<th>Comments:</th> <td>".$row['comments'] . " </td> "; 
					Print "<th>Status:</th> <td>".$row['status'] . " </td></tr>";
				}
				
				Print "</table>"; 
				}
				endif;
				mysqli_close($con);
				?>
			</p>
			
			<p>
				TODO: join game + return to game (link in table), custom list of past games
			</p>
			
			
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a> or <a href="register.php">register</a>.
            </p>
        <?php endif; ?>
		<?php include('footer.php'); ?>
    </body>
</html>