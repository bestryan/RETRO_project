<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Full list of topics</title>
    <style>
        .php_flex{
            text-align:center;
        }
        p{
            margin: 20px;
            margin-top: 20px;
        }
        a {
            color:black;
        }
        table{
            padding: 20px;
            margin-top: 20px;
        }
        td {
            font-size: 17px;
            font-weight: normal;
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


    <div class="banner_forums">
        <h1>All Topics in Discussion Forums</h1>
    </div>
<main>

<?php
include 'connection.php';
doDB();

$get_topics_sql = "SELECT topic_id, topic_title,
                   DATE_FORMAT(topic_create_time,  '%b %e %Y at %r') AS
                   fmt_topic_create_time, topic_owner, topic_email FROM forum_topics
                   ORDER BY topic_create_time DESC ";

$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1){
    //there are no topics, so say so
    $display_block = "<p><em>No topics exist.</em></p>";
} else {
    //create the display string
    $display_block =  "<table>
                        <tr>
                        <th>TOPIC TITLE</th>
                        <th># of POSTS</th>
                        </tr>";


    while ($topic_info = mysqli_fetch_array($get_topics_res)){
        $topic_id = $topic_info['topic_id'];
        $topic_title = stripslashes($topic_info['topic_title']);
        $topic_create_time = $topic_info['fmt_topic_create_time'];
        $topic_owner = stripslashes($topic_info['topic_owner']);
        $topic_email = $topic_info['topic_email'];

        //get number of posts
        $get_num_posts_sql =    "SELECT COUNT(post_id) AS post_count FROM
                                forum_posts WHERE topic_id = '$topic_id'";
        
        $get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

        while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
            $num_posts = $posts_info['post_count'];
        }

        //add to display
        $display_block .=   "<tr>
                            <td><a href='showtopic.php?topic_id=$topic_id'>
                            <strong>$topic_title</strong></a><br/>
                            Created on $topic_create_time by <strong>$topic_owner</strong> $topic_email</td>
                            <td class='num_posts_col' style='text-align: center;'>$num_posts</td>
                            </tr>";
        }

        //free results
        mysqli_free_result($get_topics_res);
        mysqli_free_result($get_num_posts_res);

        //close connection to MySQL
        mysqli_close($mysqli);

        //close up the table
        $display_block .= "</table>";
}
?>

<?php echo $display_block; ?>
<div class="php_flex">

<div class="text-center"><a href="forum.php">Category Lists</a></div>
<div class="text-center"><a href="do_addtopic.php">Create New Topic</a></div>
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