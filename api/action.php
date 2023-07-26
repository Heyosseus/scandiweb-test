<?php
// include "db.php";
$connect = new PDO("mysql:host=localhost;", "rati", "");

$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT * FROM products
 ORDER BY id DESC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if ($received_data->action == 'insert') {
    $data = array(
        ':sku' => $received_data->sku,
        ':name' => $received_data->name,
        ':price' => $received_data->price
    );

    $query = "
 INSERT INTO products
 (sku, name, price) 
 VALUES (:sku, :name, :price)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted'
    );

    echo json_encode($output);
}
