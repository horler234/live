<?php include('./config/connect.php'); 
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $current = time() + 3600;
        $d = date('H:i:s', $current);
        $currentTime = strtotime($d);
        //var_dump(date('H:i:s', $d) >= strtotime('3:00:00'));
        if (($currentTime >= strtotime('2:00:00')) && ($currentTime <= strtotime('16:30:00'))) {
            $timeframe = '2pm to 3pm';
            $sql = "SELECT * FROM attendance WHERE `email` = '$email' AND `timeframe` = '$timeframe'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            
            if ($count < 1) {
                $sql = "INSERT INTO attendance(`name`, `email`, `timeframe`) VALUES('$name', '$email', '$timeframe')";
                if($conn->query($sql)){
                    header("location:in/index.html?sucess=true");
                }else{
                    die('could not enter data: '. $conn->error);
                }
            }else{
                header("location:in/index.html?sucess=logged");
            }

        }elseif (($currentTime >= strtotime('15:30:00')) && ($currentTime <= strtotime('16:30:00'))) {
            $timeframe = '3:30pm to 4:30pm';
            $sql = "SELECT * FROM attendance WHERE `email` = '$email' AND `timeframe` = '$timeframe'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            $error = "";
            if ($count == 0) {
                $sql = "INSERT INTO attendance(`name`, `email`, `timeframe`) VALUES('$name', '$email', '$timeframe')";
                if($conn->query($sql)){
                    header("location:in/index.html?sucess=true");
                }else{
                    die('could not enter data: '. $conn->error);
                }
            }else{
                header("location:in/index.html?sucess=logged");
            }
        }else{
            header("location:in/index.html");
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Next Conference - LIVE</title>
    <link rel="icon" href="img/logo.png" sizes="16*16">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body> 
    
    <div class="box">
            <p class="signin">The Next Conference</p>
            <form method="POST">
            
            <input name="name" type="text" placeholder="Enter Your Full Name">
            <br/>
            <input name="email" type="email" placeholder="Enter Your Email" >
            
            <button type="submit" name="submit">Log In</button>
        </form>                                                                                                                                           
    </div>

</body>
</html>
