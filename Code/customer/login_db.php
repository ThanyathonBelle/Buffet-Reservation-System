<?php include '../connect.php' ?>

<?php 
    session_start();

    if (isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        $query_admin_pwd = "SELECT * FROM admin WHERE user_name = '$username' AND password = '$password' ";
        $result_admin = mysqli_query($connect, $query_admin_pwd);

        $password = md5($password);
        $query_user_pwd = "SELECT * FROM member WHERE user_name = '$username' AND password = '$password' ";
        $result_user = mysqli_query($connect, $query_user_pwd);

        if(mysqli_num_rows($result_admin) == 1){
            $row = mysqli_fetch_array($result_admin);
            $role = $row['role'];
            $_SESSION['role'] = $role;
            if($role == "manager"){
                header('location: ../employee/reservation_history.php');
            }elseif($role == "employee"){
                header('location: ../employee/reservation_history.php');
            }else{
                header('location: ../chef/foodorders.php');
            }
        }elseif(mysqli_num_rows($result_user) == 1){
            $_SESSION['user_name'] = $username;
            setcookie("login", "{$username} You have succssfully logeed in.", time() + (5), "/");
            header('location: ../index.php');
            }else{
                setcookie("error_login", "Wrong username or password try agin!", time() + (5), "/");
                header('location: login.php');
            }
        mysqli_close($connect);
    }
?>