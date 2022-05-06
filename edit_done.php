<?php
$page_title = "edit_done";
include("./header.php");
include("functions/controller.php");
include("functions/validation.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$controller = new Controller();
$stmt = $controller->updateData($id,$title,$content);
$stmt->execute();

$dbh = null;
?>
<div class="container">
    <div class="alert alert-success mt-4" role="alert">
        <h4 class="alert-heading">ToDo edited</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>

</body>
</html>