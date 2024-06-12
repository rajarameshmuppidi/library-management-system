
<head>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>


<body class="homepage">

<?php
include('root.php');

?>


<div id="regpage">
    
<h1  style="color:brown;background-color:white;border:3px solid brown;border-radius:5px">REGISTER</h1>
<div id = "content-wrapper" class="homepage">
<form action="accountopen.php" autocomplete="FALSE">

<div class="regfield">
<label for="fullname">Enter full name</label>
<input type="text" name = "fullname" autocomplete="FALSE" required>
</div>

<div class="regfield">
    <label for="mobile number">Mobile Number</label>
    <input type="number" name="mobilenumber" autocomplete="FALSE" pattern="[0-9]{10}" required>
</div>
<div class="regfield">
    <label for="email">Email</label>
    <input type="email" name = "email" autocomplete="FALSE" required>
</div>
<div class="regfield">
    <label for="password">Enter Password</label>
    <input type="password" name = 'pwd' autocomplete="FALSE" required>
</div>
<div class="regfield">
    <label for="repassword">Confirm Password</label>
    <input type="password" name = "cpwd" required>
</div>
<div class="regfield">
    <label for="lecturer">Are you Staff? </label>
    <input type="checkbox" name="staff" value = "off">
</div>

<div class="regfield">
    <label for="no" ></label><a href="login.php" style="font-family: 'Open Sans', sans-serif;;">Login |</a>
    <input type="submit" name = "regis">
</div>
</form>
</div>
</div>
    <?php
    include("footer.php");
    ?>
</body>



<!-- Add the following script tag to your HTML page -->
<script>
  const mobileNumberInput = document.querySelector('input[name="mobilenumber"]');

  mobileNumberInput.addEventListener('input', function() {
    // Remove any non-digit characters from the input
    const inputDigits = this.value.replace(/\D/g, '');

    // If the input contains more than 10 digits, remove the excess
    const formattedDigits = inputDigits.slice(0, 10);

    // Update the input field value with the formatted digits
    this.value = formattedDigits;
  });

  mobileNumberInput.addEventListener('change', function() {
    // Check if the input contains exactly 10 digits
    if (this.value.length !== 10) {
      alert("Please enter a valid 10-digit mobile number.");
      this.value = ''; // Clear the input field
    }
  });
</script>

<!-- Add the following HTML code to your form -->


<!-- Add the following script tag to your HTML page -->
<script>
  const pwdInput = document.querySelector('input[name="pwd"]');
  const cpwdInput = document.querySelector('input[name="cpwd"]');

  cpwdInput.addEventListener('input', function() {
    const cpwdValue = this.value;
    const pwdValue = pwdInput.value;

    if (cpwdValue !== pwdValue) {
      this.setCustomValidity("Passwords do not match");
    } else {
      this.setCustomValidity('');
    }
  });
</script>


