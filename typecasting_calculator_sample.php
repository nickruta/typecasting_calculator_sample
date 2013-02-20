<!DOCTYPE html>
<html>
<head>
	<title>Widget Cost Calculator</title>
	<link href="assets/style.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="assets/jquery-1.9.1.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="assets/calculator.js" charset="utf-8"></script>
	
</head>
<body>
<?php #This script calculates an order total based upon three form values. It displays 
 	  # the Typecasting feature and Filter extension of PHP 5.2 or later.

// check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitize the variables
	$quantity = (isset($_POST ['quantity'])) ? filter_var($_POST['quantity'], FILTER_VALIDATE_INT, array('min_range' => 1)) : NULL;
	$price = (isset($_POST['price'])) ? filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : NULL;
	$tax = (isset($_POST['tax'])) ? filter_var($_POST['tax'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : NULL;
	
	/* all variables should be positive! They must be positive numbers. The rules of Typecasting state that if they are not numbers, they will be posted as 0 and fail this validation */
	if ( ($quantity > 0) && ($price > 0) && ($tax >0) ) {
		// calculate the total
		$total = $quantity * $price;
		$total += $total * ($tax/100);
		
		// print the result
		echo '<p>The total cost of purchasing ' . $quantity . ' widget(s) at $' . number_format ($price, 2) . ' each, plus tax, is $' . number_format ($total, 2) . '.</p>';
		
	} else {
		 // invalid submitted values
		echo '<p style="font-weight: bold; color: #c00">Please enter a valid quantity, price and tax rate.</p>';
	}
} // End of main isset() If.

// Leave the PHP section and create the html form

?>

<h2>Cost Calculator</h2>
<form action="typecasting_calculator_sample.php" method="post">
	<p>Quantity: <input type="text" name="quantity" size="5" maxlength="10" value="<?php if (isset($quantity)) echo $quantity; ?>" /></p>
	<p>Price: <input type="text" name="price" size="5" maxlength="10" value="<?php if (isset($price)) echo $price; ?>" /></p>
	<p>Tax (%): <input type="text" name="tax" size="5" maxlength="10" value="<?php if (isset($tax)) echo $tax; ?>" /></p>
	<p><input type="submit" name="submit" value="Calculate!" /></p>
</form>

</body>
</html>