<html>
<head>
	<title>Tip Me Gently</title>
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class = "container">
		<h1>Tip Calculator</h1>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
			<div class = "bill-subtotal">
				<h3>Bill subtotal: $</h3> <input type = "text" name = "subtotal" class = "subtotal" value = "<?php echo isset($_POST['subtotal']) ? $_POST['subtotal'] : '' ?>" />
			</div>

			<h3>Tip percentage:</h3>
			<?php 
				for($x = 15; $x <= 25; $x+=5) {
					echo '<input type = "radio" name = "percentage" value="', $x/100, '" ';
					if(isset($_POST['percentage']) == 'Yes' && $_POST['percentage'] == $x/100)  
						echo 'checked="checked"';
					echo '/> <p class = "label">', $x, '%</p>';
				}

				echo '<input type = "radio" name = "percentage" value = "custom"';
					if(isset($_POST['percentage']) == 'Yes' && $_POST['percentage'] == "custom")  
						echo 'checked="checked"';
				echo '/>';
			?>

			<input type = "text" name = "custom" class = "custom" value = "<?php echo isset($_POST['custom']) ? $_POST['custom'] : '' ?>"/> %<br>
	 
			<input name = "submit" type = "submit" class = "button"/> 
		</form>

		<?php
			//when submit button is pressed
			if(isset($_POST['submit'])) {
				//values must be numeric
				if(is_numeric($_POST['subtotal']) && (is_numeric($_POST['percentage']) || $_POST['percentage'] == "custom")) {	
					$subtotal = $_POST['subtotal'];
					$tip_percentage = $_POST['percentage'];
					if(is_numeric($_POST['percentage'])) {
						$tip_percentage = $_POST['percentage'];
					} else {
						$tip_percentage = $_POST['custom']/100;
					}

					$tip = $subtotal * $tip_percentage;
					$total = $subtotal + $tip;


					echo '<h4> Tip: $', number_format($tip, 2, '.', ''), '</h4>';
					echo '<h4> Total: $', number_format($total, 2, '.', ''), '</h4>';

				} else {
					echo "Required fields are missing";
				}
			}
		?>
	</div>

</body>
</html>

