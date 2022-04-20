<?php
$page_title = "edit_done";
include("./header.php");
include("functions/controller.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$controller = new Controller();
$stmt = $controller->updateData($title,$content,$id);
$stmt->execute();

$dbh = null;
?>
<div class="container">
    <div class="alert alert-success" role="alert" style="margin-top:30px;">
        <h4 class="alert-heading">ToDo edited</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>

</body>
</html>