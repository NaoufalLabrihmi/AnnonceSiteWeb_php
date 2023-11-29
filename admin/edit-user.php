<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM annoncer WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>



<form class="max-w-xl mx-auto p-10 bg-white rounded-md shadow-md" action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
    <h2 class="text-2xl font-bold mb-8 text-center">Edit annonncer</h2>
 
<div class="grid md:grid-cols-2 md:gap-6">
  <div class="relative z-0 w-full mb-5 group">
      <input type="hidden" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $user['id'] ?>" name="id" />
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name " />
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name"/>
  </div>
</div> 
<select name="userrole" class="mb-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="0">Annonceur</option>
    <option  value="1">Admin</option>
    </select>



<button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update annonncer</button>
</form>

<?php
include '../partials/footer.php';
?>