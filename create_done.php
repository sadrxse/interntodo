<?php
$page_title = "create_done";
include("./header.php");
include("./function.php");

$title = $_POST['title'];
$content = $_POST['content'];

$controller = new Controller();
$controller->insertData($title,$content);

$dbh = null;
?>

<div class="container">
  <div class="alert alert-success" role="alert" style="margin-top:30px;">
    <h4 class="alert-heading">ToDo added</h4>
    <hr>
    <p class="mb-0"><a href="index.php">Top</a></p>
  </div>
</div>

</body>
</html>