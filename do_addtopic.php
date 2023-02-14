<?php

include 'connection.php';
doDB();


$owner = $_POST['topic_owner'];
$email = $_POST['topic_email'];
$title = $_POST['topic_title'];
$text = $_POST['post_text'];
$category = $_POST['category'];

if (!$title || !$owner || !$text || !$email){
    header("Location: addtopic.php" );
    exit;
}

//create safe values for input into the database
$clean_category = mysqli_real_escape_string($mysqli, $category);
$clean_topic_owner = mysqli_real_escape_string($mysqli, $owner);
$clean_topic_email = mysqli_real_escape_string($mysqli, $email);
$clean_topic_title = mysqli_real_escape_string($mysqli, $title);
$clean_post_text = mysqli_real_escape_string($mysqli, $text);

// //create and issue the first query
$add_topic_sql = "INSERT INTO forum_topics
                      (topic_title, topic_create_time, topic_owner, topic_email, type_id)
                      VALUES ('$clean_topic_title', now(), '$clean_topic_owner', '$clean_topic_email', '$clean_category')";

$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));


//get the id of the last query
$topic_id = mysqli_insert_id($mysqli);

//create and issue the second query
$add_post_sql = "INSERT INTO forum_posts
                 (topic_id, post_text, post_create_time, post_owner, post_email, type_id)
                 VALUES ('$topic_id', '$clean_post_text', now(), '$clean_topic_owner', '$clean_topic_email', '$clean_category')";

$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

//close connection to MYSQL
mysqli_close($mysqli);

$display_block = "The $title topic has been created!";

?>

<!DOCTYPE html>
<html>
<head>
<title>New Topic Added</title>
</head>
<body>
<?php 
echo "<SCRIPT> //showing message
        alert('$display_block')
        window.location.replace('topiclist.php'); </SCRIPT>";
?>
</body>
</html>