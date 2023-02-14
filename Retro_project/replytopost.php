<?php
include 'connection.php';
doDB();

$Get_post_id = $_GET['post_id'];

//check to see if we’re showing the form or adding the post

if (!$_POST) {
    // showing the form; check for required item in query string
    if (!isset($Get_post_id)){
        header("Location: showtopic.php");
        exit;
    }

    //create safe values for use
    $safe_post_id = mysqli_real_escape_string($mysqli, $Get_post_id);

    //still have to verify topic and post
    //added type_id to select
    $verify_sql =   "SELECT ft.topic_id, ft.topic_title, ft.type_id FROM forum_posts
                    AS fp LEFT JOIN forum_topics AS ft ON fp.topic_id = 
                    ft.topic_id WHERE fp.post_id = $safe_post_id ";
    
    $verify_res = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));
    
    if (mysqli_num_rows($verify_res) < 1) {
        // this post or topic does not exist
        header("Location: topiclist.php");
        exit;

    } else {
        // get the topic id and title
        while($topic_info = mysqli_fetch_array($verify_res)) {
            $topic_id = $topic_info['topic_id'];
            $type_id = $topic_info['type_id'];
            $topic_title = stripslashes($topic_info['topic_title']);
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
    <title>Post Your Reply in <?php echo $topic_title; ?></title>
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
    <h1>Post Your Reply in <?php echo $topic_title; ?></h1>
    </div>
<main>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <p><label for="post_owner">Your Name:</label><br/>
            <input type="text" id="post_owner" name="post_owner" size="40" maxlength="150" required="required"></p>

        <p><label for="post_email">Your Email Address:</label><br/>
            <input type="email" id="post_email" name="post_email" size="40" maxlength="150" required="required"></p>

        <p><label for="post_text">Post Your Reply Text:</label><br/>
            <textarea id="post_text" name="post_text" rows="15" cols="65" required="required"></textarea></p>

        <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
        <!-- added hidden input -->
        <input type="hidden" name="type_id" value="<?php echo $type_id; ?>">
        
        <button type="submit" name="submit" value="submit">Reply To Post</button>
        
        <div class="text-center down"><a href="javascript:history.go(-1)">Cancel</a></div>
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

<?php
        //free result
         mysqli_free_result($verify_res);

        //close connection to MySQL
        mysqli_close($mysqli);
    }

    } else if ($_POST) {

        //check for required items from form
        if ((!$_POST['topic_id']) || (!$_POST['post_text']) || 
        (!$_POST['post_owner']) ||(!$_POST['post_email'])) {
            header("Location: catlist.php");
            exit;
        }

        //create safe values for use
        $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['topic_id']);
        $safe_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
        $safe_post_owner = mysqli_real_escape_string($mysqli, $_POST['post_owner']);
        $safe_post_email = mysqli_real_escape_string($mysqli, $_POST['post_email']);

        //store category to a variable
        $safe_type_id = mysqli_real_escape_string($mysqli, $_POST['type_id']);

        //add the post //insert into table
        $add_post_sql = "INSERT INTO forum_posts (topic_id, post_text, post_create_time, post_owner, post_email, type_id) 
                        VALUES ('$safe_topic_id', '$safe_post_text', now(),'$safe_post_owner', '$safe_post_email', '$safe_type_id')";

        $add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

        //close connection to MySQL
        mysqli_close($mysqli);

        //redirect user to topic
        header("Location: showtopic.php?topic_id=".$_POST['topic_id']);
        exit;
    }
    ?>