<?php
$page_title = "delete_done";
include("./header.php");
include("./function.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$controller = new Controller();
$stmt = $controller->checkData($id);
$post_num = $stmt->fetchColumn();

//存在するとき
if($post_num==1){

$controller->deleteData($id);
$dbh = null;
?>

<div class="container">
    <div class="alert alert-success" role="alert" style="margin-top:30px;">
        <h4 class="alert-heading">ToDo deleted</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>
<!-- 存在しないとき -->
<?php } else { ?>
    <div class="container">
    <div class="alert alert-success" role="alert" style="margin-top:30px;">
        <h4 class="alert-heading">No such ToDo found</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>
<?php } ?>

</body>
</html>