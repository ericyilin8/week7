<?php
require('model/database.php');
require('model/item_db.php');
require('model/category_db.php');

$ItemNum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);
$Title = filter_input(INPUT_POST, 'Title', FILTER_UNSAFE_RAW);
$Description = filter_input(INPUT_POST, 'Description', FILTER_UNSAFE_RAW);

$category_name = filter_input(INPUT_POST, 'category_name', FILTER_UNSAFE_RAW);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
if (!$category_id) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
}


$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = 'list_items';
    }
}

switch ($action) {
    case "list_categories":
        $categories = get_categories();
        include('view/category_list.php');
        break;
    case "add_category":
        add_category($category_name);
        header("Location: .?action=list_categories");
        break;
    case "add_item":
        if ($category_id && $Description && $Title) {
            add_item($category_id, $Title, $Description);
            header("Location: .?category_id=$category_id");
        } else {
            $error = "Invalid item data .Check all felids and try again";
            include("view/error.php");
            exit();
        }
    case "delete_category":
        if ($category_id) {
            try {
                delete_category($category_id);
            } catch (PDOException $e) {
                $error = "You cannot delete a category if items exists in the category";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_categories");
        }
        break;
    case "delete_item":
        if ($ItemNum) {
            delete_item($ItemNum);
            header("Location: .?category_id=$category_id");
        } else {
            $error = "Missing or incorrect item id.";
            include('view/error.php');
        }

    default:
        $category_name = get_category_name($category_id);
        $categories = get_categories();
        $items =  get_items_by_category($category_id);
        include('view/item_list.php');
}