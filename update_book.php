<?php

// Start a session
session_start();
if(!isset($_SESSION['alogin'])){
    header("location:adminlogin.php");
  }

// Check if the user is logged in as an admin
// if (!isset($_SESSION['admin'])) {
//     // If not, redirect them to the login page
//     header("Location: admin_login.php");
//     exit();
// }

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    // require_once 'db_connect.php';
    $conn = mysqli_connect("localhost",'root',"",'demo');

    // Get the book data from the form
    $Bid = $_POST['Bid'];
    $title = $_POST['title'];
    $authorId = $_POST['author'];
    $catId = $_POST['category'];
    $price = $_POST['price'];

    // Update the book data in the database
    $sql = "UPDATE books SET Title = '$title', AuthorId = '$authorId', CatId = '$catId', Price = '$price' WHERE Bid = '$Bid'";
    if (mysqli_query($conn, $sql)) {
        // If the book data update is successful, redirect the user to the view_books.php page
        header("Location: manage_books.php");
        exit();
    } else {
        // If there is an error updating the book data, display an error message
        echo "Error updating book: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form has not been submitted, display an error message
    echo "Form not submitted.";
}
?>
