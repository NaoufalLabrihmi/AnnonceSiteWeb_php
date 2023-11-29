<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    // validate input values
    if(!$firstname){
        $_SESSION['add-user']="Please enter your first name";
    } elseif (!$lastname){
        $_SESSION['add-user']="Please enter your last name";
    } elseif (!$username){
        $_SESSION['add-user']="Please enter your username";
    } elseif (!$email){
        $_SESSION['add-user']="Please enter your a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['add-user']="password should be 8+ characters";
    } elseif (!$avatar['name']){
        $_SESSION['add-user']="Please add avatar";
    } else {
        //check if password don't match
        if($createpassword !== $confirmpassword){
            $_SESSION['add-user']="Password do not match"; //khas ntchickiha
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            
            // check if username or email already exist in database
            $user_check_query = "SELECT * FROM annoncer WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0){
                $_SESSION['add-user'] = "Username or Email already exist";
            } else {
                //work on avatar
                // rename avatar
                $time = time(); //make each image name unique using current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path  = '../images/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    //make sure image is not too large (1mb +)
                    if ($avatar['size'] < 1000000){
                        //update avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }else {
                        $_SESSION['add-user'] = "file size too big";
                    }
                } else {
                    $_SESSION['add-user']= "file should be png, jpg or jpeg";
                }
            }
        }
    }
    //redirect to signup page if there is a prblm
    if($_SESSION['add-user']){
        //pass form data back to signup page
        $_SESSION['add-user-data']= $_POST;
        header('location: ' . ROOT_URL . '/admin/add-user.php');
        die();
    } else{
        //insert new user into users table
        $insert_user_query = "INSERT INTO annoncer SET firstname='$firstname', lastname='$lastname', username='$username', email='$email',
         password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin";
         $insert_user_result = mysqli_query($connection, $insert_user_query);

         if(!mysqli_errno($connection)){
            //redirect to login page with success msg
            $_SESSION['add-user-success']= "New user $firstname $lastname added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
         }
    }
} else {
    //if buttton wasn't clicked, bounce back  to signup page
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
