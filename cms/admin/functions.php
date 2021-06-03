<?php

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function confirmQuery($result) {

    global $connection;

    if(!$result) {

        die("Query Failed! " . mysqli_error($connection));
    }

    return $result;
}

function insertCategories() {

    global $connection;

    if (isset($_POST['submit'])) {
        $category_title = $_POST['category_title'];

        if($category_title == "" || empty($category_title)) {
            echo 'This field should not be empty.';
        } else {
            $query = "INSERT INTO categories (category_title) VALUES (trim('{$category_title}'))";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('Query failed! '. mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{

    global $connection;
    // Find all categories

    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_categories)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        echo "<tr>";
        echo "<td>$category_id </td>";
        echo "<td>$category_title</td>";
        echo "<td><a  onClick=\"javascript: return confirm('Are you sure you want to delete?');\"  href='categories.php?delete=$category_id'>Delete</a></td>";
        echo "<td><a href='categories.php?edit=$category_id'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategory() {

    global $connection;

    if (isset($_GET['delete'])) {
        $the_category_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE category_id = $the_category_id";

        $delete_query = mysqli_query($connection, $query);
        // Send to same page to show that category is deleted
        header ("Location: categories.php");
    }
}

?>
