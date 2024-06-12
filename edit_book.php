<?php

session_start();

include("root.php");
if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}
// First, establish a database connection
$conn = mysqli_connect("localhost", "root", "", "demo");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a Bid is present in the URL parameters
if (isset($_GET['Bid'])) {
    $Bid = $_GET['Bid'];

    // Define the SQL query to retrieve the book data based on the Bid
    $sql = "SELECT * FROM books WHERE Bid=$Bid";

    // Execute the query and check if it was successful
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Fetch the book data and display it in an editable form
        $row = mysqli_fetch_assoc($result);

        // Get the options for AuthorId from the authors table
        $authorOptions = "";
        $sqlAuthors = "SELECT * FROM athours";
        $resultAuthors = mysqli_query($conn, $sqlAuthors);
        while ($rowAuthors = mysqli_fetch_assoc($resultAuthors)) {
            $selected = ($rowAuthors['AuthorId'] == $row['AuthorId']) ? "selected" : "";
            $authorOptions .= "<option value='" . $rowAuthors['AuthorId'] . "' $selected>" . $rowAuthors['AuthorName'] . "</option>";
        }

        // Get the options for CatId from the categories table
        $catOptions = "";
        $sqlCats = "SELECT * FROM categories";
        $resultCats = mysqli_query($conn, $sqlCats);
        while ($rowCats = mysqli_fetch_assoc($resultCats)) {
            $selected = ($rowCats['CatId'] == $row['CatId']) ? "selected" : "";
            $catOptions .= "<option value='" . $rowCats['CatId'] . "' $selected>" . $rowCats['CatName'] . "</option>";
        }

        // Style the page using CSS
        echo "<html>
              <head>
                <title>Update Book</title>
                <style>
                  body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background-color: #f2f2f2;
                    color: #333;
                  }
                  form {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
                    width: 600px;
                    margin: 50px auto;
                  }
                  input[type='text'], select, input[type='number'], input[type='email'] {
                    padding: 10px;
                    margin: 5px 0;
                    border: none;
                    border-radius: 3px;
                    box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.1);
                    width: 100%;
                  }
                  input[readonly] {
                    background-color: #eee;
                  }
                  input[type='submit'] {
                    background-color: #333;
                    color: #fff;
                    border: none;
                    border-radius: 3px;
                    padding: 10px 20px;
                    cursor: pointer;
                  }
                  input[type='submit']:hover {
                    background-color: #555;
                  }
                  label              {
                    display: block;
                    margin-bottom: 5px;
                  }
                  img {
                    max-width: 200px;
                    max-height: 300px;
                    margin: 10px;
                    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
                    border-radius: 5px;
                  }
                </style>
              </head>
              <body>
                <form method='post' action='update_book.php' enctype='multipart/form-data'>
                  <h2>Update Book</h2>
                  <input type='hidden' name='Bid' value='" . $row['Bid'] . "'>
                  <label for='title'>Title</label>
                  <input type='text' name='title' id='title' value='" . $row['Title'] . "' required>
                  <label for='author'>Author</label>
                  <select name='author' id='author'>
                    " . $authorOptions . "
                  </select>
                  <label for='category'>Category</label>
                  <select name='category' id='category'>
                    " . $catOptions . "
                  </select>
                  <label for='isbn'>ISBN</label>
                  <input type='text' name='isbn' id='isbn' value='" . $row['isbn'] . "' readonly>
                  <label for='price'>Price</label>
                  <input type='number' name='price' id='price' value='" . $row['Price'] . "' required>
                  <label for='image'>Image</label>
                  <img src='" . $row['Image'] . "'>
                  <br>
                  <a href='change_image.php?Bid=" . $row['Bid'] . "'>Change Image</a>
                  <br><br>
                  <input type='submit' value='Update Book'>
                </form>
              </body>
            </html>";
    } else {
        // If no book is found with the given Bid, display an error message
        echo "No book found with the given Bid.";
    }
    
} else {
    // If no Bid is present in the URL parameters, display an error message
    echo "No Bid specified.";
    }
    
    // Close the database connection
    mysqli_close($conn);
    ?>