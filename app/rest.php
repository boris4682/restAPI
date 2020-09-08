<?php



try {
    $con = new PDO(
        "mysql:host=db;dbname=orders;charset=utf8",
        'root',
        'password');
    $sth = $con->prepare("SELECT * FROM `orders` WHERE `id` = :id");
    $sth->execute(array('id' => '6'));
    $array = $sth->fetch(PDO::FETCH_ASSOC);
    print_r($array);
} catch (PDOException $e) {
    echo $e->getMessage();
}
