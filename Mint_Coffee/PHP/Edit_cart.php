  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include 'config.php';
    session_start();
    $_SESSION['all'] = "Selected";
    $_SESSION['drink'] = "";
    $_SESSION['food'] = "";
    $_SESSION['SEARCH_SAVE'] = "";
    $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product")or die("Cannot get product");
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

    if(isset($_POST['Delete'])){
        $Cart_ID = $_POST['Product_ID'];
        $USER_id = $_SESSION['user_id'];
        mysqli_query($conn,"DELETE FROM mint_coffee.cuscart WHERE User_ID = $USER_id AND ID_Cart = $Cart_ID;") or die("Cannot Delete");
        $Message[] = 'Delete success!';
        header('refresh: 1');
    }else{

    }

    if(isset($_POST['add'])){
        $quanAdd = $_POST['Product_q'];
        $proprice = $_POST['Product_price'];
        $proprice = $proprice + ($proprice/$quanAdd);
        $quanAdd = $quanAdd + 1;
        $Cart_ID = $_POST['Product_ID'];
        $USER_id = $_SESSION['user_id'];
        mysqli_query($conn,"UPDATE mint_coffee.cuscart SET quantity = $quanAdd ,Price_pro = $proprice  WHERE User_ID = $USER_id AND ID_Cart = $Cart_ID;") or die("Cannot Add");
        $Message[] = 'Add quantity!';
        header('refresh: 1');
    }else{

    }
    
    if(isset($_POST['minus'])){
            $quanMinus = $_POST['Product_q'];
            $Proprice = $_POST['Product_price'];
            $Proprice = $Proprice - ($Proprice/$quanMinus);
            $quanMinus = $quanMinus - 1;
        if($quanMinus == 0){
            $USER_id = $_SESSION['user_id'];
            $Cart_ID = $_POST['Product_ID'];
            mysqli_query($conn,"DELETE FROM mint_coffee.cuscart WHERE User_ID = $USER_id AND ID_Cart = $Cart_ID;") or die("Cannot Delete");
            $Message[] = 'Delete success!';
            header('refresh: 1');
        }else{
            $Cart_ID = $_POST['Product_ID'];
            $USER_id = $_SESSION['user_id'];
            mysqli_query($conn,"UPDATE mint_coffee.cuscart SET quantity = $quanMinus ,Price_pro = $Proprice  WHERE User_ID = $USER_id AND ID_Cart = $Cart_ID;") or die("Cannot Minus");
            $Message[] = 'Minus quantity!';
            header('refresh: 1');
        }
    }

    if(!isset($_SESSION['user_id'])){
        header("Location: /Mint_Coffee/PHP/Login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Edit_cart.css" type="text/css">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Mint Coffee | Edit Cart</title>
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
<h2 class="header_cart">Edit Your Cart</h2>
    <div class="products">
    <div class="box-container">
        <?php
        $uid = $_SESSION['user_id'];
            $select_product = mysqli_query($conn,"SELECT * FROM Mint_Coffee.Cuscart where User_ID = '$uid'")or die("Cannot get product");
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
        ?>
            <form method="post" class="box">
                <img src="<?php echo $fetch_product['Image_Pro']; ?>">
                <div class="Product_inf">
                <div class="name_product"><?php echo $fetch_product['Name_pro']; ?></div>
                <div class="price"><?php echo $fetch_product['Price']; ?></div>
                </div>
                <input type="hidden" name="Product_ID" value="<?php echo $fetch_product['ID_Cart']; ?>">
                <input type="hidden" name="Product_image" value="<?php echo $fetch_product['Image_Pro']; ?>">
                <input type="hidden" name="Product_name" value="<?php echo $fetch_product['Name_pro']; ?>">
                <input type="hidden" name="Product_price" value="<?php echo $fetch_product['Price_pro']; ?>">
                <input type="hidden" name="Product_q" value="<?php echo $fetch_product['quantity']; ?>">
                <div class="QTT">
                    <?php if($fetch_product['STA'] == 'In Stock'){?><input type="submit" name="add" value="+" class="plus">
                    <div class="Quanti"><?php echo $fetch_product['quantity']; ?></div>
                    <input type="submit" name="minus" value="-" class="decre"><?php }elseif($fetch_product['STA'] == 'Out Of Stock'){ ?><a style="color:red; font-size:18px">Out of stock</a><?php }?>
                </div>
                <div class="Edit_group">
                    <input type="submit" name="Delete" value="Delete" class="DELETE">
                </div>
            </form>
            <br>
        <?php
                }
            }else{
                ?><div class="wrap_noft"><p class="noft"><?php echo 'Nothing on cart, go to shop!' ?></p></div><?php
            }
        ?>
        <div class="Edit_Pro">
            <div class="ME_HE">
                <h3>Option</h3>
            </div>
        <button onclick="window.location.href='/Mint_Coffee/PHP/cart.php'" class="edit_pro">Done!</button>
        </div>
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