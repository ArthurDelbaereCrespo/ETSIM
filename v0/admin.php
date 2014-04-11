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
			
		<?php if (login_check($mysqli) == true && htmlentities($_SESSION['role'])=="Admin") : ?>
			<h2>Administration panel</h2>
			
			<p>
				<h3>New game</h3>
				<a href="new_game.php">Create a new game</a>
			</p>
			
			<p>
				<h3>Change game status</h3>
				<?php 
					$con=mysqli_connect("mysql51-106.perso", "robinrocmod1", "xxxxxxxxxxx","robinrocmod1");
					// Check connection
					if (mysqli_connect_errno())
					{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					// Extract all playing games
					$i=0;
					$result = mysqli_query($con,"SELECT * FROM etsim_games");
					$num_rows = mysqli_num_rows($result);
					if($num_rows==0):
					{
						echo "No game listed!";
					}
					else:
					{
				?>				
					<form action="includes/edit_game.php" method="POST" />
					Select the game to change: </br>
					<select name="listBox" id="listBox" style="width:300px;height=200px;"> 
					<?php 
						$i=0;
						while($row = mysqli_fetch_array($result))
						{
							echo "<option value=" . $row['table_name'] . ">" . $row['table_name']  . "</option>";
							$i++; 
						} 
					?>
					</select>
					</br></br>
					Select the new status for the game: </br>
					<select name="listBox2" id="listBox2" style="width:300px;height=200px;"> 
						<option value="Over">Over</option>
						<option value="Waiting players">Waiting players</option>
						<option value="Playing">Playing</option>
					</select>
					</br></br>
					<input type="submit" name="endButton" id="endButton" value="Change status" />
					</br>
					</form>
				<?php
					}
					endif;
				?>
			</p>
			
			<p>
				<h3>List of games</h3>	
				<?php
				$result = mysqli_query($con,"SELECT * FROM etsim_games");
				$num_rows = mysqli_num_rows($result);
				
				if($num_rows==0):
				{
					echo "No game listed!";
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
			
			<p>
				<h3>List of users</h3>				
				<?php
				$result = mysqli_query($con,"SELECT * FROM etsim_members");

				Print "<table border cellpadding=3>"; 
					
				while($row = mysqli_fetch_array($result))
				{
					Print "<tr>"; 
					Print "<th>Username:</th> <td>".$row['username'] . "</td> "; 
					Print "<th>Email:</th> <td>".$row['email'] . "</td> ";
					Print "<th>Role:</th> <td>".$row['role'] . "</td></tr>";
				}
				
				Print "</table>";

				mysqli_close($con);
				?>
			</p>
			
			<p>
				TODO: game manager, list of players, remove game. Game page itself: bid form, results + graph, history. Game analysis for manager. Separate admin/manager. Use mysqli instead of con (no db login in page). Change role.
			</p>
			
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a> or <a href="register.php">register</a>.
            </p>
        <?php endif; ?>
		<?php include('footer.php'); ?>
    </body>
</html>