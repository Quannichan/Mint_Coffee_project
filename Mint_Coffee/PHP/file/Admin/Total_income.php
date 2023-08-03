  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include("../../config.php");
    session_start();
    $_SESSION['name_menu_save'] = '';
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $_SESSION['date_choose'] = date("Y-m");
    $date_query = $_SESSION['date_choose'];
    $_SESSION['SEARCH_MENU_INFO'] =  mysqli_query($conn,"SELECT product_name, SUM(product_quantity) as 'Quantity', SUM(product_price) as 'Total' from Mint_Coffee.product_sell where date_product = '$date_query' group by product_name;")or die("Cannot get Information");
    if(isset($_SESSION['PN_A'])==TRUE && isset($_SESSION['P_A']) == TRUE){
    }else{
        header("Location:/Mint_Coffee/PHP/Login.php");
    }
    if(isset($_POST['FIND'])){
        if(isset($_POST['NAME'])){
            $_SESSION['name_menu_save'] = $_POST['NAME'];
            $name_cus = $_POST['NAME'];
            $year = $_POST['MONTH'][0].$_POST['MONTH'][1].$_POST['MONTH'][2].$_POST['MONTH'][3];
            $day = $_POST['MONTH'][5].$_POST['MONTH'][6];
            $_SESSION['date_choose'] = $year.'-'.$day;
            $date_query =  $year.'-'.$day;
            $_SESSION['SEARCH_MENU_INFO'] =  mysqli_query($conn,"SELECT product_name, SUM(product_quantity) as 'Quantity', SUM(product_price) as 'Total' from Mint_Coffee.product_sell where product_name LIKE '%$name_cus%' AND date_product = '$date_query' group by product_name;")or die("Cannot get Information");
        }else{
            $_SESSION['name_menu_save'] = '';
            $year = $_POST['MONTH'][0].$_POST['MONTH'][1].$_POST['MONTH'][2].$_POST['MONTH'][3];
            $day = $_POST['MONTH'][5].$_POST['MONTH'][6];
            $_SESSION['date_choose'] = $year.'-'.$day;
            $date_query =  $year.'-'.$day;
            $_SESSION['SEARCH_MENU_INFO'] =  mysqli_query($conn,"SELECT product_name, SUM(product_quantity) as 'Quantity', SUM(product_price) as 'Total' from Mint_Coffee.product_sell where date_product = '$date_query' group by product_name;")or die("Cannot get Information");
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
    <title>Admin Page | Total Income</title>
</head>
<body>
<br><br><br>
<h2 class="header_cart">Total menu sold month</h2>
<div class="wrap_find">
    <form class="FIND_FORM" method="POST">
        <input type="text" name="NAME" class="name" placeholder="Name menu" value="<?php echo $_SESSION['name_menu_save'] ?>"><br><br>
        <input type="month" name="MONTH" class="month_choose" required value="<?php echo $_SESSION['date_choose'] ?>"><br><br>
        <input type="submit" name="FIND" value="Find" class="find_but">
    </form>
</div>
    <div class="products">
    <div class="box-container">
        <?php
            if(mysqli_num_rows($_SESSION['SEARCH_MENU_INFO']) > 0){
            ?>
            <table class="box">
            <tr class="header">
                <th class="Table_header">Menu name</th>
                <th class="Table_header">Quantity<br>Sold</th>
                <th class="Table_header">Total<br>Price</th>                
            </tr>
            <?php
                while($fetch_product = mysqli_fetch_assoc($_SESSION['SEARCH_MENU_INFO'])){
        ?><tr class="table_body">
            <form method="POST">
                    <td class="Table_data"><?php echo $fetch_product['product_name'];?></td>
                    <td class="Table_data"><?php echo $fetch_product['Quantity'];?></td>
                    <td class="Table_data"><a style="color:red"><?php echo $fetch_product['Total'];?></a> VNĐ</td>
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
<div class="TOTAL_WRAP">
    <p class="Total">Total in <?php echo $_SESSION['date_choose']?>: <a class="INCOME"><?php $DATE = $_SESSION['date_choose']; $QUERY = mysqli_query($conn,"SELECT SUM(product_price) AS Total FROM  Mint_Coffee.product_sell WHERE date_product = '$DATE'");if(mysqli_num_rows($QUERY) > 0){$TOTAL = mysqli_fetch_assoc($QUERY); if($TOTAL['Total'] > 0){echo $TOTAL['Total'];}else{echo 0;}} ?></a> VNĐ</p>
</div>
<div class="But_gr">
        <button class="home_but" onclick="window.location.href='/Mint_Coffee/PHP/file/Admin/AdminPage.php'" title="Back to Admin home"></button>
        <a class="text">Home Admin</a>
</div>
<br><br><br><br><br>
</body>
</html>







































































































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->