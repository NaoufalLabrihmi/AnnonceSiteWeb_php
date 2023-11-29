<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Check if there are posts belonging to this category
    $check_posts_query = "SELECT COUNT(*) as post_count FROM posts WHERE category_id=$id";
    $check_posts_result = mysqli_query($connection, $check_posts_query);
    $post_count = mysqli_fetch_assoc($check_posts_result)['post_count'];

    if ($post_count == 0) {
        // No posts in this category, safe to delete
        $delete_category_query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $delete_category_result = mysqli_query($connection, $delete_category_query);

        if ($delete_category_result) {
            $_SESSION['delete-category-success'] = "Category deleted successfully";
        } else {
            $_SESSION['delete-category-error'] = "Error deleting category: " . mysqli_error($connection);
        }
    } else {
        // There are posts in this category, set category_id to NULL (assuming your foreign key allows NULL)
        $update_posts_query = "UPDATE posts SET category_id=NULL WHERE category_id=$id";
        $update_posts_result = mysqli_query($connection, $update_posts_query);

        if ($update_posts_result) {
            // Now it's safe to delete the category
            $delete_category_query = "DELETE FROM categories WHERE id=$id LIMIT 1";
            $delete_category_result = mysqli_query($connection, $delete_category_query);

            if ($delete_category_result) {
                $_SESSION['delete-category-success'] = "Category deleted successfully";
            } else {
                $_SESSION['delete-category-error'] = "Error deleting category: " . mysqli_error($connection);
            }
        } else {
            $_SESSION['delete-category-error'] = "Error updating posts: " . mysqli_error($connection);
        }
    }
}

header('Location: ' . ROOT_URL . 'admin/manage-categories.php');
exit();
?>
