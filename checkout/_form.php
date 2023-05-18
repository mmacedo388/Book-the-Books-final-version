<?php
if (!isset($_SESSION)) {
    session_start();
}

$values = $_SESSION['checkout_form_values'] ?? [];
$errors = $_SESSION['checkout_errors'] ?? [];

$_SESSION['checkout_errors'] = [];
$_SESSION['checkout_form_values'] = [];
?>
<form class="form" method="post" action="/checkout/process.php">
    <h3>Checkout</h3>


	<div class="form-row">
		<?php echo ($productTotalCount === 1) ? '1 product' : $productTotalCount . ' products' ?>
		&bullet;
		<?php echo $cartTotal ?>&euro;
	</div>

	<div class="form-row">
        Name: <input type="text" required name="name" maxlength="255" value="<?php echo $values['name'] ?? '' ?>">

        <?php if (in_array('name', $errors)): ?>
        <div class="error-msg">Invalid Name</div>
        <?php endif ?>
    </div>

	<div class="form-row">
        Email: <input type="email" required name="email" maxlength="255" value="<?php echo $values['email'] ?? '' ?>" />

        <?php if (in_array('email', $errors)): ?>
        <div class="error-msg">Invalid Email</div>
        <?php endif ?>
    </div>

	<div class="form-row">
        Phone Number: <input type="text" required name="phone_number" maxlength="9" value="<?php echo $values['phone_number'] ?? '' ?>" />

        <?php if (in_array('phone_number', $errors)): ?>
        <div class="error-msg">Invalid Phone Number</div>
        <?php endif ?>
    </div>

	<div class="form-row">
        Address: <input type="text" required name="address" value="<?php echo $values['address'] ?? '' ?>" />

        <?php if (in_array('address', $errors)): ?>
        <div class="error-msg">Invalid Address</div>
        <?php endif ?>
    </div>

	<div class="form-row">
        Address Zip: <input type="text" required name="address_zip" value="<?php echo $values['address_zip'] ?? '' ?>" />

        <?php if (in_array('address_zip', $errors)): ?>
        <div class="error-msg">Invalid Address Zip</div>
        <?php endif ?>
    </div>

	<div class="form-row">
		Payment Method:
		<div>
			<label for="">
				<input type="radio" name="payment_method" value="at_delivery" <?php echo ($value['payment_method'] ?? '') === 'at_delivery' ? 'checked' : 'checked' ?> />
				At Delivery
			</label>
			<!-- <label for="">
				<input type="radio" name="payment_method" value="mbway" <?php echo ($value['payment_method'] ?? '') === 'mbway' ? 'checked' : '' ?> />
				MB Way
			</label> -->
		</div>
	</div>

	    <input type="submit" value="Place Order" />
</form>