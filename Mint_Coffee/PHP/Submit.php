  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->

<?php
$FN = $_POST["FN"];
$LN = $_POST["LN"];
$PN = $_POST["PN"];
$TT = $_POST["TT"];
$MES = $_POST["MES"];

$host = "localhost";
$dbname = "Mint_Coffee";
$username = "root";
$password = "QuanG&C13082004";

$conn = mysqli_connect(hostname:$host,
                        username:$username,
                        password:$password,
                        database:$dbname);
$sql = "INSERT INTO Mint_Coffee.submit_mes 
        VALUES (?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);
if(! mysqli_stmt_prepare($stmt,$sql)){
    echo"Cannot send message!";
    die(mysqli_error($conn));  
}else{
mysqli_stmt_bind_param($stmt,"sssss",$FN,$LN,$PN,$TT,$MES);
mysqli_stmt_execute($stmt);
?><script>
alert ("Thank you for your message ^.^");
  </script>
<?php
mysqli_close($conn);
   header('refresh: 1; URL='."/Mint_Coffee/HTML/file/Contact.html");                                                                                                                                                                                                                                                                        
   $output = '...Redirecting to contact page, please wait!...';
   echo $output;
}

?>




































































































































































































































































  <!-- Author : Trần Minh Quân 22NS056,
Thái Thị Hồng Phúc 22NS048  -->