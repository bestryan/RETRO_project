<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Selected Category</title>
    <style>
        h2{
            font-size: 22px;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
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
        p{
            margin: 20px;
            margin-top: 20px;
            text-align: center;
        }
        a {
            color:black;
        }
        table{
            padding: 20px;
            margin-top: 5px;
        }
        td {
            font-size: 17px;
            font-weight: normal;
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
            padding: 10px 18px;
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

<main>

<?php
include 'connection.php';
doDB();

if (!isset($_POST['category'])) {
    header("Location: forum.php");
}
$safe_type_id = $_POST['category'];
?>

<?php
//choose a forum with the following join adapted from topiclist
$get_cat_sql = "SELECT ft.topic_id, ft.topic_owner, ft.topic_title, ft.type_id, DATE_FORMAT(topic_create_time,  '%b %e %Y at %r') AS fmt_topic_create_time FROM forum_topics AS ft LEFT JOIN forum_types AS fc ON fc.type_id = ft.type_id WHERE ft.type_id = '$safe_type_id' ";
$get_cat_res = mysqli_query($mysqli, $get_cat_sql) or die(mysqli_error($mysqli));
//get forum name
$get_forum_name = "SELECT * FROM forum_types WHERE type_id = '$safe_type_id' ";
$get_forum_res = mysqli_query($mysqli, $get_forum_name) or die(mysqli_error($mysqli));
if (mysqli_num_rows($get_cat_res) < 1) {

    $message = 'No Topics and Categories Exist, Please Choose Correct One';
    echo "<SCRIPT> //not showing me this
            alert('$message')
            window.location.replace('forum.php'); </SCRIPT>";
} else {
    //create the display string
    $display_block = <<<END_OF_TEXT
    <table>
    <tr>
    <th>Topic Title</th>
    <th>List of POSTS</th>
    </tr>
END_OF_TEXT;

    while ($topic_info = mysqli_fetch_array($get_cat_res)) {
        $topic_id = $topic_info['topic_id'];
        $topic_title = stripslashes($topic_info['topic_title']);
        $topic_create_time = $topic_info['fmt_topic_create_time'];
        $topic_owner = stripslashes($topic_info['topic_owner']);


        //get number of posts
        $get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE topic_id = '$topic_id'";
        $get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

        while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
            $num_posts = $posts_info['post_count'];
        }
        //add to display
        $display_block .= <<<END_OF_TEXT
                        <tr>
                        <td><a href='showtopic.php?topic_id=$topic_id'><strong>$topic_title</strong></a><br/>
                        Created on $topic_create_time by <strong>$topic_owner</strong></td>
                        <td class='num_posts_col' style='text-align: center;'>$num_posts</td>
                        </tr>
        END_OF_TEXT;
    }

    //free results
    mysqli_free_result($get_cat_res);
    mysqli_free_result($get_num_posts_res);

    //close connection to MySQL
    mysqli_close($mysqli);

    //close up the table
    $display_block .= "</table>";
}
while ($forum_info = mysqli_fetch_array($get_forum_res)) {
    $type_id = $forum_info['type_id'];
    $forum_name = $forum_info['type_name'];
    $forum_desc = $forum_info['type_description'];
?>  

<div class="banner_forums">
    <h1>Topics in this Category - <?php echo $forum_name;?></h1>
</div>

<h2><?php echo $forum_desc; }?></h2>
<div class="line_class">
    <div class="line_line"></div>
</div>

<?php echo $display_block; ?>

<div class="text-center"><a href="do_addtopic.php">Create New Topic</a></div>
<div class="text-center"><a href="forum.php">Category Lists</a></div>


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