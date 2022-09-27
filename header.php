<?php
if (session_status() != 2) {
    session_start();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Aku</title>
        <style>
            *, body{
                font-family: monospace;
                background-color: black;
                color: white;
            }
            #loginForm{
                width: fit-content;
                height: fit-content;
                font-size: 3vw;
                position: relative;
                left: 50vw;
                top: 50vh;
                transform: translate(-50%,-50%);
            }
            input{
                font-size: 3vw;
            }
            input[type="submit"]{
                position: relative;
                left: 50%;
                transform: translate(50%,0);
                border: 1px solid white;

            }
            #editform input{
                font-size: 2vh;

            }
            #editform input[type="submit"]{
                font-size: 5vh;
                position: relative;
                left: 30%;
                transform: translate(50%,0);

            }
            .wrapper{
                display: inline-flex;
                flex-direction: row;
                color: black !important;
                background-color: white;
                font-size: 5vh;
                width: 95vw;
                padding-left: 3vw;
            }
            .wrapper span{
                color: black;
                background-color: white;
                position: absolute;
                right: 5vw;
            }
            #sellform{
                margin-top: 3vh;
                margin-bottom: 3vh;
                margin-left: 3vw;
                margin-right: 3vw;
            }
            td{
                padding: 0.5vw;
                max-width: 30vw;
            }
        </style>
    </head>
    <body>

            <div class="wrapper">
                
            Aku: Buy with crypto!
            
                <div>

                <?php
                    
                    if (isset($_SESSION['uid'])) {
                        $Name = $_SESSION['uid'];
                        echo "<span style='font-size:3vh;'>Welcome " . htmlspecialchars($Name, ENT_QUOTES, 'UTF-8') . " <a href='logout.php'>logout</a> <a href='/sell.php'>sell</a> <a href='/my_listings.php'>my listings</a> <a href='/index.php'>Home</a></span>";
                    }
                    else {
                        echo "<span> <a href='./login.php'>Login/Sign up</a></span>";
                    }
                ?>

                </div>
            </div>