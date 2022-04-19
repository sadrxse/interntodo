<?php
$page_title = "create";
include("./header.php");
?>

<div class="container">
    <h2 style="margin-top:30px;">New ToDo</h2>
    <div class="row">
        <div class="col-md-8">
            <form method="post" action="create_check.php">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">content</label>
                    <textarea type="text" name="content" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
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