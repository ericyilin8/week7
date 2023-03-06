<?php include 'header.php'; ?> 

<main>
<aside>
    <!--display a list of categories --> <h2>Categories</h2> 
    <nav> 
        <ul>
            <?php foreach ($categories as $category) : ?> 
                <li>
                    <a href="?category_id=<?php echo $category['categoryID']; ?>"> <?php echo $category['categoryName']; ?>
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
            </tr>

            <?php foreach ($items as $todo) : ?>
            <tr>
                <td><?php echo $todo['Title']; ?></td>
                <td><?php echo $todo['Description']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete_item">
                    <input type="hidden" name="ItemNum"
                           value="<?php echo $todo['ItemNum']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $todo['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
<p class="last_paragraph">        
        <h1>Add To Do</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="add_item">
            <label>Category:</label>
            <select name="category_id">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label>Title:</label>
            <input type="text" name="Title"><br>

            <label>Description:</label>
            <input type="text" name="Description"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add To Do"><br>
        </form>

        <p><a href="?action=list_categories">Edit Categories</a></p>
 </p>
</section> </main> <?php include 'footer.php'; ?> 