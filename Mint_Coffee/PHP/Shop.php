  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include 'config.php';
    session_start();
    $_SESSION['MENU_SAVE'] = '';
    $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product ORDER BY Name_Product ")or die("Cannot get product");
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

    if(isset($_POST['add_to_cart'])){
        if(isset($_SESSION['user_id'])){
        $Pro_id = $_POST['product_id'];
        $userID = $_SESSION['user_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $PRICE = $_POST['PRICE'];
        $product_image = $_POST['product_image'];
        $product_quanti = $_POST['product_quantity'];
        $select_cart = mysqli_query($conn,"SELECT * FROM Mint_Coffee.Cuscart WHERE Name_pro = '$product_name' AND User_ID = $userID ") or die("Cannot add to cart");
        if(mysqli_num_rows($select_cart) > 0){
            $rowdata = mysqli_fetch_assoc($select_cart);
            $price = $rowdata['Price_pro'];
            $quan = $rowdata['quantity'];
            $price = $price + $product_price;
            $quan = $quan + $product_quanti;
            mysqli_query($conn, "UPDATE Mint_Coffee.Cuscart set quantity = $quan, Price_pro = $price WHERE Name_pro = '$product_name' AND User_ID = '$userID'") or die("Cannot add");
            $Message[] = 'Add quantity!';
            header('refresh: 1');
        }else{
            mysqli_query($conn, "INSERT INTO Mint_Coffee.Cuscart(User_ID,Product_ID,Name_pro,Price_pro,Price,Image_Pro,quantity,STA) VALUES ($userID,'$Pro_id','$product_name',$product_price,'$PRICE','$product_image',$product_quanti,'In Stock') ") or die("Cannot add");
            $Message[] = 'Add to cart success!';
            header('refresh: 1');
        }
    }else{
        header("Location: /Mint_Coffee/PHP/Login.php");
    }
    }
?>
<?php 
    if(isset($_POST['RELOAD'])){
        if(isset($_SESSION['user_id'])){
        if($_POST['CHOOSE'] == "All" && isset($_POST['FIND'])==FALSE){
            $_SESSION['MENU_SAVE'] = '';
            $_SESSION['all'] = "Selected";
            $_SESSION['drink'] = "";
            $_SESSION['food'] = "";
            $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product")or die("Cannot get product");
        }elseif($_POST['CHOOSE'] == "All" && isset($_POST['FIND'])==TRUE){  
            $_SESSION['MENU_SAVE'] = $_POST['FIND'];
            $_SESSION['all'] = "Selected";
            $_SESSION['drink'] = "";
            $_SESSION['food'] = "";
            $name= $_POST['FIND'];
            $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product where Name_Product LIKE '%$name%' ")or die("Cannot get product");
        }elseif($_POST['CHOOSE'] == "Drinks"&& isset($_POST['FIND'])==FALSE){
            $_SESSION['MENU_SAVE'] = '';
            $_SESSION['drink'] = "Selected";
            $_SESSION['food'] = "";
            $_SESSION['all'] = "";
            $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product where categories='Drinks' ")or die("Cannot get product");
        }elseif($_POST['CHOOSE'] == "Drinks"&& isset($_POST['FIND'])==TRUE){
            $_SESSION['MENU_SAVE'] = $_POST['FIND'];
            $_SESSION['drink'] = "Selected";
            $_SESSION['food'] = "";
            $_SESSION['all'] = "";
            $name= $_POST['FIND'];
            $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product WHERE Name_Product LIKE '%$name%' AND categories='Drinks' ")or die("Cannot get product");
        }elseif($_POST['CHOOSE'] == "Foods" && isset($_POST['FIND']) == FALSE){
            $_SESSION['MENU_SAVE'] = '';
            $_SESSION['drink'] = "";
            $_SESSION['food'] = "Selected";
            $_SESSION['all'] = "";
            $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product where  categories='Foods' ")or die("Cannot get product");
        }elseif($_POST['CHOOSE'] == "Foods" && isset($_POST['FIND']) == TRUE){
            $_SESSION['MENU_SAVE'] = $_POST['FIND'];
            $_SESSION['drink'] = "";
            $_SESSION['food'] = "Selected";
            $_SESSION['all'] = "";
            $name= $_POST['FIND'];
            $_SESSION['select_product'] = mysqli_query($conn,"SELECT * FROM mint_coffee.product WHERE Name_Product LIKE '%$name%' AND categories='Foods' ")or die("Cannot get product");
        }
    }else{
        header("Location: /Mint_Coffee/PHP/Login.php");
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/Mint_Coffee/Images/Ảnh chụp màn hình 2023-03-26 145212.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width , initial-scale=1"/>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="/Mint_Coffee/CSS/Shop.css" type="text/css"/>
    <title>Mint Coffee | Shop</title>
</style>
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
<br><br><br><br><br>
<?php
        if(isset($Message)){
            foreach($Message as $Message){
                echo '<div class= "message" onclick="this.remove();" style="color:white;position: fixed;top: 0;left: 0;right: 0;padding: 15px 10px;backdrop-filter: blur(50px);text-align: center;z-index: 1000;background-color:black;border-style: solid;border-color: black;opacity: 1;}">'.$Message.'</div>';
            }
        }
    ?>
<h2 class="head_poduct">Welcome to our shop!</h2>
<div class="categories">
    <form method="post" action="">
        <div class="Search_text">
            <input type="text" placeholder=" Find something" class="find" name="FIND" id="Find" maxlength="100" value="<?php echo $_SESSION['MENU_SAVE']?>">
        </div>
        <div class="Choose">
            <select class="menu_choose" name="CHOOSE">
                <option value="All"<?php 
                if(isset($_SESSION['user_id'])){echo $_SESSION['all'];}else{echo 'Selected';};?>>All</option>
                <option value="Drinks"<?php 
                if(isset($_SESSION['user_id'])){echo $_SESSION['drink'];}else{echo '';};?>>Drinks</option>
                <option value="Foods"<?php 
                if(isset($_SESSION['user_id'])){echo $_SESSION['food'];}else{echo '';};?>>Foods</option>
            </select>
        </div><br>
        <div class="Search_but">
            <button class="reload" name="RELOAD">Search</button>
        </div>
    </form>
</div>
<div class="products">
    <div class="box-container">
        <?php
        if(isset($_SESSION['user_id']) == FALSE){
            $select_product = mysqli_query($conn,"SELECT * FROM mint_coffee.product")or die("Cannot get product");
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
        ?>
            <form method="post" class="box" title="Name: <?php echo $fetch_product['Name_Product']; ?> || price: <?php echo $fetch_product['price'];  ?>">
                <img src="<?php echo $fetch_product['Image_Product']; ?>">
                <div class="name_product"><?php echo $fetch_product['Name_Product']; ?></div>
                <div class="price"><?php echo $fetch_product['price']; ?></div>
                <div class="STA"><?php echo $fetch_product['product_status']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_product['ID_product']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['Image_Product']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['Name_Product']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['Price_Product']; ?>">
                <input type="number" name="product_quantity" value="1" readonly style="opacity:0; cursor:none"><br>
                <?php if($fetch_product['product_status'] == 'In Stock'){?><input type="submit" value="Add to cart" name="add_to_cart" class="ADD" title="Add me pleaseeeeeeee!!!!"> <?php }elseif($fetch_product['product_status'] == 'Out Of Stock'){?><input disabled type="submit" value="Add to cart" name="add_to_cart" class="ADD" title="Sorry, this menu is out of stock :<"> <?php } ?>
            </form>
        <?php
                }
            }else{
                ?><div class="wrap_noft"><p class="noft"><?php echo 'No result!' ?></p></div><?php
            }
        }elseif(isset($_SESSION['user_id'])==TRUE){
            if(mysqli_num_rows($_SESSION['select_product']) > 0){
                while($fetch_product1 = mysqli_fetch_assoc($_SESSION['select_product'])){
        ?>
            <form method="post" class="box">
                <img src="<?php echo $fetch_product1['Image_Product']; ?>">
                <div class="name_product"><?php echo $fetch_product1['Name_Product']; ?></div>
                <div class="price"><?php echo $fetch_product1['price']; ?></div>
                <div class="STA"><?php echo $fetch_product1['product_status']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_product1['ID_product']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product1['Image_Product']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product1['Name_Product']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product1['Price_Product']; ?>">
                <input type="hidden" name="PRICE" value="<?php echo $fetch_product1['price']; ?>">
                <input type="number" name="product_quantity" value="1" readonly style="opacity:0; cursor:default"><br>
                <?php if($fetch_product1['product_status'] == 'In Stock'){?><input type="submit" value="Add to cart" name="add_to_cart" class="ADD" title="Add me pleaseeeeeeee!!!!"> <?php }elseif($fetch_product1['product_status'] == 'Out Of Stock'){?><input disabled type="submit" value="Add to cart" name="add_to_cart" class="ADD" title="Sorry, this menu is out of stock :<"> <?php } ?>
            </form>
        <?php
                }
            }else{
                ?><div class="wrap_noft"><p class="noft"><?php echo 'No result!' ?></p></div><?php
            }
        }
        ?>
    </div>
</div>

<br><br><br><br><br>
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