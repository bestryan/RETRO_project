<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Create new topic</title>
    <style>
        main{
            margin: 20px;
            display: flex;
            justify-content: center;
        }
        select, input, textarea{
            margin-top:5px;
        }
        p{
            font-weight: bold;
            padding-top: 5px;
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
        }
        select{
            width: auto;
            font-size:17px;
            border: 1px dashed black;
            border-radius: 4px;
            cursor: pointer;
            padding: 10px 18px;
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
        .text-center{
            text-align: center;
            width: 100%;
            background-color: black;
            font-weight: bold;
            font-size:17px;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .text-center a{
            color: #FDD935;
            background-color: black;
            text-decoration: none;
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
        <h1>Create A Topic</h1>
    </div>
<main>
    <form action="do_addtopic.php" method="post">
    <p><label for="category">Choose a category:</label></p>    
<?php
include 'connection.php';
doDB();

$sql = "SELECT type_id, type_name, type_description FROM forum_types ORDER BY type_name";
$result = mysqli_query($mysqli, $sql);
echo "<select name='category'>
<option value=''>Choose Category</option>";

while ($forum = mysqli_fetch_array($result)) {
    echo "<option value=$forum[type_id]>$forum[type_name]</option>";
}
echo "</select>";
mysqli_close($mysqli);
?>
    <p><label for="name">Your Name:</label><br>
        <input type="text" id="name" name="topic_owner" required="required"></p>

    <p><label for="email">Your Email Address:</label><br>
        <input type="email" id="email" name="topic_email" required="required"></p>

    <p><label for="topic">Topic Title:</label><br>
        <input type="text" id="topic" name="topic_title" required="required"></p>

    <p><label for="text">Your NEW Topic Text:</label><br>
        <textarea rows=15" cols="65" name="post_text"></textarea></p>

        <button type="submit" name="submit" value="submit">Add Topic</button>
        
        <div class="text-center"><a href="forum.php">Cancel</a></div>

</form>
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