<?php
$page_title = "search";
include("./header.php");
include('functions/controller.php');
include('functions/page.php');
include('functions/pagination.php');
include('functions/validation.php');

$ispage = new IsPage();
$page = $ispage->is_page();
$start_number = $ispage->is_startnumber();

$keyword = $_GET["keyword"];
$keyword = htmlspecialchars($keyword,ENT_QUOTES,'UTF-8');

$validator = new Validator();
//キーワード未入力のとき
if(!($validator->issetKeyword($keyword))){
    $message = $validator->getMessage(); ?>
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top:30px;">
            <h4 class="alert-heading"><?php echo $message; ?></h4>
            <hr>
            <button class="btn btn-secondary" onclick="history.back()">back</button>
        </div>
    </div>
<?php
//キーワードありのとき
} else {
$countpages = new CountPages();
$pagination = $countpages->getPagination($keyword);

$controller = new Controller();
$stmt = $controller->searchData($keyword,$start_number);
$stmt->execute();
$dbh = null;

//ToDo存在しないとき
if($validator->dataExists($stmt)==false){
    $message = $validator->getMessage(); ?>
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top:30px;">
            <h4 class="alert-heading"><?php echo $message; ?></h4>
            <hr>
            <button class="btn btn-secondary" onclick="history.back()">back</button>
        </div>
    </div>

<?php
//ToDo存在するとき
} else { ?>
    <div class="container">
        <h1 style="margin-top:30px;">Search results for "<?php echo $keyword; ?>"</h1>
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
    <div class="card " style="width: 50rem; margin: 30px 0 30px 0;">
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
        echo $createpagination->createPagination($keyword);
        ?>
        </ul>
    </nav>
</div>
<?php 
} //キーワードあるとき
} //ToDo存在するとき
 ?>
</body>
</html>