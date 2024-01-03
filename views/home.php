<?php
if ($_SESSION['role'] == 0) {
    require_once("./views/student/index.php.php");
} else {
    require_once("./views/teacher/index.php.php");
}
