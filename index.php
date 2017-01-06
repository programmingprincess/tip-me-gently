<html>
<head>
	<title>Tip Me Gently</title>
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2>Tip Calculator</h2>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
		<div class = "bill-subtotal">
			<h3>Bill subtotal: $</h3> <input type = "text" name = "subtotal" value = "<?php echo isset($_POST['subtotal']) ? $_POST['subtotal'] : '' ?>" />
		</div>

		<h3>Tip percentage:</h3>
		<?php 
			for($x = 15; $x <= 25; $x+=5) {
				echo '<input type = "radio" name = "percentage" value="', $x/100, '" ';
				if(isset($_POST['percentage']) == 'Yes' && $_POST['percentage'] == $x/100)  
					echo 'checked="checked"';
				echo '/>', $x, '%';
			}
		?>

		<input name = "submit" type = "submit"/> 
	</form>

	<?php
		//when submit button is pressed
		if(isset($_POST['submit'])) {
			//values must be numeric
			if(is_numeric($_POST['subtotal']) && is_numeric($_POST['percentage'])) {	
				$subtotal = $_POST['subtotal'];
				$tip_percentage = $_POST['percentage'];

				$tip = $subtotal * $tip_percentage;
				$total = $subtotal + $tip;


				echo '<h4> Tip: $', number_format($tip, 2, '.', ''), '</h4>';
				echo '<h4> Total: $', number_format($totals, 2, '.', ''), '</h4>';

			} else {
				echo "Required fields are missing";
			}
		}
	?>

</body>
</html>

