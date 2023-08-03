  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include 'config.php';
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    if(!isset($_SESSION['ORDER_SAVE'])){ 
        header("Location: /Mint_Coffee/PHP/cart.php");
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
    if(!isset($_SESSION['user_id'])){
        header("Location: /Mint_Coffee/PHP/Login.php");
    }
    if(isset($_POST['ORDER_NOW'])){
        $USERID = $_SESSION['user_id'];
        $Phone = $_SESSION['phone_num'];
        $Del = $_SESSION['ORDER_SAVE']; 
        foreach($Del as $del){
            mysqli_query($conn,"DELETE FROM Mint_Coffee.Cuscart where ID_Cart = $del AND  User_ID = '$USERID'")or die("Cannot delete product");
        }
        $ORDER_ARRAY = $_POST['OR_INF'];
        $ORname_ARRAY = $_POST['OR_NAME'];
        $ORquan_ARRAY = $_POST['OR_QUAN'];
        $ORprice_ARRAY = $_POST['OR_PRICE'];
        $SAVE_ORDER = implode(' <br> ',$ORDER_ARRAY);
        $address = $_POST['ADDR'];
        $note = $_POST['NOTE'];
        $price_order = $_SESSION['PRICE_ORDER_SAVE'];
        $US_name = $_SESSION['user_name'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $CR_DATE = date('H:i d/m/y');
        mysqli_query($conn," INSERT INTO Mint_Coffee.Orderr (User_ID,US_Name,US_phone,Address,Note,Name_order,Price_order,Statuss,Time_Order) VALUES ('$USERID','$US_name','$Phone','$address','$note','$SAVE_ORDER','$price_order','Ready','$CR_DATE')")or die("Cannot order");
        $_SESSION['PRICE_ORDER_SAVE'] = 0;
        $Select_Or = mysqli_query($conn," SELECT * FROM Mint_Coffee.Orderr WHERE User_ID = $USERID AND Name_order = '$SAVE_ORDER' AND Time_Order = '$CR_DATE' ");
        if(mysqli_num_rows($Select_Or)>0){
            $Select_ID = mysqli_fetch_assoc($Select_Or);
            $Select_ID_OR = $Select_ID['Order_ID'];
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $Date_or = date('Y-m');
            $j = 0;
            $k = 0;
            for ($i = 0; $i < count($ORname_ARRAY); $i++) {
                $bol2 = true;
                while($bol2 == true){
                $bol = true;
                while ($bol == true) {
                    mysqli_query($conn,"INSERT INTO Mint_Coffee.product_sell (ID_cart,product_name,product_quantity,product_price,date_product) VALUES ($Select_ID_OR,'$ORname_ARRAY[$i]','$ORquan_ARRAY[$j]','$ORprice_ARRAY[$k]','$Date_or')");
                    $j = $j + 1;
                    $bol = false;
                }
                $k = $k + 1;
                $bol2 = false;
            }
            }
            $Message[] = 'Order success!';
            header("Refresh:1; url=/Mint_Coffee/PHP/Deliver.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Order.css" type="text/css">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Mint Coffee | Order</title>
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
<h2 class="header_cart">Order</h2>
    <div class="products">
    <div class="box-container">
        <form class="Pay" method="POST" >
        <?php
        $uid = $_SESSION['user_id'];
        if(isset($_SESSION['ORDER_SAVE'])){
        $order = $_SESSION['ORDER_SAVE'];
            foreach($order as $OrNum){
            $select_product = mysqli_query($conn,"SELECT * FROM Mint_Coffee.Cuscart where ID_Cart = $OrNum AND  User_ID = '$uid'")or die("Cannot get product");
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
        ?>
            <div class="box">
                <img src="<?php echo $fetch_product['Image_Pro']; ?>">
                <div class="Product_inf">
                <div class="name_product"><?php echo $fetch_product['Name_pro']; ?></div>
                <div class="price"><?php echo $fetch_product['Price']; ?></div>
                <div class="quantt">Quantity: <?php echo $fetch_product['quantity']; ?></div>
                </div>
                <input type="hidden" name="OR_INF[]" value="<?php echo $fetch_product['Name_pro']; ?>: <?php echo $fetch_product['quantity']; ?>">
                <input type="hidden" name="OR_NAME[]" value="<?php echo $fetch_product['Name_pro']; ?>">
                <input type="hidden" name="OR_QUAN[]" value="<?php echo $fetch_product['quantity']; ?>">
                <input type="hidden" name="OR_PRICE[]" value="<?php echo $fetch_product['Price_pro']; ?>">
            </div>
            <br>
        <?php
                }
            }
        }
    }else{
        ?><div class="wrap_noft"><p class="noft"><?php echo 'Nothing here, go to cart!' ?></p></div><?php
    }
        ?>
        <div class="NOTE_OR">
            <h3 class="NO_TE">Note</h3>
            <input type="text" placeholder="Your Address" class="Addr" name="ADDR" required><br><br>
            <textarea type="text" placeholder="Note for us!" name="NOTE" class="Note"></textarea>
            <br>
            <p class ="price">Total: <?php echo $_SESSION['PRICE_ORDER_SAVE'];?> VNĐ</p>
            <br><br>
            <input type = "submit" class="Order" value="Order Now!" name="ORDER_NOW">
        </div>
        </form>
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