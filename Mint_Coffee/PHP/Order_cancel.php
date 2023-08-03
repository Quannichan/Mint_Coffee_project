  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include 'config.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: /Mint_Coffee/PHP/Login.php");
    }
    if(isset($_SESSION['user_id'])){
        $UID = $_SESSION['user_id'];
        $select_count = mysqli_query($conn,"SELECT SUM(quantity) as Count  FROM mint_coffee.cuscart WHERE User_ID = $UID;") or die("Cannot count");
        if(mysqli_num_rows($select_count) > 0){
            $Count_row = mysqli_fetch_assoc($select_count);
            if($Count_row['Count'] > 0 && $Count_row['Count'] < 100){
                $_SESSION['count'] = $Count_row['Count'];
            }elseif($Count_row['Count'] == 0){
                $_SESSION['count'] = 0 ;
            }else{
                $_SESSION['count'] = '+99' ;
            }
        }else{
            $_SESSION['count'] = 0;
        }
    }else{
        $_SESSION['count'] = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Delivery.css" type="text/css">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Mint Coffee | Order Cancel</title>
</head>
<body>
<div class="menu_bar">  
        <a class="logo" href="/Mint_Coffee/Index.html"><img src="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 140043.png" width="200" height="60"/></a>
        <ul>
        <li><a class="BAG" href="/Mint_Coffee/PHP/cart.php"><img class="bag" src="/Mint_Coffee/Images/shopping-cart.png" style="vertical-align: center;"  width="30" height="30"/><span class="COUNT"><?php echo $_SESSION['count'] ?></span></a></li>
            <li><a href="#"><img src="/Mint_Coffee/Images/menu.png" class="menu" width="30" height="30"></a>
                <div class="menudown">
                    <ul>
                        <li><a href="/Mint_Coffee/Index.html"><img src="/Mint_Coffee/Images/home.png" width="20" height="20" style="vertical-align: center">&nbsp&nbsp&nbspHome</a></li>
                        <li><a href="/Mint_Coffee/PHP/Account.php"><img src="/Mint_Coffee/Images/account.png" width="20" height="20" style="vertical-align: center">&nbsp&nbsp&nbspAccount</a></li>
                        <li><a href="#"><img src="/Mint_Coffee/Images/left-arrow.png" width="15" height="15" style="vertical-align: center">&nbsp&nbsp&nbspOrder</a>
                            <div class="drop_down_menu">
                                <ul>
                                    <li><a href="/Mint_Coffee/PHP/Deliver.php" ><img src="/Mint_Coffee/Images/order_box.png" width="20" height="20" style="vertical-align: center;">&nbsp&nbspYour<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsporder</a></li>
                                    <li><a href="/Mint_Coffee/PHP/Order_History.php" ><img src="/Mint_Coffee/Images/file.png" width="20" height="20" style="vertical-align: center;">&nbsp&nbspOrder<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsphistory</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="/Mint_Coffee/PHP/Shop.php"><img src="/Mint_Coffee/Images/shopping-bag.png" width="20" height="20" style="vertical-align: center;">&nbsp&nbsp&nbspShop</a></li>
                            <li><a href="#"><img src = "/Mint_Coffee/Images/left-arrow.png" style='vertical-align: center' width="15" height="15" class="icon_left"/>&nbsp&nbspAbout<i></i></a>
                                <div class="drop_down_menu">
                                    <ul>
                                        <li><a href="https://www.facebook.com/NFS2019/" target="_blank"><img src="/Mint_Coffee/Images/facebook.png" width="20" height="20" style="vertical-align: center;">&nbsp&nbspFacebook</a></li>
                                        <li><a href="https://www.youtube.com/@quantranminh3655/featured" target="_blank"><img src="/Mint_Coffee/Images/youtube.png" width="20" height="20" style="vertical-align: center;">&nbsp&nbspYoutube</a></li>
                                        <li><a href="/Mint_Coffee/HTML/file/About.html"><img src="/Mint_Coffee/Images/script.png" width="25" height="25" style="vertical-align: center;">&nbspOur<br>&nbsp&nbsp&nbsp&nbsp&nbspstories</a></li>
                                    </ul>
                                </div>
                            </li>
                        <li><a href="/Mint_Coffee/HTML/file/Contact.html"><img src="/Mint_Coffee/Images/contact-mail.png" width="25" height="25" style=" vertical-align: center;">&nbsp&nbspContact</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <?php
        if(isset($Message)){
            foreach($Message as $Message){
                echo '<div class= "message" onclick="this.remove();" style="color:white;position: fixed;top: 0;left: 0;right: 0;padding: 15px 10px;backdrop-filter: blur(50px);text-align: center;z-index: 1000;background-color:black;border-style: solid;border-color: black;opacity: 1;}">'.$Message.'</div>';
            }
        }
    ?>
<br><br><br><br><br>
<h2 class="header_cart">Order Cancel</h2>
<div class="change_His">
    <a class="link_to_His" href="/Mint_Coffee/PHP/Order_History.php"><img src="/Mint_Coffee/Images/up-arrow.png" width="7%" class="arrow"/>&nbspOrder History</a>
</div>
    <div class="products">
    <div class="box-container">
        <?php
        $uid = $_SESSION['user_id'];
            $select_product = mysqli_query($conn,"SELECT * FROM Mint_Coffee.OrderCancel WHERE User_ID = '$uid'")or die("Cannot get order");
            if(mysqli_num_rows($select_product) > 0){
            ?>
            <table class="box">
            <tr class="header">
                <th class="Table_header">Order list</th>
                <th class="Table_header">Note</th>
                <th class="Table_header">Price</th>
                <th class="Table_header">Status</th>
                <th class="Table_header">Time Cancel</th>
            </tr>
            <?php
                while($fetch_product = mysqli_fetch_assoc($select_product)){
        ?><tr class="table_body">
                    <td class="Table_data"><?php echo $fetch_product['Name_Order'];?></td>
                    <td class="Table_data"><p class="NOTEE"><?php echo $fetch_product['Note'];?></p></td>
                    <td class="Table_data"><?php echo $fetch_product['Price'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['Statuss'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['Time_cancel'];?></td>
            <tr>
        <?php
                }
                ?>
                </table>
                <?php
            }else{
                ?><div class="wrap_noft"><p class="noft"><?php echo 'Nothing on here' ?></p></div><?php
            }
        ?>
    </div>
</div>
<br><br><br>
    <div class="footer">
    <div class="logo1">
        <img src="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 140043.png" width="50%" class="img3"/>
    </div>
    <div class="info1">
        <h3 class="head">CONTACT INFORMATION</h3><br>
        <p class="text1">
            <b>Phone number 1:</b> <a href="tel:0886523224" class="phone1">&nbsp0886523224</a><br>
            <b>Phone number 2:</b> <a href="tel:0797214106" class="phone1">&nbsp0797214106</a><br>
            <b>Email 1:</b> <a href="mailto:quantm.22ns@vku.udn.vn" class="phone1">&nbspquantm.22ns@vku.udn.vn</a><br>
            <b>Email 2:</b> <a href="mailto:phuctth.22ns@vku.udn.vn" class="phone1">&nbspphuctth.22ns@vku.udn.vn</a><br><br>
        </p>
        <h3 class="head">LOCATION</h3><br>
        <p class="text1">
        <b>Address: </b> <a href="https://goo.gl/maps/udULoy7aCKsvKXGf9" class="phone1" target="_blank">&nbsp470 Trần Đại Nghĩa </a><br><br>
        </p>
        <h3 class="head">HOUR</h3><br>
            <p class="text1">
                <b>Monday-Friday:</b>&nbsp7:30am - 10pm<br>
                <b>Saturday-Sunday:</b>&nbsp7am - 10:30pm<br>
            </p>
    </div>
    <div class="info2">
        <p><ins><a href="/Mint_Coffee/Index.html" class="link">Home</a><br>
            <a href="/Mint_Coffee/HTML/file/About.html" class="link">About us</a><br>
            <a href="/Mint_Coffee/HTML/file/Contact.html" class="link">Contact</a></ins>
        </p>
    </div>
</div>
</body>
</html>



























































































































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->