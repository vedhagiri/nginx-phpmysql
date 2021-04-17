<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<h1 style="text-align: center;">Nginx - PHP - Mysql</h1>';


echo '<ul>';
echo '<li>PHP：', PHP_VERSION, '</li>';
echo '<li>Nginx：', $_SERVER['SERVER_SOFTWARE'], '</li>';
echo '<li>MySQL：', getMysqlVersion(), '</li>';
echo '</ul>';

printExtensions();


function getMysqlVersion()
{
    if (extension_loaded('PDO_MYSQL')) {
        try {
            $dbh = new PDO('mysql:host=mysql;dbname=mysql', 'root', '123456');
            $sth = $dbh->query('SELECT VERSION() as version');
            $info = $sth->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $info['version'];
    } else {
        return 'PDO_MYSQL ×';
    }

}


function printExtensions()
{
    echo '<ol>';
    foreach (get_loaded_extensions() as $i => $name) {
        echo "<li>", $name, '=', phpversion($name), '</li>';
    }
    echo '</ol>';
}

