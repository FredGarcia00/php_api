<?php

class Categories {
    // DB 
    private $conn;
    private $table = 'categories';

    // Post properties
    public $id;
    public $category_name;
    public $created_at;

    //Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Posts
    public function read() {
        //Create query 
        $query = 'SELECT 
                  c.name as category_name,
                  c.id,
                  c.created_at
                  FROM
                  ' . $this->table. ' c
                  ORDER BY
                  c.created_at 
                  DESC';

                  //Prepare statement
                  $stmt = $this->conn->prepare($query);

                  //Execute query 
                  $stmt->execute();

                  return $stmt;
                  
    }

}