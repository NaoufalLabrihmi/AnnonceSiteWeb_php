<?php
include 'partials/header.php';
//fetch featured post fromdatabase
// $featured_query = "SELECT * FROM post WHERE is_featured= 1";
// $featured_result = mysqli_query($connection, $featured_query);
// $featured = mysqli_fetch_assoc($featured_result);

//fetch 10 posts from posts table
$query = "SELECT * FROM posts ";
$posts = mysqli_query($connection, $query);

?>

<?php while ($post = mysqli_fetch_assoc($posts)) : ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"
    />
    <title>Document</title>
  </head>
  <body>
    <div>
    <div class="bg-blue-600 p-4 "  >

      <div
        class="   m-2 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="">
          <img
            class="p-8 rounded-t-lg"
            src="./images/<?= $post['thumbnail'] ?>"
          />
        </div>
        <div class="px-5 pb-5">
          <a href="post.php">
            <h5
              class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"
            >
              <?= $post['title'] ?>
            </h5>
          </a>
          <p class="text-gray-600 dark:text-gray-400 mb-3">
            <?= substr($post['body'], 0, 300) ?>
          </p>
          <div class="flex items-center">
            <div>
              <!-- Announcer's Picture -->
              <?php print_r($post['thumbnail']) ?>
              <img class="p-8 rounded-t-lg" src="<?= ROOT_URL ?>images/1701266117<?= $post['thumbnail'] ?>
              alt=" Post Thumbnail">
            </div>
            <div class="ml-3">
              <!-- Announcer's Name -->
              <p class="text-sm font-medium text-gray-800 dark:text-white">
                John Doe
              </p>
              <?php
                            //fetch
                            $category_id = $post['category_id'];
                            $category_query = "SELECT * FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
              <!-- Category -->
              <a
                href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>"
                class="cursor-pointer"
                ><?= $category['title'] ?></a
              >
            </div>
          </div>
          <div class="flex items-center justify-between mt-3">
            <span class="text-3xl font-bold text-gray-900 dark:text-white"
              >$599</span
            >
            <a
              href="#"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >Add to cart</a
            >
          </div>
        </div>
      </div>
      <?php endwhile ?>
      </div>

      <div class="category">
        <div class="flex justify-center space-x-4 mb-4">
          <button
            class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
          >
            <a
              href=""
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
            >
              Purple to blue
            </a>
          </button>
          <button
            class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
          >
            <a
              href=""
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
            >
              Purple to blue
            </a>
          </button>
          <button
            class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
          >
            <a
              href=""
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
            >
              Purple to blue
            </a>
          </button>
        </div>

        <!-- Add the following buttons in the next line -->
        <div class="flex justify-center space-x-4">
          <button
            class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
          >
            <a
              href=""
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
            >
              Purple to blue
            </a>
          </button>
          <button
            class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
          >
            <a
              href=""
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
            >
              Purple to blue
            </a>
          </button>
          <button
            class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
          >
            <a
              href=""
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
            >
              Purple to blue
            </a>
          </button>
        </div>
    </div>

    <!-- footer -->

    <?php
        include 'partials/footer.php';
        ?>
  </body>
</html>
