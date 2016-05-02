<?php
if (isset($_SERVER["REMOTE_ADDR"])) {
	header("Location: /");
}

require dirname(__FILE__) . "/index.php";