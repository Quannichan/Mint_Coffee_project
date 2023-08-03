  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include("../../config.php");
    session_start();
    $_SESSION['name_cus'] = '';
    $_SESSION['phone_cus'] = '';
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $date = date("m/y");
    $_SESSION['SEARCH_INFO'] =  mysqli_query($conn,"SELECT * FROM Mint_Coffee.Acc ")or die("Cannot get Information");
    if(isset($_SESSION['PN_A'])==TRUE && isset($_SESSION['P_A']) == TRUE){
    }else{
        header("Location:/Mint_Coffee/PHP/Login.php");
    }
    if(isset($_POST['FIND'])){
        if(isset($_POST['NAME']) && isset($_POST['Phone_Number'])){
            $_SESSION['name_cus'] = $_POST['NAME'];
            $_SESSION['phone_cus'] = $_POST['Phone_Number'];
            $name_cus = $_POST['NAME'];
            $Phone_cus = $_POST['Phone_Number'];
            $_SESSION['SEARCH_INFO'] =  mysqli_query($conn,"SELECT * FROM Mint_Coffee.Acc where User_Name LIKE '%$name_cus%' AND  Phone_Number LIKE '%$Phone_cus%' ")or die("Cannot get Information");
        }else{
            $_SESSION['SEARCH_INFO'] =  mysqli_query($conn,"SELECT * FROM Mint_Coffee.Acc ")or die("Cannot get Information");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Cus_List.css" type="text/css">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Admin Page | Customer information</title>
</head>
<body>
<br><br><br>
<h2 class="header_cart">Customer information</h2>
<div class="wrap_find">
    <form class="FIND_FORM" method="POST">
        <input type="text" name="NAME" class="name" placeholder="Name" value="<?php echo $_SESSION['name_cus']  ?>"><br><br>
        <input type="text" name="Phone_Number" class="phone" placeholder="Phone number" value="<?php echo $_SESSION['phone_cus']  ?>"><br><br>
        <input type="submit" name="FIND" value="Find" class="find_but">
    </form>
</div>
    <div class="products">
    <div class="box-container">
        <?php
            if(mysqli_num_rows($_SESSION['SEARCH_INFO']) > 0){
            ?>
            <table class="box">
            <tr class="header">
                <th class="Table_header">User ID</th>
                <th class="Table_header">User name</th>
                <th class="Table_header">Phone number</th>             
            </tr>
            <?php
                while($fetch_product = mysqli_fetch_assoc($_SESSION['SEARCH_INFO'])){
        ?><tr class="table_body">
            <form method="POST" >
                    <td class="Table_data"><?php echo $fetch_product['ID'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['User_Name'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['Phone_Number'];?></td>
            </form>
            <tr>
        <?php
                }
                ?>
                </table>
                <?php
            }else{
                ?><div class="wrap_noft"><p class="noft"><?php echo 'Nothing here !' ?></p></div><?php
            }
        ?>
    </div>
</div>
<div class="But_gr">
        <button class="home_but" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/AdminPage.php'" title="Back to Admin home"></button>
        <a class="text">Home Admin</a>
    </div>
</body>
</html>







































































































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->