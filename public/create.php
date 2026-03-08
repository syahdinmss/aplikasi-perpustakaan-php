<?php

require_once "../config/Database.php";
require_once "../interfaces/CrudInterface.php";
require_once "../models/BaseModel.php";
require_once "../models/Book.php";

use Models\Book;

$book = new Book();

if(isset($_POST['submit']))
{

$data = [
"title"=>$_POST['title'],
"author"=>$_POST['author'],
"stock"=>$_POST['stock']
];

$book->create($data);

header("Location:index.php");

}

?>

<form method="POST">

<input name="title" placeholder="Judul Buku"><br><br>

<input name="author" placeholder="Penulis"><br><br>

<input name="stock" placeholder="Stock"><br><br>

<button name="submit">Simpan</button>

</form>