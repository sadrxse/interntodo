<?php
$page_titile = "delete";
include("./header.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$title = htmlspecialchars($title,ENT_QUOTES,'UTF-8');
$content = htmlspecialchars($content,ENT_QUOTES,'UTF-8');
?>
<div class="container">
    <h2 style="margin-top:30px;">Delete this ToDo?</h2>

    <div class="card" style="width: 50rem; margin: 30px 0 30px 0;">
        <h5 class="card-header">Title: <?php echo $title; ?></h5>
        <div class="card-body">
            <p>Content: <?php echo $content; ?></p>
        </div>
    </div>

    <form method="post" action="delete_done.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="title" value="<?php echo $title; ?>">
        <input type="hidden" name="content" value="<?php echo $content; ?>">
        <br />
        <input type="button" class="btn btn-secondary" onclick="history.back()" value="back">
        <input type="submit" class="btn btn-outline-primary" value="OK" >
    </form>
</div>
</body>
</html>