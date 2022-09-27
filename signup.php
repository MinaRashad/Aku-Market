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
                top: 40vh;
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
                display: none;
                color: red;
            }
        </style>
    </head>
    <body>

        <form id="loginForm" name="login" method="POST" action="include/signup.inc.php">
        <h1>Aku: Buy with crypto!</h1>
        <hr>
            <h2>Login / Sign Up</h2>
            <table>
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == 'emptyInputs'){
                            echo '<span style="color:red;">Error: Empty Inputs</span>';
                        }
                        if($_GET['error'] == 'invalidUsername'){
                            echo '<span style="color:red;">Error: Invalid Username</span>';
                        }
                        if($_GET['error'] == 'PasswordMatch'){
                            echo '<span style="color:red;">Error: Passwords didnt match</span>';
                        }
                        if($_GET['error'] == 'usernameExists'){
                            echo '<span style="color:red;">Error: Username already exists. create a new one</span>';
                        }
                        if($_GET['error'] == 'emailExists'){
                            echo '<span style="color:red;">Error: Email already exists. Go to login. </span>';
                        }
                        if($_GET['error'] == 'none'){
                            echo '<span style="color:#0f0;">Signed up successfully</span>';
                        }
                    }
                ?>
                <span id="error"></span>
                <tr>
                    <td><label>*username:</label></td>
                    <td><input name="username" minlength="4" maxlength="8" 
                               placeholder="letters&numbers only" pattern="[A-Za-z0-9]+" required></td>
                </tr>
                <tr>
                    <td><label>*Email:</label></td>
                    <td><input type="email" name='email' required></td>
                </tr>
                <tr>
                    <td><label>*Password:</label></td>
                    <td><input type="password" minlength="8" maxlength="30" name="password" required></td>
                </tr>
                <tr>
                    <td><label>*repeat Password:</label></td>
                    <td><input type="password" name="repassword" required></td>
                </tr>
                <tr><th><input name="sbmt_btn" type="submit" value="signUp"></th></tr>
                <tr>
                    <th><a style="position: relative; left: 70%;" href="login.php"> or login</a></th>
                </tr>
            </table>
            
        </form>
            <?php
        
        ?>
        <script src="scripts/ENCRYPTO.js"></script>

        <script>
            let errorBlock = document.getElementById('error')
            login.sbmt_btn.addEventListener('click',(e)=>{
                if(login.password.value != login.repassword.value && login.password.value){
                     e.preventDefault();
                     errorBlock.innerText = "Error: Passwords dont match"
                     errorBlock.style.display = "block"
                }
            })
        </script>

    </body>
</html>