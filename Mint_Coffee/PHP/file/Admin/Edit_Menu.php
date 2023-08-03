  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php 
include("../../config.php");
session_start();
$_SESSION['MENU_NAME_SAVE'] = '';
$_SESSION['ID'] = "";
$_SESSION['Name'] = "";
$_SESSION['PRICE'] = "";
$_SESSION['Cate'] = "";
$_SESSION['MENU'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product ORDER BY Name_Product ") or die ("Cannot get menu");
if(isset($_SESSION['PN_A'])==TRUE && isset($_SESSION['P_A']) == TRUE){
    
}else{
    header("Location:/Mint_Coffee/PHP/Login.php");
}
if(isset($_POST['YES'])){
    $file = $_POST['PRO_PATH'];
    unlink($file);
    $IDP = $_POST['ID_PRO'];
    mysqli_query($conn,"DELETE FROM Mint_Coffee.Cuscart WHERE Product_ID = $IDP ") or die ("Cannot delete");
    mysqli_query($conn,"DELETE FROM mint_coffee.product WHERE ID_product = '$IDP'") or die("Cannot delete");
    $Message[] = 'delete success !';
    header('refresh:1');
}
if(isset($_POST['SUBMIT'])){
    if(isset($_POST['SEARCH'])){
        $_SESSION['MENU_NAME_SAVE'] = $_POST['SEARCH'];
        $search = $_POST['SEARCH'];
        $_SESSION['MENU'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product WHERE Name_Product LIKE '%$search%' ORDER BY Name_Product ") or die ("Cannot get menu");
    }else{
        $_SESSION['MENU_NAME_SAVE'] = '';
        $_SESSION['MENU'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product ORDER BY Name_Product ") or die ("Cannot get menu");
    }
}
if(isset($_POST['EDIT_BUT'])){
    if($_FILES['IMG_CHOOSE']['name'] != ""){
        $image_name = $_FILES['IMG_CHOOSE']['name'];
        $image_size = $_FILES['IMG_CHOOSE']['tmp_name'];
        $img_ex = pathinfo($image_name,PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allow_exs = array("jpg","jpeg");
        if(in_array($img_ex_lc,$allow_exs)){
            $size =  $_FILES['IMG_CHOOSE']['size'];
            if($size <= 2097152 ){
                if($_POST['Choose_cate_EDIT'] == 'Drinks'){
                    $ID_pro_edit = $_POST['ID_PRO'];
                    $file_path_edit = $_POST['PRO_PATH'];
                    $name_pro_edit = $_POST['Nam_Pro'];
                    $pri_pro = $_POST['Pri_Pro']*1000;
                    $cate_pro_edit = $_POST['Choose_cate_EDIT'];
                    $pri_pro_text = $_POST['Pri_Pro'].'.000đ';
                    $file_name = pathinfo($_FILES['IMG_CHOOSE']['name'], PATHINFO_FILENAME);
                    $new_img = $file_name.'.'.$img_ex_lc;
                    $img_upload_Mysql = '/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/'.$new_img;
                    $img_upload = '../../../Images/Đồ-án-cơ-sở-1/Đồ uống/'.$new_img;
                    move_uploaded_file($image_size,$img_upload);
                    mysqli_query($conn,"UPDATE mint_coffee.product SET Name_Product = '$name_pro_edit' ,price = '$pri_pro_text', Price_Product = $pri_pro , categories = '$cate_pro_edit' , Image_Product = '$img_upload_Mysql', file_path = '$img_upload' WHERE ID_product ='$ID_pro_edit'; ") or die ("Cannot Update");
                    unlink($file_path_edit);
                    $Message[] = 'Update success !';
                    header('refresh:1');
                }elseif($_POST['Choose_cate_EDIT'] == 'Foods'){
                    $ID_pro_edit = $_POST['ID_PRO'];
                    $file_path_edit = $_POST['PRO_PATH'];
                    $name_pro_edit = $_POST['Nam_Pro'];
                    $pri_pro = $_POST['Pri_Pro']*1000;
                    $cate_pro_edit = $_POST['Choose_cate_EDIT'];
                    $pri_pro_text = $_POST['Pri_Pro'].'.000đ';
                    $file_name = pathinfo($_FILES['IMG_CHOOSE']['name'], PATHINFO_FILENAME);
                    $new_img = $file_name.'.'.$img_ex_lc;
                    $img_upload_Mysql = '/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/'.$new_img;
                    $img_upload = '../../../Images/Đồ-án-cơ-sở-1/Bánh mì/'.$new_img;
                    move_uploaded_file($image_size,$img_upload);
                    mysqli_query($conn,"UPDATE mint_coffee.product SET Name_Product = '$name_pro_edit' ,price = '$pri_pro_text', Price_Product = $pri_pro , categories = '$cate_pro_edit' , Image_Product = '$img_upload_Mysql', file_path = '$img_upload' WHERE ID_product ='$ID_pro_edit'; ") or die ("Cannot Update");
                    unlink($file_path_edit);
                    $Message[] = 'Update success !';
                    header('refresh:1');
                }
            }else{
                $Message[] = 'Wrong image size !';
                header('refresh:1');
            }
        }else{
            $Message[] = 'Wrong image format !';
            header('refresh:1');
        }
    }else{
        $ID_pro_edit = $_POST['ID_PRO'];
        $name_pro_edit = $_POST['Nam_Pro'];
        $pri_pro = $_POST['Pri_Pro']*1000;
        $cate_pro_edit = $_POST['Choose_cate_EDIT'];
        $pri_pro_text = $_POST['Pri_Pro'].'.000đ';
        mysqli_query($conn,"UPDATE mint_coffee.product SET Name_Product = '$name_pro_edit' ,price = '$pri_pro_text', Price_Product = $pri_pro , categories = '$cate_pro_edit'WHERE ID_product ='$ID_pro_edit'; ") or die ("Cannot Update");
        $Message[] = 'Update success !';
        header('refresh:1');
    }
}

if(isset($_POST['OOS'])){
    $ID_PRO = $_POST['ID_PRO'];
    mysqli_query($conn,"UPDATE Mint_Coffee.product SET product_status = 'Out Of Stock' WHERE ID_product = $ID_PRO ") or die ("Cannot update stock");
    mysqli_query($conn,"UPDATE Mint_Coffee.Cuscart SET STA = 'Out Of Stock' WHERE Product_ID = $ID_PRO ") or die ("Cannot update stock");
    $Message[] = 'Update success !';
    header('refresh:1');
}elseif(isset($_POST['IS'])){
    $ID_PRO = $_POST['ID_PRO'];
    mysqli_query($conn,"UPDATE Mint_Coffee.product SET product_status = 'In Stock' WHERE ID_product = $ID_PRO ") or die ("Cannot update stock");
    mysqli_query($conn,"UPDATE Mint_Coffee.Cuscart SET STA = 'In Stock' WHERE Product_ID = $ID_PRO ") or die ("Cannot update stock");
    $Message[] = 'Update success !';
    header('refresh:1');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png"> 
    <link rel="stylesheet" href="/Mint_Coffee/CSS/edit_menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <title>Admin Page | Edit Menu</title>
</head>
<body>
<?php
        if(isset($Message)){
            foreach($Message as $Message){
                echo '<div class= "message" onclick="this.remove();" style="color:white;position: fixed;top: 0;left: 0;right: 0;padding: 15px 10px;backdrop-filter: blur(50px);text-align: center;z-index: 1000;background-color:black;border-style: solid;border-color: black;opacity: 1;}">'.$Message.'</div>';
            }
        }
    ?>
    <h3 class=header>Edit Menu</h3>
    <div class="ser_wrap">
        <div class="ser_box">
            <form method="POST" class="ser">
                <input type="text" class="ser_inp" name="SEARCH" id="search" placeholder="Find something in menu" value="<?php echo $_SESSION['MENU_NAME_SAVE']?>"><br>
                <label class="ser_label" for="search">Search</label><br>
                <div class="but_sub">
                <input type="submit" class="ser_but" name="SUBMIT" value="Search">
                </div>
            </form>
        </div>
    </div>
</body>
    <div class="menu_wrap">
        <div class="menu_box">
            <?php 
                if(mysqli_num_rows($_SESSION['MENU']) > 0){
                    ?>
                    <table class="box">
                        <tr class="head">
                        <th class="table_head">Image</th>
                        <th class="table_head">Name</th>
                        <th class="table_head">price</th>
                        <th class="table_head">Categories</th>
                        <th class="table_head">Option</th>
                        </tr>
                    <?php
                    $save = 1;
                    while($fetch_menu = mysqli_fetch_assoc($_SESSION['MENU'])){
                        ?> 
                        <tr class="table_body">
                        <form method = "POST" action="/Mint_Coffee/PHP/file/Admin/Edit_Menu.php" enctype="multipart/form-data">
                            <td class="table_data"><img class="image_pro" src="<?php echo $fetch_menu['Image_Product'] ?>"/></td>
                            <td class="table_data"><?php echo $fetch_menu['Name_Product'] ?></td>
                            <td class="table_data"><?php echo $fetch_menu['price'] ?></td>
                            <td class="table_data"><?php echo $fetch_menu['categories'] ?></td>
                            <input type="hidden" name="ID_PRO" value="<?php echo $fetch_menu['ID_product'] ?>">
                            <input type="hidden" name="NAME_PRO" value="<?php echo $fetch_menu['Name_Product'] ?>">
                            <input type="hidden" name="CATEGORIES" value="<?php echo $fetch_menu['categories'] ?>">
                            <input type="hidden" name="PRICE" value="<?php echo $fetch_menu['Price_Product'] ?>">
                            <input type="hidden" name="PRO_PATH" value="<?php echo $fetch_menu['file_path'] ?>">
                            <input type="hidden" name="PRO_IMAGE" value="<?php echo $fetch_menu['Image_Product'] ?>">
                            <div class="ask_wrap" id="ask_wrap<?php echo $save?>">
                            <div class="ask">
                                <div class="ask_box">
                                <h3 class="HEAD">Are you sure you want to delete<br>Menu: <?php echo $fetch_menu['Name_Product'] ?>?</h3>
                                <div class="Choose">
                                    <input type="submit" class="Yes" value="Yes" name="YES">
                                    <input class="No" type="button" value="No" name="NO" onclick="disappear('ask_wrap<?php echo $save?>')">
                                </div>
                                </div>
                            </div>
                            </div>

                            <div class="Wrap_box_edit" id="BOX_EDIT<?php echo $save?>">
                                <div class="Wrap_edit">
                                    <div class="box_EDIT">
                                        <h3 class="Head_edit">Edit</h3>
                                        <label class="label_name" for="Name_Pro">Name</label>
                                        <br>
                                        <input value="<?php echo $fetch_menu['Name_Product'] ?>" class="Nam" type="text" name="Nam_Pro" placeholder="Name" id="Name_Pro" required>
                                        <br>
                                        <br>
                                        <label class="Price_label" for="Pri_Pro">Price</label>
                                        <br>
                                        <input value="<?php echo $fetch_menu['Price_Product']/1000 ?>" class="Pri" type="number" name="Pri_Pro" placeholder="Price" id="Pri_Pro" required>
                                        <a class="DONVI_EDIT">.000đ</a>
                                        <br>
                                        <br>
                                        <select name="Choose_cate_EDIT" class="SELECT_EDIT">
                                            <option value="Drinks" <?php if($fetch_menu['categories'] == 'Drinks'){ echo 'selected';}else{ echo ''; }?>>Drink</option>
                                            <option value="Foods" <?php if($fetch_menu['categories'] == 'Foods'){echo'selected';}else{ echo''; } ?>>Food</option>
                                        </select>
                                        <br>
                                        <br>
                                        <div class="choose_IMG_EDI">
                                            <input type="file" class="file_EDIT" id="IMG_EDI" name="IMG_CHOOSE">
                                        </div>
                                        <br>
                                        <div class="EDIT_GROUP_BUT">
                                            <input type="submit" name="EDIT_BUT" class="EDIT_but" value="Update">
                                            <input type="button"
                                            class="CANCEL_EDIT" name="Cancel_EDIT"
                                            value="Cancel" onclick="disappear('BOX_EDIT<?php echo $save?>')">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <td class="table_data"><input class="edit_menu" type="button" name="EDIT_MENU" value="EDIT" onclick="appear('BOX_EDIT<?php echo $save?>')"><br><br>
                            <input class="del_menu" type="button" value="Delete" name="DELETE" onclick="appear('ask_wrap<?php echo $save?>')"><br><br>
                            <?php if($fetch_menu['product_status'] == 'In Stock'){?><input class="Out_stock" type="submit" value="Out of stock" name="OOS"><?php }elseif($fetch_menu['product_status'] == 'Out Of Stock'){?><input class="In_stock" type="submit" value="In stock" name="IS"><?php } ?></td>
                        </form>
                        </tr>
                        <?php
                        $save = $save+1;
                    }
                    ?>
                    </table>
                    <?php
                }else{
                    ?><div class="wrap_noft"><p class="noft"><?php echo 'No Menu here!' ?></p></div><?php
                }
            ?>
        </div>
    </div>

    <div class="But_gr">
        <button class="Edit_Menu" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/Menu.php'" title="Go to Add menu page"></button>
        <a class="text_edit">Add menu</a>
        <br>
        <button class="home_but" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/AdminPage.php'" title="Back to Admin home"></button>
        <a class="text">Home Admin</a>
    </div>
    <script type="text/javascript">
        function appear(save) {
            const element = document.getElementById(save);
            element.style.display="flex";
            element.style.transition="0.75s";
        };
        function disappear(save) {
            const element = document.getElementById(save);
            element.style.display="none";
            element.style.transition="0.75s";
        };
    </script>
</body>
</html>





















































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->