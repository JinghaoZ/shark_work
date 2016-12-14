<?php
include_once 'DBhelper.php';
class AdminDao{
    //This class is used to create a new user
    function deleteGoods(){
        $dbh = new DBhelper();
        $mysqli = $dbh->getCoon();
        $sql = "DELETE FROM task_goods WHERE FROM_UNIXTIME(add_time, '%Y-%m-%d %H:%i:%S') < SUBDATE(NOW(),INTERVAL 14 DAY)";
        $avaRes = $mysqli->query($sql);
    }
}
?>