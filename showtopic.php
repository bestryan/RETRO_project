<?php
include 'connection.php';
doDB();

$Get_topic_id = $_GET['topic_id'];

if (!isset($Get_topic_id)) {
    header("Location: catlist.php");
    exit;
}
//create safe values for use
$safe_topic_id = mysqli_real_escape_string($mysqli, $Get_topic_id);

//verify the topic exists
$verify_topic_sql = "SELECT topic_title FROM forum_topics
                    WHERE topic_id = $safe_topic_id";

$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {
    //this topic does not exist
    $display_block =    "<p><em>You have selected an invalid topic.<br/>
                        Please <a href='topiclist.php'>try again</a>.</em></p>";
  
    } else {
        //get the topic title
        while ($topic_info = mysqli_fetch_array($verify_topic_res)) {
            $topic_title = stripslashes($topic_info['topic_title']);
        }

        //gather the posts
        $get_posts_sql =    "SELECT post_id, post_text, 
                            DATE_FORMAT(post_create_time, '%b %e %Y<br/>%r') 
                            AS fmt_post_create_time, post_owner, post_email
                            FROM forum_posts
                            WHERE topic_id = '$safe_topic_id'
                            ORDER BY post_create_time ASC ";
        
        $get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));

        // create the display string
        
        $display_block = 
                         "<table>
                        <tr>
                        <th>AUTHOR</th>
                        <th>POST</th>
                        </tr> ";

        while ($posts_info = mysqli_fetch_array($get_posts_res)) {
            $post_id = $posts_info['post_id'];
            $post_text = nl2br(stripslashes($posts_info['post_text']));
            $post_create_time = $posts_info['fmt_post_create_time'];
            $post_owner = stripslashes($posts_info['post_owner']);
            $post_email = $posts_info['post_email'];

            //add to display
            $display_block .=
            "<tr>
            <td><strong>$post_owner</strong><br/>$post_email<br/><br/>
            created on:<br/>$post_create_time</td>
            <td>$post_text<br/><br/>
            <a href='replytopost.php?post_id=$post_id'>
            <strong class='reply'>REPLY TO POST</strong></a></td>
            </tr> "; 
        }
        
        //free results
        mysqli_free_result($get_posts_res);
        mysqli_free_result($verify_topic_res);

        //close connection to MySQL
        mysqli_close($mysqli);

        //close up the table
        $display_block .= "</table>";

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
    <title><?php echo $topic_title?></title>
    <style>
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
        .post_title{
            margin-top: 30px;
            padding-left:30px;
            font-size:18px;
        }
        table {
            border-collapse: collapse;
            padding: 25px 30px 30px 30px;
            display: flex;
            justify-content: center;
        }
        td {
            font-weight: normal;
        }
        p{
            margin-top: 20px;
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
            margin-top: 30px;
        }
        .reply{
            border: 1px solid black;
            border-radius: 4px;
            text-decoration: none;
            padding: 2px;
        }
        a{
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
     <?php echo "<h1>$topic_title</h1>"?>    
    </div>
<main>



<?php echo "<p class='post_title'>Showing posts for the <strong style='text-decoration: underline;'>$topic_title</strong> topic:</p>";?>
<?php echo $display_block; ?>

<div class="text-center down"><a href="javascript:history.go(-1)">Return</a></div>

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