<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch category from database
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/manage-categories');
    die();
}
?>


<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <form class="max-w-xl mx-auto p-10 bg-white rounded-md shadow-md" action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
        <h2 class="text-2xl font-bold mb-8 text-center">Edit category</h2>
     
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="hidden" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="id" value="<?= $category['id'] ?>" />
      </div>
    </div>
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="title" value="<?= $category['title'] ?>" placeholder="Title" />
      </div>
    </div>

    <textarea rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-5" name="description" placeholder="Description..."><?= $category['description'] ?></textarea>

    <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Category</button>
</form>
</div>

<?php
include '../partials/footer.php';
?>