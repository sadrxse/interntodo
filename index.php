<?php
$page_title = "index";
include('./header.php');
include('./function.php');

$inst = new setValue();
$page = $inst->is_page();
$start_number = $inst->is_startnum();
$pagination = $inst->index_pagination();

$controller = new Controller();
$stmt = $controller->selectData($start_number);

$dbh = null;
?>

<div class="container">
    <h1 style="margin-top:30px;">ToDo List</h1>
<?php
while(true):
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($rec==false){
        break;
    }
    $id = $rec["id"];
    $title = $rec["title"];
    $content = $rec["content"];
    $updated_at = $rec["updated_at"];

    $title = htmlspecialchars($title,ENT_QUOTES,'UTF-8');
    $content = htmlspecialchars($content,ENT_QUOTES,'UTF-8');
?>
    <div class="card" style="margin: 30px 0 30px 0;">
        <div class="card-header">ToDo</div>
        <div class="card-body">
            <h5 class=card-title><?php echo $title; ?></h5>
            <p class="card-text"><?php echo $content; ?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <p style="padding-top:10px; margin-right:10px;"><?php echo $updated_at; ?></p>
                <form method="post" action="edit.php">
                    <input type="hidden" name="id" value="<?php print $id; ?>">
                    <input type="hidden" name="title" value="<?php print $title; ?>">
                    <input type="hidden" name="content" value="<?php print $content; ?>">
                    <button type="submit" class="btn btn-outline-primary">Edit</button>
                </form>
                <form method="post" action="delete.php">
                    <input type="hidden" name="id" value="<?php print $id; ?>">
                    <input type="hidden" name="title" value="<?php print $title; ?>">
                    <input type="hidden" name="content" value="<?php print $content; ?>">
                    <button type="submit" class="btn btn-secondary">Delete</button>
                </form>
            </div>
        </div>
    </div>
<?php endwhile;
include('./pagination.php')
?>
</div>
</body>
</html>