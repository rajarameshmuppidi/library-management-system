<head>
    <style>
        
    </style>
</head>
<?php

$id = $_GET['id'];
$sql = "SELECT issuedbookdetails.id,issuedbookdetails.Bid,issuedbookdetails.sid,books.Image as book_image, users.sname AS StudentName,books.isbn AS isbn, books.Title AS BookTitle, issuedbookdetails.IssueDate, issuedbookdetails.ReturnDate, issuedbookdetails.ReturnStatus FROM issuedbookdetails 
        INNER JOIN users ON issuedbookdetails.sid = users.sid 
        INNER JOIN books ON issuedbookdetails.Bid = books.Bid where issuedbookdetails.id = '$id'";

$con = mysqli_connect("localhost","root","","demo");
$result = mysqli_query($con,$sql);

$row = mysqli_fetch_assoc($result);

// print user details
$sid = $row['sid'];

$result2 = mysqli_query($con,"select * from users where `sid`='$sid'");

$user = mysqli_fetch_assoc($result2);

?>

<!-- <div class="user-details">
<h2>Student Details</h2>
<h4>Student Id</h4><span><?php echo $user['sid'] ?></span>
<h3>Student email Id</h3><span><?php echo $user['email'] ?></span>
<h3>Student Name</h3><span><?php echo $user['sname'] ?></span>
<h3>Student Contact number</h3><span><?php echo $user['phone_number'] ?></span>
</div> -->

<div id="student-details">
<h3>Student Details</h3>
<div class="info">
    <label for="">Student ID</label><?php echo $user['sid'] ?>
</div>
<div class="info">
<label for="">Student email id</label><?php echo $user['email'] ?>
</div>
<div class="info">
<label for="">Student Name</label><?php echo $user['sname'] ?>
</div>
<div class="info">
<label for="">Student contact number</label><?php echo $user['phone_number'] ?>
</div>

</div>

<!-- <div class="book-details">
    <h2>Book Details</h2>
    <h3>Book name</h3><span><?php echo $row['BookTitle']?></span>
    <h3>ISBN</h3><span><?php echo $row['isbn']?></span>
    <h3>Book issued date</h3><span><?php echo $row['IssueDate']?></span>
    <h3>Book return date</h3><span><?php  if($row['ReturnStatus']){echo $row['ReturnDate'];}else echo "not yet returned" ?></span>
    <h3>Book Image</h3><img src="<?php echo $row['book_image'] ?>" alt="book image">
</div> -->
<div id="book-details">
    <h3>Book Details</h3>
<div class="info">
    <label for="">Book name</label><?php echo $row['BookTitle'] ?>
</div>


<div class="info">
    <label for="">ISBN</label><?php echo $row['isbn'] ?>
</div>


<div class="info">
    <label for="">Book issued date</label><?php echo $row['IssueDate'] ?>
</div>


<div class="info">
    <label for="">Book return date</label><?php  if($row['ReturnStatus']){echo $row['ReturnDate'];}else echo "not yet returned" ?>
</div>

<div class="book-image">
    <label for="">Book Image</label><img src="<?php echo $row['book_image'] ?>" alt="book image">
</div>

</div>