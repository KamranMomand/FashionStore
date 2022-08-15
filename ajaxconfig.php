<?php
session_start();
include 'config.php';
if (isset($_POST['cart'])) {
    if (isset($_SESSION['User_Id'])) {
        $pid = $_POST['p_id'];
        $user = $_SESSION['User_Id'];
        $qty = 1;
        $query = "INSERT INTO `cart`(`product_id`, `quantity`, `user_id`) VALUES ('$pid','$qty','$user')";
        $result = mysqli_query($conn, $query);
        echo $result;
    } else {
        echo "noadd";
    }
}

if (isset($_POST['Delete'])) {
    $pid = $_POST['p_id'];
    $query = "DELETE from cart where id = '$pid'";
    $result = mysqli_query($conn, $query);
    echo $result;
}


if (isset($_POST['Update'])) {
    $cid = $_POST['c_id'];
    $qty = $_POST['qty'];
    $query = "UPDATE `cart` SET `quantity`='$qty' WHERE `id`='$cid'";
    $result = mysqli_query($conn, $query);
    echo $result;
}

if (isset($_POST['AddressAdd'])) {
    $user = $_SESSION['User_Id'];
    $addresstype = mysqli_real_escape_string($conn, $_POST['a_type']);
    $address1 = mysqli_real_escape_string($conn, $_POST['a_1']);
    $address2 = mysqli_real_escape_string($conn, $_POST['a_2']);
    $country = mysqli_real_escape_string($conn, $_POST['a_country']);
    $city = mysqli_real_escape_string($conn, $_POST['a_city']);
    $state = mysqli_real_escape_string($conn, $_POST['a_state']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['a_zipcode']);

    $query = "INSERT INTO `address`(`user_id`, `address_type`, `address_line1`, `address_line2`, `country`, `city`, `state`, `zip_code`) VALUES ('$user','$addresstype','$address1','$address2','$country','$city','$state','$zipcode')";
    $result = mysqli_query($conn, $query);
    echo $result;
}

if (isset($_GET['Display'])) {
    $user = $_SESSION['User_Id'];
    $query = "select * from `address` where user_id='$user'";
    $result = mysqli_query($conn, $query);
    $empr = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $empr .= "<tr><td>" . $row['address_type'] . "</td><td>" . $row['address_line1'] . "</td><td>" . $row['address_line2'] . "</td><td>" . $row['country'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['zip_code'] . "</td><td><button class='btn btn-info btnedit' value='" . $row['id'] . "'> Edit</button> | <button class='btn btn-info btndelete' value='" . $row['id'] . "'> X </button>
        </td></tr>";
    }
    echo $empr;
}

if (isset($_GET['Allorder'])) {
    $user = $_SESSION['User_Id'];
    $query = "select * from `order_invoice` oi join `order` o on oi.order_id=o.id join `product` p on oi.product_id=p.id where user_id='$user'";
    $result = mysqli_query($conn, $query);
    $empr = "";
    while ($row = mysqli_fetch_array($result)) {
        $empr .= "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td><img width='150px' heigth='150px' src='data:image/jpg;charset=utf8;base64," . base64_encode($row['image1']) . "' class='rounded' alt='" . $row['product'] . "'/></td><td>" . $row['quantity'] . "</td><td>" . $row['total'] . "</td><td>" . $row['date'] . "</td><td><button class='btn btn-info btnocancel' value='" . $row[6] . "'> Cancel Order</button>
        </td></tr>";
    }
    echo $empr;
}


if (isset($_POST['Adelete'])) {
    $id = $_POST['a_id'];
    $query = "DELETE FROM `address` WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);
    echo $result;
}

if (isset($_POST['Ordelete'])) {
    $id = $_POST['od_id'];
    $query = "DELETE FROM `order_invoice` WHERE `order_id`='$id'";
    $result = mysqli_query($conn, $query);
    echo $result;
}

if (isset($_POST['Aedit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['a_idd']);
    $user = $_SESSION['User_Id'];
    $addresstype = mysqli_real_escape_string($conn, $_POST['a_type']);
    $address1 = mysqli_real_escape_string($conn, $_POST['a_1']);
    $address2 = mysqli_real_escape_string($conn, $_POST['a_2']);
    $country = mysqli_real_escape_string($conn, $_POST['a_country']);
    $city = mysqli_real_escape_string($conn, $_POST['a_city']);
    $state = mysqli_real_escape_string($conn, $_POST['a_state']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['a_zipcode']);

    $query = "UPDATE `address` SET `address_type`='$addresstype',`address_line1`='$address1',`address_line2`='$address2',`country`='$country',`city`='$city',`state`='$city',`zip_code`='$zipcode' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    echo $result;
}


if (isset($_POST['feedback'])) {
    $user = $_SESSION['User_Id'];
    $feedback = mysqli_real_escape_string($conn, $_POST['f_comment']);
    $pid = $_POST['p_id'];
    $date = date("Y-m-d");

    $query = "INSERT INTO `feedback`(`product_id`, `user_id`, `feedback`, `date`) VALUES ('$pid','$user','$feedback','$date')";
    $result = mysqli_query($conn, $query);
    echo $result;
}


if (isset($_POST['Order'])) {
    $user = $_SESSION['User_Id'];
    $aid = $_POST['a_id'];
    $ototal = $_POST['o_total'];
    $date = date("Y-m-d");
    $cardno = $_POST['b_card'];
    $status = "Active";

    $query = "INSERT INTO `order`(`date`, `total`, `user_id`, `address_id`) VALUES ('$date','$ototal','$user','$aid')";
    $result = mysqli_query($conn, $query);
    $o_id = mysqli_insert_id($conn);
    if ($result) {
        $c_query = "SELECT * FROM `cart` WHERE `user_id`='$user'";
        $c_result = mysqli_query($conn, $c_query);
        if (mysqli_num_rows($c_result) > 0) {
            while ($c_row = mysqli_fetch_array($c_result)) {
                $pro_id = $c_row['product_id'];
                $qty = $c_row['quantity'];

                $pquery = "SELECT * FROM `product` WHERE `id`='$pro_id'";
                $presult = mysqli_query($conn, $pquery);
                $prow = mysqli_fetch_array($presult);

                $pro_name = $prow['product'];
                $pro_price = $prow['price'];

                $i_query = "INSERT INTO `order_invoice`(`product_id`, `quantity`, `price`, `order_id`, `product_name`) VALUES ('$pro_id','$qty','$pro_price','$o_id','$pro_name')";
                $i_result = mysqli_query($conn, $i_query);
            }
            $b_query = "INSERT INTO `billing`(`prder`, `card_no`, `status`, `date`) VALUES ('$o_id', '$cardno','$status','$date')";
            $b_result = mysqli_query($conn, $b_query);

            if ($b_result) {
                $cd_query = "DELETE FROM `cart` WHERE `user_id`='$user'";
                $cd_result = mysqli_query($conn, $cd_query);
            }
        }
    }

    echo $result;
}
