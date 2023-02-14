<?php  
session_start();

//connect to database  
$mysqli = mysqli_connect("localhost", "root","root", "Retro_store"); 

$display_block = "<p></p>"; 

//create safe values for use  
$safe_item_id = mysqli_real_escape_string($mysqli, $_GET['item_id']);

//validate item

$get_item_sql = "SELECT c.id as cat_id, c.cat_title, si.item_title,
                si.item_price, si.item_desc, si.item_image, si.stock_level FROM store_items
                AS si LEFT JOIN store_categories AS c on c.id = si.cat_id
                WHERE si.id = '".$safe_item_id."'";

$get_item_res = mysqli_query($mysqli, $get_item_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_item_res) < 1) {
     //invalid item
     $display_block .= "<p><em>Invalid item selection.</em></p>";
} else {
     //valid item, get info
     while ($item_info = mysqli_fetch_array($get_item_res)) {
         $cat_id = $item_info['cat_id'];
         $cat_title = strtoupper(stripslashes($item_info['cat_title']));
         $item_title = stripslashes($item_info['item_title']);
         $item_price = $item_info['item_price'];
         $item_desc = stripslashes($item_info['item_desc']);
         $item_image = $item_info['item_image'];
         $stock_level = $item_info['stock_level'];
    }
    
    //make breadcrumb trail & display of item
    $display_block .= <<<END_OF_TEXT
    
    
    
    <div><strong><a href="seestore.php?cat_id=$cat_id">$cat_title</a> &gt; $item_title</strong></div><br>
    <div class='cart_view'>

    <div class='sub_cart'><img src="/retro_project/images/$item_image" alt="$item_title" class='img_cart'/></div>
    

    <div class='sub_cart_1'><h3>Description:</h3><p>$item_desc</p>
    

    <p><strong>Price:</strong> \$$item_price</p>
    

    <form method="post" action="addtocart.php">

END_OF_TEXT;

    //free result
    mysqli_free_result($get_item_res);

    //get colors
    $get_colors_sql =   "SELECT item_color FROM store_item_color WHERE
                        item_id = '".$safe_item_id."' ORDER BY item_color";
    
    $get_colors_res = mysqli_query($mysqli, $get_colors_sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($get_colors_res) > 0) {
            $display_block .=   "<p><label for=\"sel_item_color\">
                                <strong>Available Colors:</strong></label>
                                <select id=\"sel_item_color\" name=\"sel_item_color\">";

            while ($colors = mysqli_fetch_array($get_colors_res)) {
                $item_color = $colors['item_color'];
                $display_block .=   "<option value=\"".$item_color."\">".
                                    $item_color."</option>";
            }
            $display_block .= "</select></p>";
    }

    //free result
    mysqli_free_result($get_colors_res);
    
    // below code for quant
    $get_quant = "SELECT stock_level from store_items where id = ".$safe_item_id;

    $get_quant_res = mysqli_query($mysqli, $get_quant) or die(mysqli_error($mysqli));
    
    while($item_info = mysqli_fetch_array($get_quant_res)) {
        if($item_info['stock_level'] == 0){
            echo "<p>We are out of stock. It will be put on back order.</p>";
        } 
        else {
            $new_quant = $item_info['stock_level'];

            $display_block .=   "<p><label for=\"sel_item_qty\"><strong>Select Quantity:</strong></label>
                                <select id=\"sel_item_qty\" name=\"sel_item_qty\">";
    
           for($i=1; $i<=$new_quant; $i++) {
                $display_block .= "<option value=\"".$i."\">".$i."</option>";
           }
        }
    }    
       $display_block .= <<<END_OF_TEXT
                </select></p>
                <input type="hidden" name="sel_item_id"
                value="$_GET[item_id]" />
                <button type="submit" name="submit" value="submit">
                Add to Cart</button>
                </form>
                </div>
                </div>
END_OF_TEXT;

}
 
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
     <?php echo "<h1>Retro Online Store - $cat_title </h1>"?>    
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
