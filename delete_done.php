<?php
$page_title = "delete_done";
include("./header.php");
include("functions/controller.php");
include("functions/validation.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$controller = new Controller();
$stmt = $controller->checkData($id,$title,$content);
$stmt->execute();

$validator = new Validator();
$data = $validator->dataExists($stmt);

//存在するとき
if($data){
    $stmt = $controller->deleteData($id);
    $stmt->execute();
    $dbh = null;
?>

<div class="container">
    <div class="alert alert-success　mt-4" role="alert">
        <h4 class="alert-heading">ToDo deleted</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>
<?php 
//存在しないとき
} else {
    $message = $validator->getMessage();
?>
<div class="container">
    <div class="alert alert-success mt-4" role="alert">
        <h4 class="alert-heading"><?php echo $message; ?></h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>
<?php } ?>
</body>
</html>