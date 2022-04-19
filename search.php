<?php
$page_title = "search";
include("./header.php");
include('./function.php');

$inst = new setValue();
$page = $inst->is_page();
$start_number = $inst->is_startnum();

$keyword = $_GET["keyword"];
$keyword = htmlspecialchars($keyword,ENT_QUOTES,'UTF-8');

//キーワード未入力のとき
if(mb_strlen($keyword)==0){ ?>
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top:30px;">
            <h4 class="alert-heading">The keyword is null</h4>
            <hr>
            <button class="btn btn-secondary" onclick="history.back()">back</button>
        </div>
    </div>
<?php
//キーワードありのとき
} else {

$pagination = $inst->search_pagination($keyword);
$controller = new Controller();
$stmt = $controller->searchData($keyword,$start_number);
$page_num = $stmt->fetchColumn();

$dbh = null;

//検索結果が存在しないとき
if($page_num==false){
?>
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top:30px;">
            <h4 class="alert-heading">No such ToDo found</h4>
            <hr>
            <button class="btn btn-secondary" onclick="history.back()">back</button>
        </div>
    </div>

<?php
//存在するとき
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
include("./pagination.php");
}//存在するとき
}//キーワードありのとき
?>
</div>
</body>
</html>