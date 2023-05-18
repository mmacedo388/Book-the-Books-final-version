<?php
include('../connection.php');

$query = isset($_GET['q']) ? trim(strip_tags(addslashes($_GET['q']))) : null;

$where = '';

if ($query) {
    $where = "WHERE name LIKE '%$query%' OR description LIKE '%$query%' OR category LIKE '%$query%' OR sub_category LIKE '%$query%'";
}

$catalog = mysqli_query($dbc, "SELECT catalog.*, category.name AS category, sub_category.name AS sub_category FROM `catalog` 
 JOIN category ON category.id = catalog.category_id
 JOIN sub_category ON sub_category.id = catalog.sub_category_id $where");
?>


<div id="p-table">
	<?php
    while ($items = mysqli_fetch_array($catalog)):
        ?>
	<div>
			<div class="p-cell">
				<form class="form" method="POST" action="/cart/add-product.php">
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
						<input class="p-quantity" type="number" name="quantity" min="1" value="1" >
						<button class="button">Add to Cart</button>
					</div>
				</form>
			</div>
	</div>
	<?php endwhile ?>
</div>