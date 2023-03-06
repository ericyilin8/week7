<?php
// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$Title = filter_input(INPUT_POST, 'Title');
$Description = filter_input(INPUT_POST, 'Description');

// Validate inputs
if ($category_id == null || $category_id == false ||
        $Title == null || $Description == null ) {
    $error = "Invalid data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the todo to the database  
    $query = 'INSERT INTO todolist
                 (categoryID, Title, Description)
              VALUES
                 (:category_id, :Title, :Description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':Title', $Title);
    $statement->bindValue(':Description', $Description);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>