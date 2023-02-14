<?php  

//connect to database using PHP OOP
$mysqli = new mysqli("localhost", "root","root", "Retro_store");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }

$display_block = "<p></p>";

//show categories first  
$get_cats_sql = "SELECT id, cat_title, cat_desc FROM store_categories ORDER BY cat_title DESC";

$get_cats_res =  mysqli_query($mysqli, $get_cats_sql) or die(mysqli_error($mysqli));

// PHP OOP display message
class alart {
    public $txt = "Sorry, no categories to shop";
}

$message = new alart();

if (mysqli_num_rows($get_cats_res) < 1) {
      $display_block = "<strong>$message->txt</strong>";

 } else {
   while ($cats = mysqli_fetch_array($get_cats_res)) {
    $cat_id  = $cats['id'];
    $cat_title = strtoupper(stripslashes($cats['cat_title']));
    $cat_desc = stripslashes($cats['cat_desc']);

    $display_block .=   "<p><a href=\"".$_SERVER['PHP_SELF'].
                        "?cat_id=".$cat_id."\" class='cat_title'>".$cat_title."</a><br>".$cat_desc."</p>";
    
    if (isset($_GET['cat_id']) && ($_GET['cat_id'] == $cat_id)) {
        
        //create safe value for use
        $safe_cat_id = mysqli_real_escape_string($mysqli, $_GET['cat_id']);
    
        //get items
        $get_items_sql =   "SELECT id, item_image, item_title, item_price FROM store_items WHERE
                            cat_id = '".$cat_id."' ORDER BY item_title";
    
        $get_items_res = mysqli_query($mysqli, $get_items_sql) or die(mysqli_error($mysqli));
    
        if (mysqli_num_rows($get_items_res) < 1) {
         $display_block = "<p><em>Sorry, no items in this
         category.</em></p>";

        } else {

                $item = array();
            
                while($items = mysqli_fetch_array($get_items_res))
                $item[] = $items;
                $display_block .= "<table>";
                $display_block .="<tr>";
                
                foreach($item as $items){
                    $item_id  = $items['id'];
                    $item_title = stripslashes($items['item_title']);
                    $item_image = $items['item_image'];
                    $display_block .= "<td class='sos'><a href=\"showitem.php?item_id=".$item_id."\"><img src=\"/retro_project/images/".$item_image."\" alt=\"".$item_title."\" style=\"max-width:250px;\"/></a></td>";
                }
                $display_block .= "</tr><tr>";
                
                foreach($item as $items){
                    $item_id  = $items['id'];
                    $item_title = stripslashes($items['item_title']);
                    $item_price = $items['item_price'];
                    $display_block .= "<td><a href=\"showitem.php?item_id=".$item_id."\">".$item_title."</a></td>";
                }
                $display_block .= "</tr><tr>";
                
                foreach($item as $items){
                    $item_price = $items['item_price'];
                    $display_block .= "<td>\$".$item_price."</td>";
                }
                $display_block .= "</tr>";
                $display_block .= "</table>";

        }
        //free results
        mysqli_free_result($get_items_res);
        }
    }
}
//free results
mysqli_free_result($get_cats_res);
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
        img{
            width: 220px;
        }
        p{
            margin-top: 30px;
            line-height: 1.3;
        }
        footer{
            margin-top: 30px;
        }
        a{
            text-decoration: none;
        }
        .cat_title{
            color: black;
            font-weight: bold;
            font-size: 23px;
        }
        main{
            padding: 20px 40px 20px 40px;
        }
        h1{
            font-size: 34px;
        }


        @media (max-width: 768px){
            img{
                width:150px;
            }

            main{
                padding: 10px;
            }

            table{
                padding: 15px 0px;
            }

            h1{
                font-size: 30px;
            }
            .cat_title {
                font-size: 20px;
             }
             td, td a{
                font-size: 16px;
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
                font-size: 15px;
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
                <li class="indicator"><a href="seestore.php">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="showcart.php"><i class="fa fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="banner_forums">
     <?php echo "<h1>Retro Online Store - Find Your Favourite Items</h1>"?>    
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
