<?php
include 'partials/header.php';

// Fetch categories from the database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

//get back form data if form was invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

//delete form data session
unset($_SESSION['add-post-data']);
?>

<div class="flex items-center justify-center min-h-screen bg-gray-100 mt-8">
    <form class="max-w-xl mx-auto p-10 bg-white rounded-md shadow-md" action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
        <h2 class="text-2xl font-bold mb-8 text-center">Add post</h2>

        <?php if(isset($_SESSION['add-post'])): ?>
            <div class="alert__message error mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['add-post']; 
                    unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>
            <?php unset($_SESSION['add-post']); ?>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?= $title ?>" name="title" placeholder="Title" />
            </div>
        </div>

        <select id="categories" name="category" class="mb-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <?php while($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
            <?php endwhile ?>
        </select>

        <textarea rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-5" name="body" placeholder="Body"><?= $body ?></textarea>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="price" placeholder="Price DH" />
            </div>
        </div>

        <?php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="flex items-center mb-5">
                <input id="is_featured" type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                <label for="is_featured" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Featured</label>
            </div>
        <?php endif ?>

        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="thumbnail">Add Thumbnail</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="thumbnail" id="thumbnail" type="file">
        </div>

        <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Post</button>
    </form>
</div>

<?php
include '../partials/footer.php';
?>
