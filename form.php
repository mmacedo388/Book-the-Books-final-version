<div class="contact_us">
  <form method="post" action="processing.php">
    <p>Name : <input type="text" name="user_name" placeholder="Enter Your Name" required /><br /></p>
    <p>Email : <input type="email" name="user_email" placeholder="Enter Your Email" required /><br /></p>
    <p>Gender : <input type="radio" name="user_gender" value="M" required> Male
    <input type="radio" name="user_gender" value="F"> Female
	  <input type="radio" name="user_gender" value="NB">Non-binary</p>
	  <p>Age: <select name="user_age" required>
		<option value="" selected disabled hidden>Choose your age</option>
		<option value="0-29">Under 30</option>
		<option value="30-60">Between 30 & 60</option>
		<option value="60+">Over 60</option>
	</select></p>
    <p>Message : <textarea name="user_message" placeholder="Please type your message" required></textarea><br /></p>
	<input type="submit" value="Submit" />
    </form>
  </div>