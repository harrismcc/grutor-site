<?php
        if (isset($_POST["username"]) && isset($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            //Hashed password
            $hash = '$2y$10$NYdHxRRPyw0NvXQmqdDZ9ujk3yMYkaXUm2Jw1TxHD51.wIh5GP.3G';

            if ($username == "admin" && password_verify ( $password ,  $hash )){
                session_start();
                $_SESSION["admin"] = 1;
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/admin.php");
            }else{
                die("Username or password incorrect");
            }

        }
    ?>

<head>
    <link href="/StyleSheet.css" rel="stylesheet">
</head>
<body>
<h1>Admin Login</h1>

<form method="post">
    <input class="myFormInput" type="text" id="username" name="username" placeholder="Username" required />
    <input class="myFormInput" type="password" id="password" name="password" placeholder="Password" required />
    <input class="myButton" type="submit" />
</form>

</body>