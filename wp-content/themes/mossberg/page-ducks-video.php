<?php
/*
Template Name: Ducks Video
*/
?>
<?php 
// Redirect Cookie
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', '1');
        setcookie($name, '', '1', '/');
    }
}
setcookie("mossberg_visitor", "Welcome to Mossberg", time()+15000000, '/');
header('Location: '.bloginfo('home').'/ducks/');	
?>
