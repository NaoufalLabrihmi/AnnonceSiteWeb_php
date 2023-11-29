<?php
require 'config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM annoncer WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVITO</title>

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto px-4 md:px-20 flex justify-between items-center">
        <!-- Logo -->
        <a href="<?= ROOT_URL ?>" class="text-white text-lg font-bold">AVITO</a>

        <!-- Burger Menu for Mobile -->
        <button id="burger-menu" class="md:hidden text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Navigation Links -->
        <div id="nav-links" class="items-center hidden md:flex space-x-4">
            <a href="<?= ROOT_URL ?>annonce.php" class="text-white">Annonce</a>
            <a href="<?= ROOT_URL ?>about.php" class="text-white">About</a>
            <a href="<?= ROOT_URL ?>services.php" class="text-white">Services</a>
            <a href="<?= ROOT_URL ?>contact.php" class="text-white">Contact</a>
            <?php if(isset($_SESSION['user-id'])): ?>
                <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="flex items-center space-x-2 text-white">
                    <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>" alt="Menu" class="h-8 w-8 rounded-full">
                </button>
                <div x-show="open" @click.away="open = false" class="absolute z-10 -ml-4 mt-8 w-36 transform -translate-x-1/2">
                    <div class="bg-white shadow-md rounded">
                        <a href="<?= ROOT_URL ?>admin/index.php" class="block px-4 py-2 text-gray-800">Dashboard</a>
                        <a href="<?= ROOT_URL ?>logout.php" class="block px-4 py-2 text-gray-800">Logout</a>
                    </div>
                </div>
            </div>
            <?php else :?>
            <a href="<?= ROOT_URL ?>signin.php" class="text-white">Sign In</a>
            <?php endif ?>
        </div>
    </div>
</nav>