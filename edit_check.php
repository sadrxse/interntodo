<?php
$page_title = "edit_check";
include("./header.php");
include("functions/validation.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$title = htmlspecialchars($title,ENT_QUOTES,'UTF-8');
$content = htmlspecialchars($content,ENT_QUOTES,'UTF-8');

?>

<div class="container">
    <?php
    $validator = new Validator();
    if($validator->isInputValid($title,$content)){
    ?>
        <h2 class="mt-4">Edit this ToDo?</h2>
        <div class="card w-75 my-5">
            <h5 class="card-header">Title: <?php echo $title; ?></h5>
            <div class="card-body">
                <p>Content: <?php echo $content; ?></p>
            </div>
        </div>
        <form method="post" action="edit_done.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="title" value="<?php echo $title; ?>">
            <input type="hidden" name="content" value="<?php echo $content; ?>">
            <br />
            <input type="button" class="btn btn-secondary" onclick="history.back()" value="back">
            <input type="submit" class="btn btn-outline-primary" value="OK" >
        </form>
    
    <?php
    } else { 
        $message = $validator->getMessage();
    ?>
    <div class="alert alert-success mt-5" role="alert">
        <h4 class="alert-heading"><?php echo $message; ?></h4>
        <hr>
        <button class="btn btn-secondary" onclick="history.back()">back</button>
    </div>
        
    <?php } ?>
</div>

</body>
</html>