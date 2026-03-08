<?php

require_once "../config/Database.php";
require_once "../interfaces/CrudInterface.php";
require_once "../models/BaseModel.php";
require_once "../models/Book.php";

use Models\Book;

$book = new Book();

$id = $_GET['id'];

if(isset($_POST['submit']))
{

$data = [
"title" => $_POST['title'],
"author" => $_POST['author'],
"stock" => $_POST['stock']
];

$book->update($id,$data);

header("Location:index.php");
}

$books = $book->read();

$currentBook = null;

foreach($books as $b){
if($b['id'] == $id){
$currentBook = $b;
}
}

?>
<div class="card p-4">

<h4 class="mb-3">Tambah Buku</h4>

<form method="POST">

<div class="mb-3">
<label>Judul Buku</label>
<input type="text" name="title" class="form-control">
</div>

<div class="mb-3">
<label>Penulis</label>
<input type="text" name="author" class="form-control">
</div>

<div class="mb-3">
<label>Stock</label>
<input type="number" name="stock" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>

<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>