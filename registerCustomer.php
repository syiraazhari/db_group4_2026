<!DOCTYPE html>
<html>
<head>
	<title> Register An Account </title>
</head>

<div>
<body>
	<form action="registerprocess.php" method="POST">
	<div class="container">
		<h1><b> Registration </b></h1>
		<p> Please register to login </p>
		<br>
		
		<p>
		<label> Username </label>
		<input type="text" name="username" required>
		</p>
		
		<p>
		<label> First Name </label>
		<input type="text" name="fname" required>
		</p>
		
		<p>
		<label> Last Name </label>
		<input type="text" name="lname" required>
		</p>
		
		<p>
		<label> Location </label>
		<input type="text" name="location">
		</p>
		
		<p>
		<label> Birthday </label>
		<input type="date" name="birthday">
		</p>
		
		<p>
		<label> Email Address </label>
		<input type="email" name="mail" required>
		</p>
		
		<p>
		<label> Password </label>
		<input type="password" name="passw" required>
		</p>
	</form>
	</div>
</div>
</body>
</html>