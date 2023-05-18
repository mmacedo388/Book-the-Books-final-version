<form class="form" method="post" action="/login/process.php">
    <h3>Please login</h3>

    <?php if (isset($_GET['error'])) : ?>
        <div class="error-msg">Invalid data</div>
    <?php endif ?>

    <p>Email: <input type="email" required name="email" maxlength="50"></p>
    <p>Password: <input type="password" required name="password" maxlength="50"></p>
    <input type="submit" value="Submit" />
</form>