<head>
    <style>
        #topnav{
            background-color:#f8f9fa ;
            width: 100%;
            border-bottom: 5px solid #9170E4;
            padding: 0px;
            margin: 0px;
        }
        .menu{
            list-style: none;
            display: flex;
            position: relative;
            flex-direction: row;
            justify-content: space-between;
            width: 60%;
            background-color: #f8f9fa;
            color:#343a40;
            margin-left: auto;
            margin-right: auto;
            font-size: 16px;
            margin-bottom: 0px;
            font-family: "Open Sans",sans-serif;
            padding: 0px;
           
        }


        .menu .pages a{
            text-decoration: none;
            color:#343a40;
        }

        .menu .pages{
            padding: 20px;
            color: #343a40;
        }
        .dropdown{
            position: relative;
        }

        .dropdown-menu{
            display: none;
            border: 1px solid #ccc;
            position: absolute;
            list-style: none;
            top: 100%;
            min-width: 170px;
            padding-left: 0px;
            z-index: 900009;
        }

        .dropdown:hover .dropdown-menu{
            display: block;
            background-color: white;
        }

        .menu li .dropdown-menu{
            padding-left: 0%;
        }

        .dropdown-menu .subopts{
            padding: 10px;
        }

        .dropdown-menu .subopts:hover{
            background-color:#e8e8e8;
        }

        .dropdown-menu a{
            text-decoration: none;
        }
        .page{
            z-index: 90000;
        }
        .liblogo{
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0px auto;
            background-color: #f8f9fa;
        }
        #logo{
            background-color: #f8f9fa;
            width: 100%;
            margin-bottom: 0px;
            border-bottom: 2px solid plum;
            border-top: 2px solid #f8f9fa;
            padding: 10px 0px;
        }
        #logout-btn {
            background-color: red;
            padding: 10px;
            border: 0px;
            border-radius: 5px;
        }
        

    </style>

    
</head>

<body>

<div id="topnav">
<?php
ob_start();
if(isset($_SESSION['alogin']))
{
?>

    <div id="logo">
    <div class="liblogo">
        <div>
            <img src="libraryimage.jpg" alt="icon" style="height:60px">
        </div>
        <div><a href="logout.php"><button id="logout-btn">LOGOUT</button></a></div>
    </div>
    </div>
    
    <ul class="menu">
        <li class="pages"><a href="dashboard.php">DASHBOARD</a></li>
        <li class="pages dropdown">
            CATEGORIES
            <ul class="dropdown-menu">
                <li class="subopts"><a href="new_category.php">ADD CATEGORY</a></li>
                <li class="subopts"><a href="categories.php">MANAGE CATEGORIES</a></li>
            </ul>
        </li>

        <li class="pages dropdown">
            AUTHORS
            <ul class="dropdown-menu">
                <li class="subopts"><a href="new_author.php">ADD AUTHOR</a></li>
                <li class="subopts"><a href="authors.php">MANAGE AUTHORS</a></li>
            </ul>
        </li>
        
        <li class="pages dropdown">
            BOOKS
            <ul class="dropdown-menu">
                <li class="subopts"><a href="getbooks.php">ADD BOOK</a></li>
                <li class="subopts"><a href="manage_books.php">MANAGE BOOKS</a></li>
            </ul>
        </li>

        

        <li class="pages dropdown">
            ISSUE BOOKS
            <ul class="dropdown-menu">
                <li class="subopts"><a href="issue_book.php">ISSUE NEW BOOK</a></li>
                <li class="subopts"><a href="manage_issued_book.php">MANAGE ISSUED BOOKS</a></li>
            </ul>
        </li>

        <li class="pages"><a href="regstudents.php">REG STUDENTS</a></li>

        <li class="pages"><a href="changepassword.php">CHANGE PASSWORD</a></li>
        <li class="pages"><a href="send_emails.php" >SEND EMAILS</a></li>

    </ul>



    <?php
        }elseif(isset($_SESSION['ulogin'])){
    ?>

    <div id="logo">
    <div class="liblogo">
        <div>
            <img src="libraryimage.jpg" alt="icon" style="height:60px">
        </div>
        <div><a href="logout.php"><button id="logout-btn">LOGOUT</button></a></div>
    </div>
    </div>
     <ul class="menu">
        <li class="pages"><a href="userdashboard.php">DASHBOARD</a></li>
        
        <li class="pages"><a href="<?php echo 'issued-books.php?sid='.$_SESSION['user-sid']?>">ISSUED BOOKS</a></li>
        
        <li class="pages dropdown">
            ACCOUNT
            <ul class="dropdown-menu">
                <li class="subopts"><a href="<?php echo 'user-details.php?sid='.$_SESSION['user-sid']?>">MY PROFILE</a></li>
                <li class="subopts"><a href="changepassword.php">CHANGE PASSWORD</a></li>
            </ul>
        </li>

    </ul>


    


    <?php }else{?>

        <ul class="menu">
            <li class="pages"><a href="login.php">LOGIN</a></li>
            <li class="pages"><a href="register.php">REGISTER</a></li>
            <li class="pages"><a href="adminlogin.php">ADMIN LOGIN</a></li>
        </ul>

    <?php
    }?>
    
</div>

</body>