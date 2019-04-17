<?php

$pdo = new PDO('mysql:dbname=blogPhp;host=localhost', 'projetBlogPhp', '14759');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
