<?php
include('connection.php');

$query = isset($_GET['q']) ? trim(strip_tags(addslashes($_GET['q']))) : null;

if ($query) {
	$where = "name LIKE '%$query%' OR description LIKE '%$query%' OR category LIKE '%$query%' OR sub_category LIKE '%$query%'";
	$catalog = mysqli_query($dbc, "SELECT * FROM catalog WHERE $where LIMIT 1000");
} else {
	$catalog = mysqli_query($dbc, "SELECT * FROM catalog LIMIT 1000");
}

?>


<table id="p-table">
	<tr style="display: flex; flex-wrap: wrap;">

		<?php
		while ($items = mysqli_fetch_array($catalog)) {
		?>

			<td>
				<div class="p-cell">
					<form method="POST" action="/cart/add-product.php">
						<input type="hidden" name="page" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />
						<input type="hidden" name="id" value="<?php echo $items['id'] ?>"></input>
						<div class="p-cell-display">
							<img class="p-cell-image" src="/images/<?php echo $items['img'] ?>">
						</div>
						<div class="p-name"><?php echo $items['name'] ?></div>
						<div class="p-price"><?php echo $items['price'] ?>&euro;</div>
						<div class="p-description"><?php echo $items['description'] ?></div>
						<div class="p-category"><?php echo $items['category'] ?></div>
						<div class="p-sub_category"><?php echo $items['sub_category'] ?></div>
						
						<div class="quantity-and-btn">
							<input class="p-quantity" type="number" name="quantity" value="1" >
							<button class="p-add">Add to Cart</button>
						</div>
					</form>
				</div>
			</td>

		<?php } ?>

	</tr>
</table>