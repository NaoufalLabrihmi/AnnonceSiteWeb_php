<?php
include 'partials/header.php';

//fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM annoncer WHERE NOT id=$current_admin_id";
$annoncer = mysqli_query($connection, $query);
?>
    <?php if(isset($_SESSION['add-user-success'])) : // shows if add user was successful
        ?>
        <div class="alert__message success mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']);
                    ?>
                </p>
        </div>
        <?php elseif(isset($_SESSION['edit-user-success'])) : // shows if edit user was successful
            ?>
        <div class="alert__message success mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                    ?>
                </p>
        </div>
        <?php elseif(isset($_SESSION['edit-user'])) : // shows if edit user was NOT successful
            ?>
        <div class="alert__message error mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                    ?>
                </p>
        </div>
        <?php elseif(isset($_SESSION['delete-user'])) : // shows if delete user was NOT successful
            ?>
        <div class="alert__message error mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['delete-user'];
                    unset($_SESSION['delete-user']);
                    ?>
                </p>
        </div>
        <?php elseif(isset($_SESSION['delete-user-success'])) : // shows if delete user was successful
            ?>
        <div class="alert__message error mb-5">
                <p class="text-700 font-bold text-center">
                    <?= $_SESSION['delete-user-success'];
                    unset($_SESSION['delete-user-success']);
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
                    <?php if(mysqli_num_rows($annoncer) > 0) : ?>
                    <table class="w-full border-collapse border rounded-lg overflow-hidden mx-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Username</th>
                                <th class="py-2 px-4 border-b">Edit</th>
                                <th class="py-2 px-4 border-b">Delete</th>
                                <th class="py-2 px-4 border-b">Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($user = mysqli_fetch_assoc($annoncer)) : ?>
                            <!-- Add rows dynamically based on your data -->
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b"><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td class="py-2 px-4 border-b"><?= $user['username'] ?></td>
                                <td class="py-2 px-4 border-b"><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="text-blue-500">Edit</a></td>
                                <td class="py-2 px-4 border-b"><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="text-red-500">Delete</a></td>
                                <td class="py-2 px-4 border-b"><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                            </tr>
                            <?php endwhile ?>    
                        </tbody>
                    </table>
                </section>
                <?php else : ?>
                    <div class="alert__message error mb-5"><?= "No users found" ?></div>
                <?php endif ?>    
            </main>
        </div>
    </div>
    
<?php
include '../partials/footer.php';
?>