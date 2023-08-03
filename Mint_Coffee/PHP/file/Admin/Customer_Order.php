  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include("../../config.php");
    session_start();
    if(isset($_SESSION['PN_A'])==TRUE && isset($_SESSION['P_A']) == TRUE){
        header('refresh:2');
    }else{
        header("Location:/Mint_Coffee/PHP/Login.php");
    }
    if(isset($_POST['CANCEL'])){
        $Or_ID = $_POST['OR_ID'];
        $User_ID = $_POST['U_ID'];
        $Name_or = $_POST['Name_OR'];
        $NOTE = $_POST['note'];
        $Price = $_POST['PRICE'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $RE_TIME = date('H:i d/m/y');
        mysqli_query($conn,"INSERT INTO Mint_Coffee.OrderCancel(Or_id,User_id,Name_Order,Note,Statuss,Price,Time_cancel) VALUES ('$Or_ID','$User_ID','$Name_or','$NOTE','Canceled','$Price','Cancel time: $RE_TIME ');") or die("cannot cancel");
        mysqli_query($conn,"DELETE FROM Mint_Coffee.product_sell WHERE ID_cart = '$Or_ID'");
        mysqli_query($conn,"DELETE FROM mint_coffee.Orderr WHERE User_ID = $User_ID AND Order_ID = '$Or_ID' ;") or die("Cannot Cancel");
    }elseif(isset($_POST['Acpt'])){
        $OR_ID = $_POST['OR_ID'];
        $USER_ID = $_POST['U_ID'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $RE_TIME = date('H:i d/m/y');
        mysqli_query($conn,"UPDATE Mint_Coffee.Orderr SET Time_Acpt = '$RE_TIME' , Statuss = 'In Progress' WHERE Order_ID = $OR_ID AND User_ID = $USER_ID ") or die("Cannot accept the order");
    }elseif(isset($_POST['DELIVERY'])){
        $OR_ID = $_POST['OR_ID'];
        $USER_ID = $_POST['U_ID'];
        mysqli_query($conn,"UPDATE Mint_Coffee.Orderr SET Statuss = 'Delivery' WHERE Order_ID = $OR_ID AND User_ID = $USER_ID ") or die("Cannot accept the order");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Cus_or.css" type="text/css">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Admin Page | Customer order</title>
</head>
<body>
<br><br><br>
<h2 class="header_cart">Customer Order</h2>
    <div class="products">
    <div class="box-container">
        <?php
            $GetData = mysqli_query($conn,"SELECT * FROM Mint_Coffee.Orderr");
            if(mysqli_num_rows($GetData) > 0){
            ?>
            <table class="box">
            <tr class="header">
                <th class="Table_header">Time Order</th>
                <th class="Table_header">Phone number</th>
                <th class="Table_header">Address</th>
                <th class="Table_header">Order</th>
                <th class="Table_header">Note</th>
                <th class="Table_header">Price</th>
                <th class="Table_header_option">Option</th>
            </tr>
            <?php
                while($fetch_product = mysqli_fetch_assoc($GetData)){
        ?><tr class="table_body">
            <form method="POST">
                    <td class="Table_data"><?php echo $fetch_product['Time_Order'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['US_phone'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['Address'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['Name_order'];?></td>
                    <td class="Table_data"><p class="NOTE"><?php echo $fetch_product['Note'];?></p></td>
                    <td class="Table_data"><a style="color:red;"><?php echo $fetch_product['Price_order'];?></a> VNĐ</td>
                    <input type="hidden" name="OR_ID" value=" <?php echo $fetch_product['Order_ID'] ?>">
                    <input type="hidden" name="U_ID" value="<?php echo $fetch_product['User_ID'] ?>">
                    <input type="hidden" name="Name_OR" value="<?php echo $fetch_product['Name_order'] ?>">
                    <input type="hidden" name="note" value="<?php echo $fetch_product['Note'] ?>">
                    <input type="hidden" name="STAT" value="<?php echo $fetch_product['Statuss'] ?>">
                    <input type="hidden" name="PRICE" value="<?php echo $fetch_product['Price_order'] ?>">
                    <td class="Table_data_option"><?php if($fetch_product['Statuss'] == 'Ready'){ ?><input type="submit" class="cancel_or" name="CANCEL" value="Cancel"><br><br><input type="submit" name="Acpt" value="Accept" class="acpt_or"/> <?php }elseif($fetch_product['Statuss'] == 'In Progress'){ ?> <input class="acpt_or" name="DELIVERY" value="Delivery" type="submit"> <?php }elseif($fetch_product['Statuss'] = 'Delivery'){ ?><a style="font-size:20px;color:red ;">Delivery</a><?php } ?></td>
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