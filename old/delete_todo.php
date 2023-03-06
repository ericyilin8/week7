<?php
require_once('database.php');

// Get IDs
$_id = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($_id != false && $category_id != false) {
    $query = 'DELETE FROM todolist
              WHERE ItemNum = :_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':_id', $_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('index.php');