<?php

require 'config/config.php';

//var_dump($_POST);

if ( !isset($_POST['title']) || empty($_POST['title'])
    || !isset($_POST['date']) || empty($_POST['date'])
    || !isset($_POST['diary']) || empty($_POST['diary']) ) {
    $error = "Please fill out all required fields.";
}
else {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }

        $sql = "INSERT INTO diarys(title, date, diary, users_user_id) VALUES('" . $_POST["title"] . "','" . $_POST["date"]. "','" . $_POST["diary"] . "', " . $_SESSION["user_id"] . ");" ;

        //echo "<hr>" . $sql . "<hr>";

        $results = $mysqli->query($sql);
        if(!$results) {
            echo $mysqli->error;
            exit();
        }

    $mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Diary</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php';?>
    <div class="container">
        <div class="row">
            <h1 class="col-12 mt-4">Add Diary</h1>
        </div>
    </div> 

    <div class="container">

        <div class="row mt-4">
            <div class="col-12">
                <?php if ( isset($error) && !empty($error) ) : ?>
                    <div class="text-danger"><?php echo $error; ?></div>
                <?php else : ?>
                    <div class="text-success">A new diary was successfully registered.</div>
                <?php endif; ?>
        </div> 
    </div> 

    <div class="row mt-4 mb-4">
        <div class="col-12">
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-dark">Back</a>
        </div> 
    </div> 

</div>

</body>
</html>