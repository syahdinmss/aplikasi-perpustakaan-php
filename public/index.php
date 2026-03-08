<?php

require_once "../config/Database.php";
require_once "../interfaces/CrudInterface.php";
require_once "../models/BaseModel.php";
require_once "../models/Book.php";

use Models\Book;

$book = new Book();
$books = $book->read();

?>

<!DOCTYPE html>
<html>
<head>

<title>Perpustakaan</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="container mt-5">

<?php $no = 1; ?>

<a href="create.php" class="btn btn-primary mb-3">+ Tambah Buku</a>

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
<th>No</th>
<th>Judul</th>
<th>Penulis</th>
<th>Stock</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php foreach($books as $b): ?>

<tr>

<td><?= $no++ ?></td>
<td><?= $b['title'] ?></td>
<td><?= $b['author'] ?></td>
<td><?= $b['stock'] ?></td>

<td>

<a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="delete.php?id=<?= $b['id'] ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">

Delete

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

</body>
</html>