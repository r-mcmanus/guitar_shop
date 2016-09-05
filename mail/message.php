<?php

$customer_name = $_SESSION['user']['firstName'] . ' ' .
                 $_SESSION['user']['lastName'];

$destination = $_SESSION['user']['emailAddress'];

$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);



//    ob_start();                      // start capturing output
//    include('email_template.php');   // execute the file
//    $messageHTML = ob_get_contents();    // get the contents from the buffer
//    ob_end_clean();  

$messageHTML = '<html>
<head>
<title>HTML email</title>
</head>
<body>
   <p>Hello ' . $customer_name . ',
   <p>Thank you for shopping with Guitar Shop. Your order will be shipped soon.</p>

</body>
</html>

';

$message =  ' This is information that will not be HTML friendly for Emails that do not support HTML';





$messageHTML = '<html>
<head>
<title>HTML email</title>
</head>
<body>
    <p>Hello ' . $customer_name . ',
    <p>Thank you for shopping with Guitar Shop. Your order will be shipped soon.</p>
    <table>
        <tr>
            <th>Item</th>
            <th>Quantity</th>


</body>
</html>

';




//<h2>Order Items</h2>
//    <table id="cart">
//        <tr id="cart_header">
//            <th class="left">Item</th>
//            <th class="right">List Price</th>
//            <th class="right">Savings</th>
//            <th class="right">Your Cost</th>
//            <th class="right">Quantity</th>
//            <th class="right">Line Total</th>
//        </tr>'.
//        
//        $subtotal = 0;
//        foreach ($order_items as $item) :
//            $product_id = $item['productID'];
//            $product = get_product($product_id);
//            $item_name = $product['productName'];
//            $list_price = $item['itemPrice'];
//            $savings = $item['discountAmount'];
//            $your_cost = $list_price - $savings;
//            $quantity = $item['quantity'];
//            $line_total = $your_cost * $quantity;
//            $subtotal += $line_total;
//        
//        '<tr>
//            <td>' . htmlspecialchars($item_name); '</td>
//            <td class="right">
//                ' . sprintf('$%.2f', $list_price); '
//            </td>
//            <td class="right">
//                ' . sprintf('$%.2f', $savings); '
//            </td>
//            <td class="right">
//                ' . sprintf('$%.2f', $your_cost); '
//            </td>
//            <td class="right">
//                ' . $quantity; '
//            </td>
//            <td class="right">
//                ' . sprintf('$%.2f', $line_total); '
//            </td>
//        </tr>
//        <!-- php endforeach; -->
//        <tr id="cart_footer">
//            <td colspan="5" class="right">Subtotal:</td>
//            <td class="right">
//                ' . sprintf('$%.2f', $subtotal); '
//            </td>
//        </tr>
//        <tr>
//            <td colspan="5" class="right">
//                ' . htmlspecialchars($shipping_address['state']); ' Tax:
//            </td>
//            <td class="right">
//                ' . sprintf('$%.2f', $order['taxAmount']); '
//            </td>
//        </tr>
//        <tr>
//            <td colspan="5" class="right">Shipping:</td>
//            <td class="right">
//                ' . sprintf('$%.2f', $order['shipAmount']); '
//            </td>
//        </tr>
//            <tr>
//            <td colspan="5" class="right">Total:</td>
//            <td class="right">
//                ' .
//                    $total = $subtotal + $order['taxAmount'] +
//                             $order['shipAmount'];
//                    sprintf('$%.2f', $total);
//            '</td>
//        </tr>
//    </table>