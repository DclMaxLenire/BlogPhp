<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="../static/style/bootstrap.min.css">
            <title>Document</title>
        </head>
            <body>
<?php include_once './include/menu.php'; ?>