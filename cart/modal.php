<?php
require(dirname(__DIR__) . '/connection.php');

$cart = $_SESSION['cart'] ?? null;

$productIds = array_map(function ($line) {
    return $line['product_id'];
}, $cart['lines'] ?? []);

if ($productIds) :

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

    // $cartTotal = number_format($cartTotal, 2, ',', ''); // só funcionaria para pt-PT
    $formatter = new NumberFormatter('pt-PT', NumberFormatter::CURRENCY); // basta mudar pt-PT para en-US por exemplo
?>

    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-total="<?php echo $cartTotal ?>">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Your Shopping Cart
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                            foreach ($cart['lines'] as $line) :

                                $productId = $line['product_id'];
                                $subTotal =  ((float)$products[$productId]['price']) * ((int)$line['quantity']);
                            ?>
                                <tr data-sub-total="<?php echo $subTotal ?>">
                                    <td class="w-25">
                                        <img src="/images/<?php echo $products[$productId]['img'] ?>" class="img-fluid img-thumbnail" alt="<?php echo $products[$productId]['name'] ?>">
                                    </td>
                                    <td><?php echo $products[$productId]['name'] ?></td>
                                    <td><?php echo $formatter->formatCurrency($products[$productId]['price'], 'EUR') ?></td>
                                    <td class="qty"><input type="number" min="1" class="form-control" name="quantity" value="<?php echo $line['quantity'] ?>" data-product-id="<?php echo $productId ?>" data-price="<?php echo $products[$productId]['price'] ?>"></td>
                                    <td class="sub-total"><?php echo $formatter->formatCurrency($subTotal, 'EUR') ?></td>
                                    <td>
                                        <form action="/cart/delete-product.php" method="post" class="delete_button">
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
                        <h5>Total: <span class="price text-success cart-total"><?php echo $formatter->formatCurrency($cartTotal, 'EUR'); ?></span></h5>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/checkout" class="btn btn-success">Checkout</a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>