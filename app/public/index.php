<?php
require_once '../classes/Database.php';

$db = (new Database())->connect();

echo "Welcome to XBuy!";