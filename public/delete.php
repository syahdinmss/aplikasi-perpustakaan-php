<?php

require_once "../config/Database.php";
require_once "../interfaces/CrudInterface.php";
require_once "../models/BaseModel.php";
require_once "../models/Book.php";

use Models\Book;

$book = new Book();

$id = $_GET['id'];

$book->delete($id);

header("Location:index.php");