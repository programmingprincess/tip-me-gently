<html>
<head>
	<title>Tip Me Gently</title>
	<link href="main.css" rel="stylesheet" type="text/css">
</head>
<?php
	//when submit button is pressed
	if(isset($_POST['submit'])) {
		//values must be numeric
		if(is_numeric($_POST['subtotal']) && (is_numeric($_POST['percentage']) || ($_POST['percentage'] == "custom") && is_numeric($_POST['custom'])) && is_numeric($_POST['split'])) {	
			$subtotal = $_POST['subtotal'];
			$tip_percentage = $_POST['percentage'];
			if(is_numeric($_POST['percentage'])) {
				$tip_percentage = $_POST['percentage'];
			} else {
				$tip_percentage = $_POST['custom']/100;
			}

			$tip = $subtotal * $tip_percentage;
			$total = $subtotal + $tip;

			$tip /= $_POST['split'];
			$total /= $_POST['split'];


			$results = '<h3 class = "results"> Tip: $' . number_format($tip, 2, '.', '') . '</h3>' .
			'<h3 class = "results"> Total: $' . number_format($total, 2, '.', '') . '</h3>';

		} else {
			if(!is_numeric($_POST['subtotal'])) {
				$billError = "Please enter a numeric value.";
			} else {
				$billError = "";
			}

			if((!is_numeric($_POST['percentage'])) || ($_POST['percentage'] == "custom" && !is_numeric($_POST['custom'])))  {
				$tipError = "Please select a numeric value.";
			} else {
				$tipError = "";
			}

			if(!is_numeric($_POST['split']))  {
				$payerError = "Please select a numeric value.";
			} else {
				$payerError = "";
			}

		}
	}
?>
<body>
	<div class = "container">
		<h1>Tip Calculator</h1>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
			<div class = "bill-subtotal">
				<h3>Bill subtotal: </h3> <div class = "sub"><h3 class = "dolla">$</h3><input type = "text" name = "subtotal" class = "subtotal" value = "<?php echo isset($_POST['subtotal']) ? $_POST['subtotal'] : '' ?>" /></div>
				<div class = "error"><?php echo $billError ?></div>

				<h3>Number of payers: </h3> <input type = "text" name = "split" class = "split" value = "<?php echo isset($_POST['split']) ? $_POST['split'] : '' ?>" />
				<div class = "error"><?php echo $payerError ?></div>
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

			<div class = "error"><?php echo $tipError ?></div>
	 
			<input name = "submit" type = "submit" class = "button"/> 

		</form>

		<?php echo $results ?>

	</div>

</body>
</html>

