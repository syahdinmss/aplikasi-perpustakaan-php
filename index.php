<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config/Database.php";
require_once "interfaces/CrudInterface.php";
require_once "models/BaseModel.php";
require_once "models/Book.php";

use Config\Database;
use Models\Book;

$dbClass = new Database();
$conn = $dbClass->connect();
$book = new Book($conn);

/* ===== PROSES CREATE ===== */
if(isset($_POST['tambah'])){

    $data = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'stock' => $_POST['stock']
    ];

    $book->create($data);
    header("Location: index.php");
}

/* ===== PROSES DELETE ===== */
if(isset($_GET['hapus'])){
    $book->delete($_GET['hapus']);
    header("Location: index.php");
}

/* ===== AMBIL DATA UNTUK EDIT ===== */
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $resultEdit = $conn->query("SELECT * FROM books WHERE id=$id");
    $editData = $resultEdit->fetch_assoc();
}

/* ===== PROSES UPDATE ===== */
if(isset($_POST['update'])){
    $data = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'stock' => $_POST['stock']
    ];
    $book->update($_POST['id'], $data);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .card-custom {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .btn-custom {
            border-radius: 20px;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
<div class="container mt-5">

<h2><?= $editData ? "Edit Buku" : "Tambah Buku" ?></h2>

<div class="card card-custom p-4 mb-4">
    <h4 class="mb-3"><?= $editData ? "Edit Buku" : "Tambah Buku" ?></h4>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" 
                value="<?= $editData['title'] ?? '' ?>" 
                class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" 
                value="<?= $editData['author'] ?? '' ?>" 
                class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" 
                value="<?= $editData['stock'] ?? '' ?>" 
                class="form-control" required>
        </div>

        <?php if($editData){ ?>
            <button name="update" class="btn btn-warning btn-custom">Update</button>
        <?php } else { ?>
            <button name="tambah" class="btn btn-primary btn-custom">Tambah</button>
        <?php } ?>
    </form>
</div>

<hr>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="card card-custom p-4">
    <h4 class="mb-3">Daftar Buku</h4>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Author</th>
            <th>Stock</th>
            <th width="150">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $book->read();
        $no = 1;

        while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?= $no++?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['stock'] ?></td>
            <td>
                <a href="?edit=<?= $row['id'] ?>" 
                   class="btn btn-sm btn-warning btn-custom">Edit</a>

                <a href="?hapus=<?= $row['id'] ?>" 
                   class="btn btn-sm btn-danger btn-custom"
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>