<?php

class MainController {

    public function index($id) {
        $con = new PDO(
                    "mysql:host=db;dbname=orders;charset=utf8",
                    'root',
                    'password');
        $query = $con->prepare("SELECT `id` as '№', `order_id` as 'Идентификатор заказа', `amount` as 'Сумма' FROM `orders` WHERE `id` = :id");
        $query->execute(array('id' => $id));
        $array = $query->fetch(PDO::FETCH_ASSOC);

        return $array;
    }
}