<?php
$page_title = "create_check";
include("./header.php");

$title = $_POST['title'];
$content = $_POST['content'];

$title = htmlspecialchars($title,ENT_QUOTES,'UTF-8');
$content = htmlspecialchars($content,ENT_QUOTES,'UTF-8');
?>

<div class="container">
<!-- タイトル未入力 -->
<?php if($title==''){ ?>
    <div class="alert alert-success" role="alert" style="margin-top:30px;">
        <h4 class="alert-heading">The Title is null</h4>
        <hr>
        <button class="btn btn-secondary" onclick="history.back()">back</button>
    </div>
<!-- タイトル文字数オーバー -->
<?php } elseif(mb_strlen($title)>200){ ?>
    <div class="alert alert-success" role="alert" style="margin-top:50px;">
        <h4 class="alert-heading">The Title is too long. The maximum number of characters is 200</h4>
        <hr>
        <button class="btn btn-secondary" onclick="history.back()">back</button>
    </div>
<!-- コンテント未入力 -->
<?php } elseif($content==''){ ?>
    <div class="alert alert-success" role="alert" style="margin-top:50px;">
        <h4 class="alert-heading">The Content is null</h4>
        <hr>
        <button class="btn btn-secondary" onclick="history.back()">back</button>
    </div>
<?php } else{ ?>
    <h2 style="margin-top:30px;">Add this ToDo?</h2>

    <div class="card" style="width: 50rem; margin: 30px 0 30px 0;">
        <h5 class="card-header">Title: <?php echo $title; ?></h5>
        <div class="card-body">
            <p>Content: <?php echo $content; ?></p>
        </div>
    </div>
    <form method="post" action="create_done.php">
        <input type="hidden" name="title" value="<?php echo $title; ?>">
        <input type="hidden" name="content" value="<?php echo $content; ?>">
        <br />
        <input type="button" class="btn btn-secondary" onclick="history.back()" value="back">
        <input type="submit" class="btn btn-outline-primary" value="OK" >
    </form>
<?php } ?>
</div>
</body>
</html>