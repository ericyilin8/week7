<?php
function get_items_by_category($category_id)
{
global $db;
// Get todolist for selected category
$querytodolist = 'SELECT * FROM todolist
                  WHERE categoryID = :category_id
                  ORDER BY ItemNum';
$statement3 = $db->prepare($querytodolist);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$todolist = $statement3->fetchAll();
$statement3->closeCursor();
return $todolist;
}

function get_item($ItemNum)
{
    global $db;
    $query = 'SELECT * FROM todolist WHERE ItemNum = :ItemNum'; $statement = $db->prepare($query);
    $statement->bindValue(':ItemNum', $ItemNum); $statement->execute(); $item = $statement->fetch(); $statement->closeCursor(); 
    return $item;
}

function delete_item($ItemNum)
{
    global $db;
    $query = 'DELETE FROM todolist
              WHERE ItemNum = :ItemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':ItemNum', $ItemNum);
    $success = $statement->execute();
    $statement->closeCursor();   
}

function add_item($category_id, $Title, $Description)
{
    global $db;
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
}
?>