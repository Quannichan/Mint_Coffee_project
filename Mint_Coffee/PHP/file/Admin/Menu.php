  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php 
include("../../config.php");
session_start();
if(isset($_SESSION['PN_A'])==TRUE && isset($_SESSION['P_A']) == TRUE){
    
}else{
    header("Location:/Mint_Coffee/PHP/Login.php");
}
if(isset($_POST['upload'])){
    if($_POST['choose'] == ''){
        $Message[] = 'Please choose categories!';
    }else{
        $image_name = $_FILES['my_Image']['name'];
        $image_size = $_FILES['my_Image']['tmp_name'];
        $img_ex = pathinfo($image_name,PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allow_exs = array("jpg","jpeg");
        if(in_array($img_ex_lc,$allow_exs)){
            $size = $_FILES['my_Image']['size'];
            if($size <= 2097152){
                if($_POST['choose'] == 'Drinks'){
                    $name_menu = $_POST['NAME'];
                    $file_name = pathinfo($_FILES['my_Image']['name'], PATHINFO_FILENAME);
                    $new_img = $file_name.'.'.$img_ex_lc;
                    $img_upload_Mysql = '/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/'.$new_img;
                    $img_upload_Mysql1 = '/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/'.$new_img;
                    $cate = $_POST['choose'];
                    $get_exist1 = mysqli_query($conn,"SELECT * FROM Mint_Coffee.product WHERE Name_Product = '$name_menu'; ")or die("Cannot get menu");
                    $get_exist2 = mysqli_query($conn,"SELECT * FROM Mint_Coffee.product WHERE Image_Product = '$img_upload_Mysql'; ")or die("Cannot get menu");
                    $get_exist3 = mysqli_query($conn,"SELECT * FROM Mint_Coffee.product WHERE Image_Product = '$img_upload_Mysql1'; ")or die("Cannot get menu");
                    if(mysqli_num_rows($get_exist1) > 0){
                        $Message[] = 'Menu existed!';
                    }elseif(mysqli_num_rows($get_exist2) > 0){
                        $Message[] = 'Image menu existed!';
                    }elseif(mysqli_num_rows($get_exist3) > 0){
                        $Message[] = 'Image menu existed!';
                    }else{
                        $img_upload = '../../../Images/Đồ-án-cơ-sở-1/Đồ uống/'.$new_img;
                        move_uploaded_file($image_size,$img_upload);
                        $price_text = $_POST['PRICE'].'.000đ';
                        $Price = $_POST['PRICE'] * 1000;
                        mysqli_query($conn,"INSERT INTO Mint_Coffee.product(Name_Product,price,Price_Product,Image_Product,categories,file_path,product_status) VALUES('$name_menu','$price_text',$Price,'$img_upload_Mysql','$cate','$img_upload','In Stock')")or die("Cannot add menu");
                        $Message[] = 'Add menu success !';
                    }
                }elseif($_POST['choose'] == 'Foods'){
                    $name_menu = $_POST['NAME'];
                    $file_name = pathinfo($_FILES['my_Image']['name'], PATHINFO_FILENAME);
                    $new_img = $file_name.'.'.$img_ex_lc;
                    $img_upload_Mysql = '/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/'.$new_img;
                    $img_upload_Mysql1 = '/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/'.$new_img;
                    $cate = $_POST['choose'];
                    $get_exist1 = mysqli_query($conn,"SELECT * FROM Mint_Coffee.product WHERE Name_Product = '$name_menu'; ")or die("Cannot get menu");
                    $get_exist2 = mysqli_query($conn,"SELECT * FROM Mint_Coffee.product WHERE Image_Product = '$img_upload_Mysql'; ")or die("Cannot get menu");
                    $get_exist3 = mysqli_query($conn,"SELECT * FROM Mint_Coffee.product WHERE Image_Product = '$img_upload_Mysql1'; ")or die("Cannot get menu");
                    if(mysqli_num_rows($get_exist1)>0){
                        $Message[] = 'Menu existed!';
                    }elseif(mysqli_num_rows($get_exist2) > 0){
                        $Message[] = 'Image menu existed!';
                    }elseif(mysqli_num_rows($get_exist3) > 0){
                        $Message[] = 'Image menu existed!';
                    }else{
                        $img_upload = '../../../Images/Đồ-án-cơ-sở-1/Bánh mì/'.$new_img;
                        move_uploaded_file($image_size,$img_upload);
                        $price_text = $_POST['PRICE'].'.000đ';
                        $Price = $_POST['PRICE'] * 1000;
                        mysqli_query($conn,"INSERT INTO Mint_Coffee.product(Name_Product,price,Price_Product,Image_Product,categories,file_path,product_status) VALUES('$name_menu','$price_text',$Price,'$img_upload_Mysql','$cate','$img_upload','In Stock')")or die("Cannot add menu");
                        $Message[] = 'Add menu success !';
                    }
                }
            }else{
                $Message[] = 'Wrong image size, please upload another image!';
            }
        }else{
            $Message[] = 'Wrong image type format !';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png"> 
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <title>Admin Page | New Menu</title>
</head>
<body>
<?php
        if(isset($Message)){
            foreach($Message as $Message){
                echo '<div class= "message" onclick="this.remove();" style="color:white;position: fixed;top: 0;left: 0;right: 0;padding: 15px 10px;backdrop-filter: blur(50px);text-align: center;z-index: 1000;background-color:black;border-style: solid;border-color: black;opacity: 1;}">'.$Message.'</div>';
            }
        }
    ?>
    <div class="Wrapper">
        <div class="box">
            <p class="head_page">New menu</p>
                <form class="new_menu" method="POST" action="/Mint_Coffee/PHP/file/Admin/Menu.php" enctype="multipart/form-data">
                    <div class="name_menu">
                        <input type="text" name="NAME" placeholder="Menu name" required><br>
                        <label for="NAME" >Name</label>
                    </div>
                    <div class="price">
                        <input type="number" class="Price" name="PRICE" placeholder="Ex: 12 for 12.000VNĐ" required ><br>
                        <a class="donvi">.000 VNĐ</a>
                        <label class="price_label" for="PRICE">Price</label>
                    </div>
                    <div class="category">
                        <select name="choose" class="CHOOSE" require>
                            <option value="">Categories</option>
                            <option value="Drinks">Drink</option>
                            <option value="Foods">Food</option>
                        </select>
                    </div>
                    <div class="image">
                        <a class="head_Up">Upload Image Menu</a><br>
                        <input type="file" class="image_file" name="my_Image" required>
                        <br>
                        <a>Resolution require: not over 2MB<br>type: JPG, JPEG</a><br>
                        <br>
                        <input type="submit" class="SUBMIT" name="upload" value="Upload">
                    </div>
                </form>
        </div>
    </div>
    <div class="But_gr">
        <button class="Edit_Menu" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/Edit_Menu.php'" title="Go to Update menu page"></button>
        <a class="text_edit">Edit menu</a>
        <br>
        <button class="home_but" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/AdminPage.php'" title="Back to Admin home"></button>
        <a class="text">Home Admin</a>
    </div>
</body>
</html>









































































































































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->