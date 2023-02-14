<!DOCTYPE html>
<html>
<head>



</head>    
<body>
<div id="wrapper">
<h1>Choose a Forum</h1>

<form method="post" action="catlist.php">
<p><label for="forum">Choose a category:</label><br>
<?php
include 'connection.php';
doDB();
// same select as addtopic page, but submit to catlist
$sql = "SELECT type_id, type_name, type_description FROM forum_types ORDER BY type_name";
$result = mysqli_query($mysqli, $sql);
echo "<select name='category'>
<option value=''>Forums</option>";
while ($forum = mysqli_fetch_array($result)) {
    echo "<option value=$forum[type_id]>$forum[type_name]</option>";
}
echo "</select>";
mysqli_close($mysqli);
?>
<button type="submit" name="submit" value="submit">Show Topic Posts</button>

</form>
<p>Would you like to see a <a href="topiclist.php">list of all topics</a>?</p>
<p>Would you like to <a href="do_addtopic.php">add to topic</a>?</p>
</div>
</body>