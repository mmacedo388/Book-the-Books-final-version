<?php 
$success = false;

if (isset($_SESSION['contact_us_form_success'])) {
	$success = true;
	unset($_SESSION['contact_us_form_success']);
}

$values = $_SESSION["contact_us_form_values"] ?? [];
$errors = $_SESSION["contact_us_form_errors"] ?? [];

$_SESSION["contact_us_form_values"] = [];
$_SESSION["contact_us_form_errors"]= [];
?>

<div class="contact_us">
  <form method="post" action="/contact-us/process.php">

	<?php if ($success): ?>
		<p class="success-msg">Thank you for your message!</p>
	<?php endif ?>


	<div class="form-row">
		<label for="user_name">Name</label>
		<input name="user_name" id="user_name" type="text" value="<?php echo $values['user_name'] ?? '' ?>" placeholder="Enter Your Name" required />

		<?php if (in_array('user_name', $errors)): ?>
		<div class="error-msg">Invalid Name</div>
		<?php endif ?>
	</div>

	<div class="form-row">
		<label for="user_email">Email</label>
		<input name="user_email" id="user_email" type="email" value="<?php echo $values['user_email'] ?? '' ?>" placeholder="Enter Your Email" required />

		<?php if (in_array('user_email', $errors)): ?>
		<div class="error-msg">Invalid Email</div>
		<?php endif ?>
	</div>

	<div class="form-row">
		<label>Gender</label>
		
		<div>
			<label>
				<input type="radio" name="user_gender" value="M" /> Male
			</label>
			<label>
				<input type="radio" name="user_gender" value="F" /> Female
			</label>
			<label>
				<input type="radio" name="user_gender" value="NB" /> Non-binary
			</label>
		</div>

		<?php if (in_array('user_gender', $errors)): ?>
		<div class="error-msg">Invalid Gender</div>
		<?php endif ?>
	</div>

	<div class="form-row">
		<label for="user_age">Age</label>

		<select name="user_age" required>
			<option value="" selected disabled hidden>Choose your age</option>
			<option value="0-29">Under 30</option>
			<option value="30-60">Between 30 & 60</option>
			<option value="60+">Over 60</option>
		</select>

		<?php if (in_array('user_age', $errors)): ?>
		<div class="error-msg">Invalid Age</div>
		<?php endif ?>
	</div>

	<div class="form-row">
		<label for="user_message">Message</label>
		<textarea name="user_message" id="user_message" placeholder="Please type your message" required>
			<?php echo $values['user_message'] ?? '' ?>
		</textarea>
		
		<?php if (in_array('user_message', $errors)): ?>
		<div class="error-msg">Invalid Message</div>
		<?php endif ?>
	</div>
		<input type="submit" value="Submit" />
    </form>
  </div>