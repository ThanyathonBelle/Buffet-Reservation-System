<?php include '../connect.php';?>

<?php 
    if(isset($_POST)){
        $food_id = $_POST['food_id'];
        $delete_menu = "DELETE FROM menu WHERE food_id = '{$food_id}'";
        mysqli_query($connect, $delete_menu);
        header("location: manage_menu.php");
    }
    mysqli_close($connect); 
?>
