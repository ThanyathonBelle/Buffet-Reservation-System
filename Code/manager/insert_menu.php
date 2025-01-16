<?php include '../connect.php';?>

<?php
    if(isset($_POST)){
        $food_name = mysqli_real_escape_string($connect,$_POST['food_name']);
        $category = mysqli_real_escape_string($connect,$_POST['category']);
        $details = mysqli_real_escape_string($connect,$_POST['details']);
        if(isset($_FILES['image'])){
            $image = $_FILES['image']['tmp_name'];
            $imgcontent = addslashes(file_get_contents($image));

            $insert_menu = "INSERT INTO menu(food_name, details, image, category) 
            VALUES ('$food_name', '$details', '{$imgcontent}','$category');";
            mysqli_query($connect, $insert_menu);
            header("location: manage_menu.php");
        }
    }
    mysqli_close($connect);
?>