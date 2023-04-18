<?php
require(dirname(__DIR__).'/connection.php');

$cart = $_SESSION['cart'] ?? null;

if ($cart):

    $productIds = array_map(function ($line) {
        return $line['product_id'];
    }, $cart['lines']);

    $productIds = implode(", ", $productIds);
    $result = mysqli_query($dbc, "SELECT * FROM catalog WHERE id IN ($productIds)");
    $products = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $products[$row['id']] = $row;
    }

    $cartTotal = 0;
    foreach ($cart['lines'] as $line) {
        $id = $line['product_id'];
        $cartTotal += ((float) $products[$id]['price']) * ((int) $line['quantity']);
    }
    ?>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Your Shopping Cart
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            foreach ($cart['lines'] as $line):

                                $productId = $line['product_id'];
                                ?>
                        <tr>
                            <td class="w-25">
                                <img src="/images/<?php echo $products[$productId]['img'] ?>" class="img-fluid img-thumbnail" alt="<?php echo $products[$productId]['name'] ?>">
                            </td>
                            <td><?php echo $products[$productId]['name'] ?></td>
                            <td><?php echo $products[$productId]['price'] ?>&euro;</td>
                            <!-- <?php echo $products[$productId]['description']; ?> -->
                            <td class="qty"><input type="text" class="form-control" name="quantity" value="<?php echo $line['quantity'] ?>"></td>
                            <td><?php echo((float)$products[$productId]['price']) * ((int)$line['quantity']) ?>&euro;</td>
                            <td>
                                <form action="/cart/delete-product.php" method="post">
                                    <input type="hidden" name="page" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />
                                    <input type="hidden" name="id" value="<?php echo $productId ?>" />
                                    <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h5>Total: <span class="price text-success"><?php echo $cartTotal ?>&euro;</span></h5>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Checkout</button>
            </div>
        </div>
    </div>
</div>


<?php endif ?>