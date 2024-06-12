<?php
// establish mysqli connection
$mysqli = new mysqli("localhost", "root", null, "demo");

// check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

// calculate date one month ago
$date_one_month_ago = date('Y-m-d', strtotime('-1 month'));

// query to get user details and book details for users who took books one month ago
$query = "SELECT u.sname, u.email, b.Title,b.Bid FROM issuedbookdetails ibd
          INNER JOIN users u ON ibd.sid = u.sid
          INNER JOIN books b ON ibd.Bid = b.Bid
          WHERE ibd.IssueDate <= '$date_one_month_ago' AND ibd.ReturnDate IS NULL";

// execute query
$result = $mysqli->query($query);

// loop through results and send email to each user
while ($row = $result->fetch_assoc()) {
  $to = $row['email'];
  $subject = "Reminder: Return your library book";
  $message = "Dear " . $row['sname'] . ",\n\nThis is a friendly reminder that you borrowed the book " . $row['Title'] . " of Bid = ".$row['Bid']." from the library and it is now overdue. Please return the book as soon as possible to avoid any late fees.\n\nThank TEAM SRKR Lbrary";
  $headers = "From: srkreclibrary@gmail.com" . "\r\n" .
             "Reply-To: yourname@example.com" . "\r\n" .
             "X-Mailer: PHP/" . phpversion();

  if (mail($to, $subject, $message, $headers)) {
    echo "<p style='margin-left:40%;'>Email sent to " . $row['sname'] . " at <strong>" . $to . "</strong></p><br>";
  } else {
    echo "Failed to send email to " . $row['sname'] . " at " . $to . "<br>";
  }
}


// close mysqli connection
$mysqli->close();
?>
