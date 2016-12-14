<?php
include_once 'AdminDao.php';
if($_GET["action"]=="ok") {
    $dao = new AdminDao();
    $dao->deleteGoods();
    header("location: /work/web/index.php?r=admin/goods");
}
