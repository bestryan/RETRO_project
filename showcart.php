<?php   
session_start();
$total = 0;
 
//connect to database   
$mysqli = mysqli_connect("localhost", "root","root", "Retro_store");  
 
$display_block = "<p></p>";   
 
//check for cart items based on user session id
$get_cart_sql = "SELECT st.id, si.item_title, si.item_price, si.item_image,
                   st.sel_item_qty, st.sel_item_color FROM
                   store_shoppertrack AS st LEFT JOIN store_items AS si ON
                   si.id = st.sel_item_id WHERE session_id =
                   '".$_COOKIE['PHPSESSID']."'";
$get_cart_res = mysqli_query($mysqli, $get_cart_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_cart_res) < 1) {
      //print message
    $display_block .= "<p>You have no items in your cart.
    Please <a href=\"seestore.php\" class='text-center down'>Continue To Shop</a></p>";
} else {
      //get info and build cart display
      $display_block .= <<<END_OF_TEXT
      <table>
      <tr>
      <th>Title</th>
      <th>Image</th>
      <th>Color</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Edit</th>
      </tr>
 END_OF_TEXT;

      while ($cart_info = mysqli_fetch_array($get_cart_res)) {
          $id = $cart_info['id'];
          $item_image = $cart_info['item_image'];
          $item_title = stripslashes($cart_info['item_title']);
          $item_price = $cart_info['item_price'];
          $item_qty = $cart_info['sel_item_qty'];
          $item_color = $cart_info['sel_item_color'];
          $total_price = sprintf("%.02f", $item_price * $item_qty);
          $total = sprintf("%.02f", $total + $total_price);
          
          $display_block .= <<<END_OF_TEXT
          <tr>
          <td>$item_title <br></td>
          <td><img src="/Retro_project/images/$item_image" alt="$item_title" class='img_cart'/> <br></td>
          <td>$item_color <br></td>
          <td>\$$item_price <br></td>
          <td>$item_qty <br></td>
          <td>\$$total_price</td>
          <td><a href="removefromcart.php?id=$id"><i class="fa fa-times" aria-hidden="true"></i></a></td>
          </tr>
 END_OF_TEXT;
 }
    $display_block .=   "
                        <tr>
                        <td colspan=5></td>
                        <td><strong>\$$total</strong></td>
                        <td style='font-size: 13px;'>GST INCL</td>
                        </tr>
                        </table>
                        <div class='text-center down'><a href=\"seestore.php\">Continue To Shop</a></div>


                        <div class='text-center down'><a href=\"checkout.php\">Checkout Now</a></div>";
 }

 $_SESSION['total'] = $total;

 //free result
 mysqli_free_result($get_cart_res);

 //close connection to MySQL
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
    <title>Shop</title>
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
            display: Flex;
            margin-bottom: 30px;
        }
        td {
            font-weight: normal;
            padding: 10px;
            text-align: center;
        }
        img{
            width: 220px;
        }
        p{
            margin-top: 30px;
        }
        footer{
            margin-top: 30px;
        }
        main{
            padding: 20px 40px 20px 40px;
        }
        h1{
            font-size: 34px;
        }
        .img_cart{
              width: 60px;
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
            img{
                width:150px;
            }

            main{
                padding: 10px;
            }

            table{
                padding: 0px;
            }

            h1{
                font-size: 30px;
            }
            .cat_title {
                font-size: 20px;
             }
             td, td a{
                font-size: 15px;
            }
        }

        @media (max-width: 576px) {
            img{
                width:115px;
            }
            main{
                padding: 8px;
            }
            td, td a{
                font-size: 13px;
            }
            td{
                padding: 5px;
            }
            table{
                display:flex;
                justify-content:center;
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
                <li><a href="seestore.php">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li class="indicator"><a href="showcart.php"><i class="fa fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </nav>


    <div class="banner_forums">
     <?php echo "<h1>Your Shopping Cart</h1>"?>    
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
 