<?php include 'header.php'; ?> 

<main>
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>        
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?php echo $category['categoryName']; ?></td>
            <td>
                <form action="." method="post">
                <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="category_id"
                           value="<?php echo $category['categoryID']; ?>"/>
                    <input type="submit" value="Delete"/>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>    
    </table>

    <h2 class="margin_top_increase">Add Category</h2>
    <form action="." method="post"
          id="add_category_form">
          <input type="hidden" name="action" value="add_category">
        <label>Name:</label>
        <input type="text" name="category_name" />
        <input id="add_category_button" type="submit" value="Add Category"/>
    </form>
    
    <p><a href="?action=list_items">To Do List</a></p>

</main>
<?php include 'footer.php'; ?> 