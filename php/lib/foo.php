<?php
namespace rdominguez\ObjectOriented;
require_once (dirname(__DIR__) . "/Classes/Author.php");

$john = new Author("dd3194c1-17ff-4fb8-92a3-d4a31667e19d","www.john123.com","token","john123@gmail,com","1234","John123");
var_dump($john)
?>