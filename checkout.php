<?php   
session_start();
$total = $_SESSION['total'];

//connect to database   
$mysqli = mysqli_connect("localhost", "root","root", "Retro_store");  
//check for cart items based on user session id
$get_cart_sql = "SELECT st.id, si.item_title, si.item_price, si.item_image, si.stock_level, st.sel_item_id,
                st.sel_item_qty, st.sel_item_color FROM
                   store_shoppertrack AS st LEFT JOIN store_items AS si ON
                   si.id = st.sel_item_id WHERE session_id =
                   '".$_COOKIE['PHPSESSID']."'";
$get_cart_res = mysqli_query($mysqli, $get_cart_sql) or die(mysqli_error($mysqli));

$display_block = "<p></p>";   

$get_st_sql = "SELECT * FROM store_shoppertrack";
$get_st_res = mysqli_query($mysqli, $get_st_sql) or die(mysqli_error($mysqli));

while ($st_info = mysqli_fetch_array($get_st_res)) {
    $st_id = $st_info['id'];
}

if (mysqli_num_rows($get_cart_res) < 1) {
      //print message
      $display_block .= "<p>You have no items in your cart.
      <a href=\"seestore.php\" class='text-center down'>Continue To Shop</a></p>";
} else {
      //get info and build cart display
      $display_block .= <<<END_OF_TEXT
      <table>
      <tr>
      <th>Title</th>
      <th>Image</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Edit</th>
      </tr>
 END_OF_TEXT;

    while ($cart_info = mysqli_fetch_array($get_cart_res)) {
        $id = $cart_info['sel_item_id'];
        $item_title = $cart_info['item_title'];
        $item_price = $cart_info['item_price'];
        $item_qty = $cart_info['sel_item_qty'];
        $item_image = $cart_info['item_image'];
        $new_qty = $cart_info['stock_level'] - $cart_info['sel_item_qty'];

        $item_color = $cart_info['sel_item_color'];
        $total_price = sprintf("%.02f", $item_price * $item_qty);

        if($cart_info['stock_level'] >= $cart_info['sel_item_qty']) {

            $update_quant = "UPDATE store_items SET stock_level = '".$new_qty."'where'".$id."' = store_items.id AND stock_level > '".$new_qty."'";

            $get_update_res = mysqli_query($mysqli, $update_quant) or die(mysqli_error($mysqli));
        }
        else {
            echo "<h2>Need to put ".$cart_info['item_title']." on back order</h2>";
        }

        $display_block .= <<<END_OF_TEXT
          <tr>
          <td>$item_title <br></td>
          <td><img src="/retro_project/images/$item_image" alt="$item_title" class='img_cart'/> <br></td>
          <td>$item_qty <br></td>
          <td>\$$total_price</td>
          <td><a href="removestock.php?id=$st_id"><i class="fa fa-times" aria-hidden="true"></i></a></td>
          </tr>
 END_OF_TEXT;
    }

    $display_block .=   "<tr>
                        <td colspan=3>Total</td>
                        <td><strong>\$$total</strong></td>
                        <td style='font-size: 13px;'>GST INCL</td>
                        </tr>
                        </table>";
}
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
            padding: 20px;
            display: flex;
            justify-content: center;
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
        select, input, textarea{
            margin-top:5px;
        }
        button[type=submit]{
            width: 100%;
            background-color: black;
            color: #FDD935;
            font-weight: bold;
            font-size:17px;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 30px;
        }
        select{
            width: auto;
            font-size:17px;
            border: 1px dashed black;
            border-radius: 4px;
            cursor: pointer;
            padding: 6px 10px;
        }
        form{
            flex:65%;
            padding: 10px;
            margin-top: 30px;
            margin-left:20px;
        }
        a{
            text-decoration: none;
            color:#FDD935;
        }
        /* .check_sum{

        } */
        label{
            font-weight: bold;
        }



        @media (max-width: 768px){
            img{
                width:150px;
            }

            main{
                padding: 10px;
                display: block;
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
     <?php echo "<h1>Checkout Page</h1>"?>    
    </div>
<main>

        <div class="check_sum"> <?php echo $display_block; ?></div>

        <?php
        if (mysqli_num_rows($get_cart_res) < 1) {
      
        }else {
            $formone = <<<END_OF_TEXT
            <form action="order.php" method="post">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" required><br>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" required><br>

            <label for="city">City</label>
            <input type="text" name="city" id="city" required><br>

            <label for="state">State your residency</label>
            <input type="text" name="state" id="state" required><br>

            <label for="name">Postcode</label>
            <input type="text" name="postcode" id="postcode" required><br>

            <label for="tel">Telephone</label>
            <input type="text" name="tel" id="tel" required><br>

            <label for="email">Email</label>
            <input type="text" name="email" id="name" required><br>

            <label for="cardName">Name on card</label>
            <input type="text" name="cardName" id="cardName" required><br>
            <label for="expiry">Expiry date of card:</label>      
END_OF_TEXT;    
    
echo $formone;
        
    $months = array(
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July ',
                    'August',       
                    'September',
                    'October',
                    'November',
                    'December',
            );  
            echo "<select name='month' id='sel'>";
            foreach ($months as $i){
                echo "<option value ='$'>$i</option>";
            }
            echo "</select>  ";

            echo "<select name='year' id='sel'>";
            for ($i = 2022; $i < 2032; $i++){
                echo "<option value ='$'>$i</option>";
            }
            echo "</select><br>";

            $formtwo = <<<END_OF_TEXT
            <input type="hidden" name="session" value="\$_COOKIE['PHPSESSID']">
            <button type="submit" name="submit">Purchase</button>

            </form>
END_OF_TEXT;

echo $formtwo;

}
?>
 
        <!-- <form action="order.php" method="post">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" required><br>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" required><br>

            <label for="city">City</label>
            <input type="text" name="city" id="city" required><br>

            <label for="state">State your residency</label>
            <input type="text" name="state" id="state" required><br>

            <label for="name">Postcode</label>
            <input type="text" name="postcode" id="postcode" required><br>

            <label for="tel">Telephone</label>
            <input type="text" name="tel" id="tel" required><br>

            <label for="email">Email</label>
            <input type="text" name="email" id="name" required><br>

            <label for="cardName">Name on card</label>
            <input type="text" name="cardName" id="cardName" required><br>
            <label for="expiry">Expiry date of card:</label>
        <?php 
            $months = array(
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July ',
                        'August',       
                        'September',
                        'October',
                        'November',
                        'December',
            );  
            echo "<select name='month' id='sel'>";
            foreach ($months as $i){
                echo "<option value ='$'>$i</option>";
            }
            echo "</select>  ";
            
            echo "<select name='year' id='sel'>";
            for ($i = 2022; $i < 2032; $i++){
                echo "<option value ='$'>$i</option>";
            }
            echo "</select><br>";
            ?>

            <input type="hidden" name="session" value="$_COOKIE['PHPSESSID']">
            <button type="submit" name="submit">Purchase</button>

        </form> -->
        
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
