<?php
require 'config/constants.php';

//get back form data if there was a registration prblm
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
//delete signup data session
unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="./css/style.css">

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form class="max-w-xl mx-auto p-10 bg-white rounded-md shadow-md" action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="post">
        <h2 class="text-2xl font-bold mb-8 text-center">Sign Up</h2>
        <?php if (isset($_SESSION['signup'])) : ?>
            <div class="alert__message error mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                    </p>
                    </div>
        <?php endif ?>    
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="firstname" id="floating_first_name" value="<?= $firstname ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="First name "/>
      </div>
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="lastname" value="<?= $lastname ?>" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Last name "/>
      </div>
    </div>
    <div class="grid md:grid-cols-1 md:gap-6">
      
      <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="username" value="<?= $username ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="User name "/>
    </div>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <input type="email" name="email" value="<?= $email ?>" id="floating_email" class="block py-3 px-4 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Email "/>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="password" value="<?= $createpassword ?>" name="createpassword" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Password "/>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="password" value="<?= $confirmpassword ?>" name="confirmpassword" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Confirm Password "/>
    </div>
    

    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="avatar">User Avatar</label>
<input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mb-4" aria-describedby="user_avatar" id="avatar" type="file" name="avatar">
<div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>

 
  
    <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign Up</button>
    <p class="mt-4 text-gray-600 text-center">Already have an account? <a href="signin.php" class="text-blue-500">Sign In</a></p>
</form>
  
</body>
</html>