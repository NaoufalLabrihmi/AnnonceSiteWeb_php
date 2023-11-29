<?php
include 'partials/header.php';

//fetch current user's posts from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id, price FROM posts WHERE aut_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>


<?php if(isset($_SESSION['add-post-success'])) : // shows if add post was successful ?>
        <div class="alert__message success mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                    ?>
                </p>
        </div>
<?php elseif(isset($_SESSION['edit-post-success'])) : // shows if edit post was successful ?>
        <div class="alert__message success mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']);
                    ?>
                </p>
        </div>
<?php elseif(isset($_SESSION['edit-post'])) : // shows if add post was not successful ?>
        <div class="alert__message error mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']);
                    ?>
                </p>
        </div>
<?php elseif(isset($_SESSION['delete-post-success'])) : // shows if delete post was successful ?>
        <div class="alert__message success mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['delete-post-success'];
                    unset($_SESSION['delete-post-success']);
                    ?>
                </p>
        </div>        
<?php endif ?>    
<div class="font-sans bg-gray-100 flex justify-center items-center min-h-screen mt-20 mx-8">
        <div class="container mx-auto flex">
    
            <!-- Sidebar/Aside -->
            <aside class="bg-gray-800 text-white h-screen w-1/5 p-4">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold">Dashboard</h1>
                </div>
                <nav>
                    <a href="add-post.php" class="block py-2 text-white hover:bg-gray-700">Add Post</a>
                    <a href="index.php" class="block py-2 text-white hover:bg-gray-700">Manage Posts</a>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <a href="add-user.php" class="block py-2 text-white hover:bg-gray-700">Add User</a>
                    <a href="manage-users.php" class="block py-2 text-white hover:bg-gray-700">Manage Users</a>
                    <a href="add-category.php" class="block py-2 text-white hover:bg-gray-700">Add Category</a>
                    <a href="manage-categories.php" class="block py-2 text-white hover:bg-gray-700 ">Manage Categories</a>
                    <?php endif ?>
                </nav>
            </aside>
    
            <!-- Main Content -->
            <main class="flex-1 p-8 text-center">
                
                <!-- Table Section -->
                <section>
                    <h3 class="text-2xl font-bold mb-4">Manage Annonncers</h3>
                    <?php if (mysqli_num_rows($posts) > 0) : ?>
                    <table class="w-full border-collapse border rounded-lg overflow-hidden mx-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-2 px-4 border-b">Title</th>
                                <th class="py-2 px-4 border-b">Category</th>
                                <th class="py-2 px-4 border-b">Price</th>
                                <th class="py-2 px-4 border-b">Edit</th>
                                <th class="py-2 px-4 border-b">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get category title of each post from categories table -->
                              <?php 
                              $category_id = $post['category_id'];
                              $category_query = "SELECT title FROM categories WHERE id=$category_id";
                              $category_result = mysqli_query($connection, $category_query);
                              $category = mysqli_fetch_assoc($category_result);
                              ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b"><?= $post['title'] ?></td>
                                <td class="py-2 px-4 border-b"><?= $category['title'] ?></td>
                                <td class="py-2 px-4 border-b"><?= $post['price'] ?> dh</td>
                                <td class="py-2 px-4 border-b"><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="text-blue-500">Edit</a></td>
                                <td class="py-2 px-4 border-b"><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="text-red-500">Delete</a></td>
                            </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                        <div class="alert__message error mb-5"><?= "No posts found" ?></div>
                    <?php endif ?>
                </section>
            </main>
        </div>
    </div>
<?php
include '../partials/footer.php';
?>