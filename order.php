<?php   
session_start();
$total = $_SESSION['total'];

//connect to database   
$mysqli = mysqli_connect("localhost", "root","root", "Retro_store");  
$display_block ="<p></p>";

if(isset($_POST['submit'])) {
    //get all the form data and clean it
    $safe_sess = mysqli_real_escape_string($mysqli, $_POST['session']);
    $safe_name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $safe_address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $safe_city = mysqli_real_escape_string($mysqli, $_POST['city']);
    $safe_state = mysqli_real_escape_string($mysqli, $_POST['state']);
    $safe_post = mysqli_real_escape_string($mysqli, $_POST['postcode']);
    $safe_tel = mysqli_real_escape_string($mysqli, $_POST['tel']);
    $safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $safe_cName = mysqli_real_escape_string($mysqli, $_POST['cardName']);
}
    $add_to_order_sql = "INSERT INTO store_orders (order_date, order_name, order_address, order_city,
                        order_state, order_zip, order_tel, order_email, item_total)
                        VALUES(now(), '$safe_name','$safe_address','$safe_city', 
                        '$safe_state','$safe_post','$safe_tel','$safe_email','$total')";
    $add_to_cart_res = mysqli_query($mysqli, $add_to_order_sql) or die(mysqli_error($mysqli));


$safe_id = mysqli_insert_id($mysqli);


//check for cart items based on user session id
$get_cart_sql = "SELECT st.id, si.item_title, si.item_price,
                   st.sel_item_qty, st.sel_item_color FROM
                   store_shoppertrack AS st LEFT JOIN store_items AS si ON
                   si.id = st.sel_item_id WHERE session_id =
                   '".$_COOKIE['PHPSESSID']."'";
$get_cart_res = mysqli_query($mysqli, $get_cart_sql) or die(mysqli_error($mysqli));

while ($cart_info = mysqli_fetch_array($get_cart_res)) {
    $id = $cart_info['id'];
    $item_title = stripslashes($cart_info['item_title']);
    $item_price = $cart_info['item_price'];
    $item_qty = $cart_info['sel_item_qty'];
    $item_color = $cart_info['sel_item_color'];
    $total_price = sprintf("%.02f", $item_price * $item_qty);
    // $total = sprintf("%.02f", $total + $total_price);


    //trying toi insert into store_order_ietems
    $add_to_order_items_sql="INSERT INTO store_orders_items (order_id, sel_item_id,
                            sel_item_qty, sel_item_color, sel_item_price)
                            VALUES ('$safe_id','$id','$item_qty','$item_color','$item_price')";

    $addtocart_res = mysqli_query($mysqli, $add_to_order_items_sql) or die(mysqli_error($mysqli));
}

$delete_order_items_sql = "DELETE FROM store_shoppertrack WHERE session_id = '".$_COOKIE['PHPSESSID']."'";
$del_res = mysqli_query($mysqli,$delete_order_items_sql) or die(mysqli_error($mysqli));



//get order number

$get_order_number = "SELECT id FROM store_orders WHERE order_name = '$safe_name' AND order_tel = '$safe_tel'";

$get_order_number_res = mysqli_query($mysqli, $get_order_number) or die(mysqli_error($mysqli));

while ($order_num = mysqli_fetch_array($get_order_number_res)){
    $order_ID = $order_num['id'];
}

$display_block .= " <p>Your Order Reference Number: <strong>5200".$order_ID."</strong></p>
                    <p>Please copy the number for your own records</p>
                    
                    <p>Name on your card: <strong>".$safe_cName."</strong></p><br>

                    <p>Want more products? Why not  <a href=\"seestore.php\" class='text-center down'>Continue To Shop</a></p>";


if (mysqli_num_rows($get_cart_res) < 1) {
    //print message
    $display_block .= "<p>Want more products? Why not  <a href=\"seestore.php\" class='text-center down'>Continue To Shop</a></p>";
}
//close connection to MYSQL
mysqli_close($mysqli);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Order Confirmation</title>
    <style>
        .banner_forums {
            background-image: url("images/vinyl_banner.png");
            opacity: 0.9;
            background-repeat: no-repeat;
            background-size: cover;
            height: 150px;
            width: auto;
            border-bottom: 1px dashed black;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        table {
            border-collapse: collapse;
            padding: 15px;
            display: block;
        }
        td {
            font-weight: normal;
            width: 50px;
            padding: 10px;
            text-align: center;
        }
        .img_cart{
            max-width: 300px;
            box-shadow: 6px 6px black;
        }
        p{
            padding-top: 15px;
            line-height: 1.3;
        }
        footer{
            margin-top: 30px;
        }
        a{
            color:black;
        }
        .cat_title{
            color: black;
            font-weight: bold;
            font-size: 24px;
        }
        main{
            padding: 20px 40px 20px 40px;
        }
        h1{
            font-size: 34px;
        }
        .cart_view{
            display:flex;
        }
        .sub_cart{
            padding: 10px 15px 10px 0;
        }
        .sub_cart_1{
            padding: 10px 0;
            padding-left: 20px;
        }
        button[type=submit]{
            background-color: black;
            color: #FDD935;
            font-weight: bold;
            font-size: 15px;
            padding: 6px 8px;
            margin: 6px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }
        select{
            border: 1px solid black;
            border-radius: 4px;
            cursor: pointer;
            padding: 2px 4px;
        }
        .text-center{
            text-align: center;
            width:180px;
            background-color: black;
            font-weight: bold;
            font-size: 17px;
            padding: 7px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .text-center a{
            color: #FDD935;
            background-color: black;
            text-decoration: none;
        }
        a{
            text-decoration: none;
            color:#FDD935;
        }


        @media (max-width: 768px){
            main{
                padding: 10px;
            }

            h1{
                font-size: 30px;
            }
            .cat_title {
                font-size: 20px;
             }

        }

        @media (max-width: 576px) {
            img{
                width: 260px;
            }
            main{
                padding: 8px;
            }
            .cart_view{
                display: block;
            }
            .sub_cart_1{
                padding: 5px;
                margin-top: 5px;
            }
            .sub_cart{
                padding: 5px;
            }
        }

    </style>
</head>

<body>
    <nav class="navbar">
        <div>
            <a href="index.html" class="logo">
                <img src="images/RetroRecords_logo.png" alt="logo">
            </a>
        </div>
        <a href="#" class="toggle-button">
            <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="retroRecords.html">Retro Records</a></li>
                <li><a href="forum.php">Forums</a></li>
                <li class="indicator"><a href="seestore.php">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="showcart.php"><i class="fa fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="banner_forums">
     <?php echo "<h1>Order Confirmation</h1>"?>    
    </div>
<main>


 <?php echo $display_block; ?>


 </main>
 <footer>
        <div class="footer_info">
            <ul>
                <li>All Rights Reserved</li>
                <li>&copy; Retro Records Newtown Pty Limited 2022</li>
                <li><a href="faq.html" style="text-decoration: none; font-weight: bold; color: black;">FAQ</a></li>
                <li>Privacy Policy</li>
            </ul>
        </div>
        <div class="footer_info_mobile">
            <ul>
                <li><a href="faq.html" style="text-decoration: none; font-weight: bold; color: black;">FAQ</a></li>
                <li>Privacy Policy </li>
                <li>&copy; Retro Records Newtown</li>
            </ul>
        </div>
        <div class="footer_social">
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div>
    </footer>
</body>
</html>