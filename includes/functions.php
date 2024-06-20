<?php   

function secure(){
    if (!isset($_SESSION['Users_Id'])) {
        set_message('Favor de inicar sesion.');        
        header('Location: /CMS');
        die();
    }
}

function set_message($message){
$_SESSION['message']= $message;
}

function get_message(){
if (isset($_SESSION['message'])) {
    echo '<p>'.$_SESSION['message'].'</p> <hr>';
    unset($_SESSION['message']);
}
}