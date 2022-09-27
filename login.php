<!DOCTYPE html>
<html>
    <head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
                border: white solid 1px;
                cursor:pointer;

            }
            #error{
                position: relative;
                display: none;
                color: red;
            }
        </style>
    </head>
    <body>
           
        <form id="loginForm" name="login" method="POST" action="include/login.inc.php">
        <h1>Aku: Buy with crypto!</h1>
        <hr>
            <h2>Login / Sign Up</h2>
            <table>
            <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == 'emptyInputs'){
                            echo '<span style="color:red;">Error: Empty Inputs</span>';
                        }                    
                        if($_GET['error'] == 'usernameDoesntExist'){
                            echo '<span style="color:red;">Error: Email/Username Doesnt exist</span>';
                        }
                        if($_GET['error'] == 'incorrectPassword'){
                            echo '<span style="color:red;">Error: Incorrect password</span>';
                        }
                    }
                ?>
            <span id="error"></span>
                <tr>
                    <td><label>username/Email:</label></td>
                    <td><input name="uid" required></td>
                </tr>
                <tr>
                    <td><label>Password:</label></td>
                    <td><input type="password" minlength="8" maxlength="30" name="password" required></td>
                </tr>
                <!-- <tr>
                    <td>
                    <div style="position: relative; left: 50%; transform: translate(50%,0);" class="g-recaptcha" data-sitekey="6Ld-nv0hAAAAAPcNjPh8PcbRxdOIAhEyA-6kuTcb"></div>
                    </td>
                </tr> -->
                <tr>
                    <th><input name="sbmt_btn" type="submit" value="login"></th>
                </tr>
                <tr>
                    <th><a style="position: relative; left: 50%; transform: translate(-50%,0);" href="signup.php"> or Create account</a></th>
                </tr>
                <input name="date" type="text" hidden>
            </table>
            
        </form>
        <script src="scripts/ENCRYPTO.js"></script>

        <script>
            // login.sbmt_btn.addEventListener('click',(e)=>{
            //     e.preventDefault();
            //     let time = new Date()
            //     let date = `${time.getFullYear()}-${time.getMonth()+1}-${time.getDate()}.${time.getHours()}.${time.getMinutes()}.${time.getSeconds()}.${time.getMilliseconds()}`
            //     login.date.value = date
            //     login.user.value = SHA1(login.user.value)
            //     login.password.value = SHA1(login.password.value + "." + login.date.value)
            //     //login.submit()
            // })
        </script>
    </body>
</html>