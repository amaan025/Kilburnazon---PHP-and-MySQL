<?php
    $host = "dbhost.cs.man.ac.uk";
    $password = "DN28vRCV92V3v5H";
    $username = "t50885aa";

    $db = new pdo('mysql:host=dbhost.cs.man.ac.uk;dbname=t50885aa;', $username, $password   );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);