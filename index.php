<?php
$page_title = "index";
include('./header.php');
include('functions/controller.php');
include('functions/page.php');
include('functions/pagination.php');

$ispage = new IsPage();
$page = $ispage->is_page();
$start_number = $ispage->is_startnumber();

$countpages = new CountPages();
$pagination = $countpages->getPagination();

$controller = new Controller();
$stmt = $controller->selectData($start_number);
$stmt->execute();

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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                    <input type="hidden" name="content" value="<?php echo $content; ?>">
                    <button type="submit" class="btn btn-outline-primary">Edit</button>
                </form>
                <form method="post" action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                    <input type="hidden" name="content" value="<?php echo $content; ?>">
                    <button type="submit" class="btn btn-secondary">Delete</button>
                </form>
            </div>
        </div>
    </div>
<?php endwhile; ?>
    <nav aria-label="...">
        <ul class="pagination">
        <?php
        $createpagination = new CreatePagination($page,$pagination);
        echo $createpagination->createPagination();
        ?>
        </ul>
    </nav>
</div>
</body>
</html>