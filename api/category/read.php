<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Categories.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate category object
$category = new Categories($db);

//category query 
$result = $category->read();

//Get row count
$num = $result->rowCount();

//Check if any categories
if( $num > 0 ) {
    //post array
    $category_arr = [];
    $category_arr['data'] = [];

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = [
            'id' => $id,
            'category_name' => $category_name
        ];

        // push to "data"
        array_push($category_arr['data'], $category_item);
    }

    //Turn into JSON & output
    echo json_encode($category_arr);
} else{
    //no categories
    echo json_encode(
        ["message" => 'No categories found']
    );

}