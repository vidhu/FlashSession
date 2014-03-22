# PHP FlashSession Library
A PHP Flash Session, is a Session variable which is set for temporary use. Once the value is accessed from a Flash Session, the Flash Session disappears.

This is particularly useful when you want to display temporary data across pages for example, If an error occurs, you can set a Flash Session variable containing the error and then display it on the next page.

##Usage

###1. Construct the Class Library

    //Include this on the top of every page you want to use Flash Session on just like session_start() for normal sessions
    new Flash();
    
###2. Setting a Flash Variable

    $flash = Flash::getFlashFactory();
    $flash->setFlash('VARIABLE_NAME', 'DATA');
    
###3. Retrieving a Flash Variable

    $flash = Flash::getFlashFactory();
    $data= Flash::getFlash('VARIABLE_NAME');
    
##Example when displaying an Error Message of failed Login

###1. Login Script (include.login.php)

    //Trying to login a User
    if($user->login('username', 'password') == FALSE){
        $flash = Flash::getFlashFactory();
        $flash->setFlash('LOGIN_ERROR', 'Username or Password was wrong');
    }
    
###2. Login Form (login.php)

    $flash = Flash::getFlashFactory();
    $error = Flash::getFlash('LOGIN_ERROR');
    if(isset($error)){
        echo $error;
    }
    
####This code is licence under the MIT Licence
