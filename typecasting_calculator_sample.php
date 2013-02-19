<!DOCTYPE html>
<html>
<head>
	<title>Calculator Example</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />	
</head>
<body>
<?php #This script calculates an order total based upon three form values. It displays 
 	  # the Typecasting feature of PHP.

// check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// cast all the variables to a specific type:
	$quantity = (int) $_POST['quantity'];
	$price = (float) $_POST['price'];
	$tax = (float) $_POST['tax'];
	
	// all variables should be positive!
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