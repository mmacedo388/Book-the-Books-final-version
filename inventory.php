<?php
include('connection.php');
$catalog = mysqli_query($dbc, "SELECT * FROM catalog LIMIT 1000");
?>


<table id="p-table">
	<tr style="display: flex; flex-wrap: wrap;">

		<?php
            while ($items=mysqli_fetch_array($catalog)) {
                ?>

		<td>
			<div class="p-cell">
				<form method="POST" action="./add_script.php">
					<input type="text" name="name" value="<?php echo $items['name'] ?>"></input>
					<input type="text" name="price" value="<?php echo $items['price'] ?>"></input>
					<input type="text" name="desc" value="<?php echo $items['desc'] ?>"></input>
					<input type="text" name="img" value="<?php echo $items['img'] ?>"></input>
					<div class="p-cell-display">
						<img class="p-cell-image" src="/images/<?php echo $items['img'] ?>">
					</div>
					<div class="p-name"><?php echo $items['name'] ?></div>
					<div class="p-price"><?php echo $items['price'] ?>&euro;</div>
					<div class="p-desc"><?php echo $items['desc'] ?></div>
					<input class="p-quantity" type="number" name="quantity" value="1">
					<button class="p-add">Add to Cart</button>

				</form>
			</div>
		</td>

		<?php } ?>

	</tr>
</table>