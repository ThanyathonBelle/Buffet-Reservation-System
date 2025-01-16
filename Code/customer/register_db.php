<?php include '../connect.php' ?>

<?php
    session_start();

    if (isset($_POST['reg_user'])){
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password_1 = mysqli_real_escape_string($connect, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($connect, $_POST['password_2']);
        $firstname = mysqli_real_escape_string($connect, $_POST['fname']);
        $lastname = mysqli_real_escape_string($connect, $_POST['lname']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $phone = mysqli_real_escape_string($connect, $_POST['phone']);

        if ($password_1 != $password_2){
            setcookie("error_reg", "The two password do not match!", time() + (5), "/");
            header('location: login.php');
        }else{
            $user_check_querk = "SELECT * FROM member WHERE user_name = '$username' OR email = '$email' OR '$phone';";
            $query = mysqli_query($connect, $user_check_querk);
            $result = mysqli_fetch_assoc($query);

            if($result['user_name'] === strtolower($username)){
                setcookie("error_reg", "Username already exists!", time() + (5), "/");
                header('location: login.php');
            }elseif($result['email'] === strtolower($email)){
                setcookie("error_reg", "email already exists!", time() + (5), "/");
                header('location: login.php');
            }elseif($result['phone'] === $phone){
                setcookie("error_reg", "phone already exists!", time() + (5), "/");
                header('location: login.php');
            }else{
                $password = md5($password_1);
                $insert = "INSERT INTO member(user_name, password, first_name, last_name, email, phone) 
                    VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$phone');";
                mysqli_query($connect, $insert);
                $_SESSION['user_name'] = $username;
                setcookie("reg", "{$username} You have succssfully registred.", time() + (5), "/");
                header('location: ../index.php');
            }
        }
        mysqli_close($connect);
    }
?>