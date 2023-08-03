  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include("../../config.php");
    session_start();
    if(isset($_SESSION['PN_A'])==TRUE && isset($_SESSION['P_A']) == TRUE){
    }else{
        header("Location:/Mint_Coffee/PHP/Login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Cus_mes.css" type="text/css">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Admin Page | Customers Messages</title>
</head>
<body>
<br><br><br>
<h2 class="header_cart">Customer messages</h2>
    <div class="products">
    <div class="box_container">
        <?php
            $GET_MES = mysqli_query($conn,"SELECT * FROM Mint_Coffee.submit_mes");
            if(mysqli_num_rows($GET_MES)>0){
                while($fetch_mes = mysqli_fetch_assoc($GET_MES)){
                    ?>
                        <div class="Mess_box">
                            <div class="tt_mes"><?php echo 'Title: '.$fetch_mes['title']?></div>
                            <div class="Name_cus"><?php echo 'Name: '.$fetch_mes['first_name'].' '.$fetch_mes['last_name'] ?></div>
                            <div class="phone_cus"><?php echo 'Phone number: '.$fetch_mes['phone_num'] ?></div>
                            <div class="Mes_cus"><?php echo $fetch_mes['mes'] ?></div>
                        </div>
                        <br>
                    <?php
                }
            }else{
                ?><div class="wrap_noft"><p class="noft"><?php echo 'Nothing here, go to cart!' ?></p></div><?php
            }
        ?>
    </div>
</div>
<div class="But_gr">
        <button class="home_but" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/AdminPage.php'" title="Back to Admin home"></button>
        <a class="text">Home Admin</a>
</div>
<br><br><br>
</body>
</html>







































































































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->