<head>
    <style>
        h3{
            display: inline;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
        }
        body{
            background-color: #DCDCFA;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        #user-details,
        #book-details {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #user-details h1,
        #book-details h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        #user-details h3,
        #book-details h3 {
            font-size: 18px;
            margin-bottom: 90px;
        }

        #user-details h3:first-of-type,
        #book-details h3:first-of-type {
            display: inline;
        }

        #book-details img {
            display: block;
            margin: 20px auto;
        }
        span{
            display: inline-block;
            min-width: 120px;
            margin-bottom: 20px;
        }
        button{
            display: block;
            margin: 10px auto;
            width:540px;
            background-color: #007bff;
            padding: 10px;
            color: white;
            border: none;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>

<?php
session_start();

include("root.php");
if(!isset($_SESSION['alogin'])){
    header("location:adminlogin.php");
  }

if (isset($_POST["issue"])) {

    $sid = $_POST['sid'];
    $Bid = $_POST['bid'];

    $con = mysqli_connect("localhost","root","","demo");

    $result1 = mysqli_query($con,"select * from books where `Bid`='$Bid'");
    $result4 = mysqli_query($con,"select * from users where `sid`='$sid'");

    $result6 = mysqli_query($con,"select count(*) AS occurences from issuedbookdetails where `sid`='$sid' and ReturnStatus=0");

    $no_of_books = mysqli_fetch_array($result6);


?>

<!-- display details of user -->
<div id="user-details">
<?php
if(mysqli_num_rows($result4)===1){
    $row = mysqli_fetch_assoc($result4);
?>
    
    <h1>User Details</h1>

    <span>sid</span><h3><?php echo $row['sid'] ?></h3><br>
    <span>Name</span><h3><?php echo $row['sname']  ?></h3><br>
    <span>email</span><h3><?php echo $row['email']  ?></h3><br>
    <span>phone number</span><h3><?php echo $row['phone_number']  ?></h3>




<?php
if($row['status']==0){
    echo "<br><h3 style='color:red;'>user is inactive</h3>";
}
if($no_of_books['occurences']==4){
    echo "<br><h3 style='color:red'>user is already borrowed limit 4 books</h1>";
}

}else{
    echo "<h3>user details not found</h3>";
}


?>

</div>

<?php

    echo '<div id="book-details">';

    if(mysqli_num_rows($result1)==1){

    $book = mysqli_fetch_assoc($result1);
    $catid = $book['CatId'];
    $result2 = mysqli_query($con,"select * from categories where `CatId`='$catid'");
    $category = mysqli_fetch_assoc($result2);

    
    $aid = $book['AuthorId'];
    $result3 = mysqli_query($con,"select * from athours where `AuthorId`='$aid'");
    $author = mysqli_fetch_assoc($result3);
    $result5 = mysqli_query($con,"select count(*) as occurences from issuedbookdetails where `Bid`='$Bid' and ReturnStatus=0");
    $no_of = mysqli_fetch_assoc($result5);
    
?>
    <h1>Book Details</h1>
    <span>Title:</span><h3><?php echo $book['Title']?></h3><br>
    <span>Category:</span><h3><?php echo $category['CatName']?></h3><br>
    <span>Authour:</span><h3><?php echo $author['AuthorName']?></h3><br>
    <span>isbn:</span><h3><?php echo $book['isbn']?></h3><br>
    <span>Price: $</span><h3><?php echo $book['Price']?></h3><br>
    <img src="<?php echo $book['Image']?>" alt="Book Image" height=120>

<?php
if($no_of['occurences']>0){
    echo "<h3 style='color:red'> Book already issued </h3>";
}
    }
    else{
        print("<h1>book details not found</h1>");
    }
    echo "</div>";

    if(mysqli_num_rows($result1)==1 && mysqli_num_rows($result4) && $row['status']==1 && $no_of['occurences']==0 && $no_of_books['occurences']<4){
        echo "<a href='issue_process.php?sid=".$sid."&Bid=".$Bid."'><button>issue book</button></a>";
    }

}else{


?>
</div>
<body>

    <form action="issue_book.php" method="POST">
    <h1>Issue Book</h1>
        <label for="sid">Enter Sid of the user:</label>
        <input type="number" name="sid" id = 'sid' >
        
        <label for="bid">Enter Bid of the book:</label>
        <input type="number" name="bid" id = "bid">
        
        <input type="submit" name = "issue" value="issue book" >
    </form>
</body>

<?php
}
?>