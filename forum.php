<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Retro Forum</title>
    <style>
        main{
            margin: 20px;
            display: flex;
            justify-content: center;
            text-align:center;
        }
        .php_cat, p{
            margin: 20px;
        }
        h2{
            font-size: 30px;
        }
        button[type=submit]{
            width: 100%;
            background-color: black;
            color: #FDD935;
            font-weight: bold;
            font-size:17px;
            padding: 12px 18px;
            margin: 6px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        select{
            width: 100%;
            font-size:17px;
            padding: 12px 18px;
            border: 1px dashed black;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            color:black;
        }
        .banner_forums {
            background-image: url("images/forum.png");
            opacity: 0.9;
            background-repeat: no-repeat;
            background-size: cover;
            height: 400px;
            width: auto;
            border-bottom: 1px dashed black;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .line_class{
            display: flex;
            justify-content:center;
            margin-top: 18px;
        }       
        .line_line{
            background-color: black;
            text-align: center;
            width: 150px;
            height: 4px;
        }
        .text-center{
            text-align: center;
            width:180px;
            background-color: black;
            font-weight: bold;
            font-size:17px;
            padding: 9px;
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
        footer{
            margin-top: 40px;
        }
        .down{
            margin-top: 50px;
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
                <li class="indicator"><a href="forum.php">Forums</a></li>
                <li><a href="seestore.php">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="showcart.php"><i class="fa fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </nav>


    <div class="banner_forums">
        <h1>RetroRecord Forum</h1>
    </div>
<main>
    <div class="php_container">
        <form method="post" action="catlist.php" class="php_cat">
            <h2>Choose Forum Category</h2>
            <div class="line_class">
            <div class="line_line"></div>
            </div>
            <p><label for="forum"></label><br>
            <?php
            include 'connection.php';
            doDB();
            // same select as addtopic page, but submit to catlist
            $sql = "SELECT type_id, type_name, type_description FROM forum_types ORDER BY type_name";
            $result = mysqli_query($mysqli, $sql);
            echo "<select name='category'>
            <option value=''>Choose Category Here</option>";
            while ($forum = mysqli_fetch_array($result)) {
                echo "<option value=$forum[type_id]>$forum[type_name]</option>";
            }
                echo "</select>";
            mysqli_close($mysqli);
            ?>
            <p><button type="submit" name="submit" value="submit">Show Topic Posts</button></p>
            </form>
            <div class="text-center down"><a href="do_addtopic.php">Create New Topic</a></div>
            <div class="text-center"><a href="topiclist.php">Show All Topics</a></div>
        </div>
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