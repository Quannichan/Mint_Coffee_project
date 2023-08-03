  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
    include 'config.php';
    session_start();
    $_SESSION['all'] = "true";
    $_SESSION['drink'] = "false";
    $_SESSION['food'] = "false";
    if(isset($_POST['SUB'])){
    $USN = mysqli_real_escape_string($conn, $_POST['USN']);
    $PN = mysqli_real_escape_string($conn, $_POST['P_NB']);
    $PASS = mysqli_real_escape_string($conn, md5($_POST['Pass']));
    $CPASS =  mysqli_real_escape_string($conn, md5($_POST['CPass']));

    if($PASS == $CPASS){
        $select = mysqli_query($conn, "SELECT * FROM Mint_Coffee.Acc WHERE Phone_Number = '$PN' AND Pass = '$PASS'") or die('Query failed');
        if(mysqli_num_rows($select) > 0){
            $Message[] = 'User already exist, please use orther information!';
        }else{
            mysqli_query($conn,"INSERT INTO Mint_Coffee.Acc (User_Name,Phone_Number,Pass)VALUES('$USN','$PN','$PASS')") or die('Sign in failed!');
            $Message[] = 'Sign in success, comeback to Log in page to log in! ';
        }
    }else{
        $Message[] = 'You must confirm correct your password!';
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
    <title>Mint Coffee | Login</title>
    <link rel="stylesheet" href="/Mint_Coffee/CSS/NewAcc.css" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <script src="https://unpkg.com/scrollreveal"></script>
</head>
<body>
    <?php
        if(isset($Message)){
            foreach($Message as $Message){
                echo '<div class= "message" onclick="this.remove();" style="color:white;position: absolute;top: 0;left: 0;right: 0;padding: 15px 10px;backdrop-filter: blur(50px);text-align: center;z-index: 1000;border-style: solid;border-color: black;opacity: 1;}">'.$Message.'</div>';
            }
        }
    ?>
    <div class="Login">
    <h2>Welcome</h2>
    <div class="log">
        <form method="POST">
        <div class="Name">
                <input  required type="text" class="User_name" placeholder="Your Name" name="USN" id="usn" maxlength="30"><br>
                <label for="usn" class="NA">Phone Number</label>
            </div>
            <div class="Phone">
                <input  required type="text" class="Phone_number" placeholder="Phone Number" name="P_NB" id="p_nb" maxlength="15" minlength="5" onkeypress="return restricAlphabets(event)"><br>
                <label for="p_nb" class="PNB">Phone Number</label>
            </div>
            <div class="PASS">
                <input required type="password" class="pass" placeholder="Password" name="Pass" id="p" maxlength="30" minlength="7"><br>
                <label for="p" class="P">Password</label>
            </div>
            <div class="CPASS">
                <input required type="password" class="cpass" placeholder="Confirm Password" name="CPass" id="cp" maxlength="30" minlength="7"><br>
                <label for="cp" class="CP">Confirm Password</label>
            </div>
            <div class="SHOW">
                <input type="checkbox" class="show" name="Showpass" id="sp" onclick="showpassword()"><label for="sp" class="SP">&nbspShow Password</label>
            </div>
            <div class="Sub">
                <input type="submit" class="sub_but" name="SUB" id="sub" value="Login">
            </div>
            <div class="tx">
                <p class="text">Already have account?<br><a href="/Mint_Coffee/PHP/Login.php" style="color:black;">Let's login!</a><br><a href="/Mint_Coffee/Index.html" style="color:black;">Back to home page</a></p>
            </div>
            <script>
                    function showpassword() {
                    var x = document.getElementById("p");
                    var y = document.getElementById("cp");
                    if (x.type === "password" && y.type ==="password") {
                        x.type = "text";
                        y.type = "text";
                    } else {
                        x.type = "password";
                        y.type = "password";
                    }
                    }
                </script>
        </form>
    </div>
    </div>
    <script src="/Mint_Coffee/Script/NewAcc.js"></script>
</body>
</html>




























































































































































































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->