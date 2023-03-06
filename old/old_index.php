<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get todolist for selected category
$querytodolist = 'SELECT * FROM todolist
                  WHERE categoryID = :category_id
                  ORDER BY ItemNum';
$statement3 = $db->prepare($querytodolist);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$todolist = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>To Do List</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1>To Do List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of todolist -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($todolist as $todo) : ?>
            <tr>
                <td><?php echo $todo['Title']; ?></td>
                <td><?php echo $todo['Description']; ?></td>
                <td><form action="delete_todo.php" method="post">
                    <input type="hidden" name="ItemNum"
                           value="<?php echo $todo['ItemNum']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $todo['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_todo_form.php">Add To Do Item</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
    <footer>
    </footer>
</main>
</body>
</html>