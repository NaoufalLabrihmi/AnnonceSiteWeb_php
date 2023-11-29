<?php
require 'config/database.php';

//make sure edit post button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ? 1 : 0;

    //check and validate input values
    if (!$title || !$category_id || !$body || !$price) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page.";
    } else {
        //delete existing thumbnail if a new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if (file_exists($previous_thumbnail_path)) {
                unlink($previous_thumbnail_path);
            }

            //work on a new thumbnail
            //rename image
            $time = time(); // make each image name upload using the current timestamp
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // make sure the file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);
            if (in_array($extension, $allowed_files)) {
                if ($thumbnail['size'] < 2000000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-post'] = "Couldn't update post. Thumbnail size too big.";
                }
            } else {
                $_SESSION['edit-post'] = "Thumbnail should be PNG, JPG, or JPEG.";
            }
        }

        if ($_SESSION['edit-post']) {
            //redirect to the manage form page if the form was invalid
            header('location: ' . ROOT_URL . 'admin/');
            die();
        } else {
            //set is_featured of all posts to 0 if is_featured for this post is 1
            if ($is_featured == 1) {
                $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
                $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
            }

            $thumbnail_to_insert = isset($thumbnail_name) ? $thumbnail_name : $previous_thumbnail_name;

            $query = "UPDATE posts SET title='$title', body='$body', price='$price', thumbnail='$thumbnail_to_insert', 
            category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);
        }

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-post-success'] = "Post update successful.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
