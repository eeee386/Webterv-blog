<?php
include_once "classes/User.php";
include_once "utils/InputUtils.php";
include_once "common.php";
upperPart();

if(isset($_SESSION["user"])){
    if(empty($_POST["logout"])){
        echo "<form action='loginsignuplogout.php' method='POST' class='logoutForm'>
                <input type='submit' name='logout' value='Log out'/>
            </form>";
    } else {
        session_unset();
        session_destroy();
        InputUtils::createInputError("Logout is successful");
        header("Location: index.php");
    }
} else {
    echo "<div class='loginSignupWrapper'><div class='loginSignupForm'><div class='loginTitle'>Login: </div>
            <form action='loginsignuplogout.php' method='POST' class='loginForm'>
            <label>User name: <input type='text' name='username'/></label> <br/>
            <label>Password: <input type='password' name='pwd'/></label> <br/>
            <input type='submit' name='login' value='Log in'/>
            </form>
            <br/>
            <div class='signupTitle'>Sign Up: </div>
            <form action='loginsignuplogout.php' method='POST' class='signupForm'>
            <label>User name: <input type='text' name='username'/></label> <br/>
            <label>Password: <input type='password' name='pwd'/></label> <br/>
            <label>Password again: <input type='password' name='pwd-check'/></label> <br/>
            <div class='passwordWarning'>Minimum 8 characters for password</div>
            <div class='radioLabel'>
            <div>Ｉｓ  ｔｈｉｓ  ｐａｇｅ  </div>   
            <div>ΛΞＳＴＨΞＴＩＣ？</div>
            </div>
            <br/>
            <div class='regRadioContainer'>
            <div>
            <input type='radio' id='yes' name='aesthetic' value='yes'>
            <label for='yes'>ＹΣＳ</label>
            </div>
            <div>
            <input type='radio' id='no' name='aesthetic' value='no'>
            <label for='no'>Ｎ♢</label>
            </div>            
            <div>
            <input type='radio' id='maybe' name='aesthetic' value='maybe'>
            <label for='maybe'>Ｍ▲ＹＢＥ</label>
            </div>
            </div>
            <br/>
            <br/>            
            <div class='checkBoxLabel'>
            <div>ＯＰΞＲΛＴＩＮＧ ＳＹＳＴΞＭ？ </div>   
            </div>
            <br/>
            <div class='regCheckboxContainer'>
            <div>
            <input type='checkbox' id='3.11' name='operatingsystem[]' value='3.11'>
            <label for='3.11'>Windows 3.11</label>
            </div>
            <div>
            <input type='checkbox' id='Win95' name='operatingsystem[]' value='Win95'>
            <label for='Win95'>Windows 95</label>
            </div>            
            <div>
            <input type='checkbox' id='Win98' name='operatingsystem[]' value='Win98'>
            <label for='Win98'>Windows 98</label>
            </div>
            <div>
            <input type='checkbox' id='linux' name='operatingsystem[]' value='Linux'>
            <label for='linux'>Linux</label>
            </div>
            <div>
            <input type='checkbox' id='SCO_UNIX' name='operatingsystem[]' value='SCO_UNIX'>
            <label for='SCO_UNIX'>SCO UNIX</label>
            </div>
            <div>
            <input type='checkbox' id='MAC_OS' name='operatingsystem[]' value='MAC_OS'>
            <label for='MAC_OS'>Mac OS</label>
            </div>
            <div>
            <input type='checkbox' id='Palm_OS' name='operatingsystem[]' value='Palm_OS'>
            <label for='Palm_OS'>Palm OS</label>
            </div>
            <div>
            <input type='checkbox' id='Solaris' name='operatingsystem[]' value='Solaris'>
            <label for='Solaris'>Solaris</label>
            </div>
            </div>
            <br/>
            <br/>
            
            <input type='submit' name='signup' value='Sign up'/>
            </form></div>";
    if(empty($_POST["login"]) && empty($_POST["signup"])){
    } else if (!empty($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["pwd"];
        if(empty($username)){
            InputUtils::createInputError("Username field is empty");
        } else if(empty($password)) {
            InputUtils::createInputError("Password field is empty");
        } else {
            $accounts = User::getUsers();
            if (array_key_exists($username, $accounts)) {
                if ($accounts[$username]->getPassword() === $password) {
                    $_SESSION["user"] = $accounts[$username];
                    InputUtils::createInputSuccess("Login is successful");
                    header('Location: index.php');
                } else {
                    InputUtils::createInputError("Invalid Password");
                }
            } else {
                InputUtils::createInputError("Not a valid username");
            }
        }
    } else if(!empty($_POST["signup"])) {
        $username = $_POST["username"];
        $password = $_POST["pwd"];
        $password_check = $_POST["pwd-check"];

        $isAesthetic = InputUtils::prepNonEssentials("aesthetic");
        $operating_system = InputUtils::prepNonEssentials("operatingsystem");

        if(empty($username)){
            InputUtils::createInputError("Username field is empty");
        } else {
            $accounts = User::getUsers();
            if(array_key_exists($username, $accounts) && !empty($username) ){
                InputUtils::createInputError("This username is taken");
            } else {
                if(empty($password)){
                    InputUtils::createInputError("Password field is empty");
                } else if(strlen($password) < 8) {
                    InputUtils::createInputError("Password should be at least 8 characters long");
                } else if($password_check !== $password){
                    InputUtils::createInputError("Password and password check is not the same");
                } else {
                    $user = new User($username, $password, $isAesthetic, $operating_system);
                    User::saveUser($accounts, $user);
                    $_SESSION["user"] = $user;
                    InputUtils::createInputSuccess("Registration is successful");
                }
            }
        }
    }
    echo "</div>";
}
lowerPart();