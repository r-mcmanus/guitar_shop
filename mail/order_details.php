<?php 
$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
$order = get_order($order_id);
$order_items = get_order_items($order_id);
$shipping_address = get_address($order['shipAddressID']);

$customer_name = $_SESSION['user']['firstName'] . ' ' .
                 $_SESSION['user']['lastName'];

?>
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Hello <?php echo $customer_name; ?>,
<p>Thank you for shopping with Guitar Shop. Your order will be shipped soon.</p>
<h2>Order Items</h2>
<table id="cart">
    <tr id="cart_header">
        <th class="left">Item</th>
        <th class="right">List Price</th>
        <th class="right">Savings</th>
        <th class="right">Your Cost</th>
        <th class="right">Quantity</th>
        <th class="right">Line Total</th>
    </tr>
    <?php
    $subtotal = 0;
    foreach ($order_items as $item) :
        $product_id = $item['productID'];
        $product = get_product($product_id);
        $item_name = $product['productName'];
        $list_price = $item['itemPrice'];
        $savings = $item['discountAmount'];
        $your_cost = $list_price - $savings;
        $quantity = $item['quantity'];
        $line_total = $your_cost * $quantity;
        $subtotal += $line_total;
        ?>
        <tr>
            <td><?php echo htmlspecialchars($item_name); ?></td>
            <td class="right">
                <?php echo sprintf('$%.2f', $list_price); ?>
            </td>
            <td class="right">
                <?php echo sprintf('$%.2f', $savings); ?>
            </td>
            <td class="right">
                <?php echo sprintf('$%.2f', $your_cost); ?>
            </td>
            <td class="right">
                <?php echo $quantity; ?>
            </td>
            <td class="right">
                <?php echo sprintf('$%.2f', $line_total); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr id="cart_footer">
        <td colspan="5" class="right">Subtotal:</td>
        <td class="right">
            <?php echo sprintf('$%.2f', $subtotal); ?>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="right">
            <?php echo htmlspecialchars($shipping_address['state']); ?> Tax:
        </td>
        <td class="right">
            <?php echo sprintf('$%.2f', $order['taxAmount']); ?>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="right">Shipping:</td>
        <td class="right">
            <?php echo sprintf('$%.2f', $order['shipAmount']); ?>
        </td>
    </tr>
        <tr>
        <td colspan="5" class="right">Total:</td>
        <td class="right">
            <?php
                $total = $subtotal + $order['taxAmount'] +
                         $order['shipAmount'];
                echo sprintf('$%.2f', $total);
            ?>
        </td>
    </tr>
</table>