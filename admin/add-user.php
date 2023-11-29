<?php
include 'partials/header.php';

//get back form data if there was an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
//delete session data
unset($_SESSION['add-user-data']);
?>



<form class="max-w-xl mx-auto p-10 bg-white rounded-md shadow-md" action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
    <h2 class="text-2xl font-bold mb-8 text-center">Add annonncer</h2>
    <?php if(isset($_SESSION['add-user'])) : ?>
        <div class="alert__message error mb-5">
            <p class="text-700 font-bold text-center">
                <?= $_SESSION['add-user'];
                unset($_SESSION['add-user']);
                ?>
            </p>
        </div>

    <?php endif ?>    

<div class="grid md:grid-cols-2 md:gap-6">
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $firstname ?>" name="firstname" placeholder="First Name "  />
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $lastname ?>" name="lastname" placeholder="Last Name"/>
  </div>
</div>
<div class="grid md:grid-cols-1 md:gap-6">
  <div class="relative z-0 w-full mb-5 group">
    <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $username ?>"  placeholder="User Name"/>
</div>
</div>
<div class="relative z-0 w-full mb-6 group">
    <input type="email" name="email" class="block py-3 px-4 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $email ?>" placeholder="Email"/>
</div>
<div class="relative z-0 w-full mb-5 group">
    <input type="password" name="createpassword" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $createpassword ?>" placeholder="Create Password"/>
</div>
<div class="relative z-0 w-full mb-5 group">
    <input type="password" name="confirmpassword" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $confirmpassword ?>" placeholder="Confirm Password " />
</div>
<select name="userrole" class="mb-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="0">Annonceur</option>
    <option  value="1">Admin</option>
    </select>

<label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="avatar">User Avatar</label>
<input name="avatar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mb-4" aria-describedby="user_avatar_help" id="avatar" type="file">
<div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>



<button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add annonncer</button>
</form>
<?php
include '../partials/footer.php';
?>