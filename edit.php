<?php
$page_title = "edit";
include("./header.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
?>

<div class="container">
    <h2 style="margin-top:30px;">Edit ToDo</h2>

        <div class="row">
            <div class="col-md-8">
                <form method="post" action="edit_check.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" >

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?php echo $title; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">content</label>
                        <textarea type="text" name="content" class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $content; ?></textarea>
                    </div>
                    <button type="submit" name="post" class="btn btn-outline-primary">Go!</button>
                </form>

                <form action="index.php" style="margin-top: 15px;">
                    <button type="submit" name="back" class="btn btn-secondary">back</button>
                </form>
            </div>
        </div>
        
</div>
</body>
</html>