<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avito</title>
    <link rel="stylesheet" href="./css/style.css">

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form class="max-w-xl mx-auto p-10 bg-white rounded-md shadow-md" action="<?= ROOT_URL ?>signin-logic.php" method="POST">
        <h2 class="text-2xl font-bold mb-8 text-center">Sign In</h2>
        <?php if(isset($_SESSION['signup-success'])) : ?> 
        <div class="alert__message success mb-5">
            <p class="text-700 font-bold text-center">
                <?= $_SESSION['signup-success'];
                unset($_SESSION['signup-success']) 
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['signin'])) : ?>
        <div class="alert__message success mb-5">
            <p class="text-700 font-bold text-center">
                <?= $_SESSION['signin'];
                unset($_SESSION['signin']) 
                ?>
            </p>
        </div>
        <?php endif ?>
     
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="username_email" value="<?= $username_email ?>" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="User name or Email " required />
      </div>
    </div>
   
    <div class="relative z-0 w-full mb-5 group">
        <input type="password" name="password" value="<?= $password ?>" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Password" required />
    </div>
  
    <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign In</button>
    <p class="mt-4 text-gray-600 text-center">Don't have account? <a href="signup.php" class="text-blue-500">Sign Up</a></p>
</form>
  
</body>
</html>