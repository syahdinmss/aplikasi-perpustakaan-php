-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Mar 2026 pada 05.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `publisher` varchar(100) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `category`, `stock`, `publisher`, `year`, `created_at`) VALUES
(1, '978-0-13-468599-1', 'Clean Code', 'Robert C. Martin', 'Teknologi', 5, 'Prentice Hall', '2008', '2026-03-04 10:59:53'),
(2, '978-0-20-163361-5', 'The Pragmatic Programmer', 'David Thomas', 'Teknologi', 3, 'Addison-Wesley', '1999', '2026-03-04 10:59:53'),
(3, '978-0-59-651774-8', 'Learning PHP, MySQL & JavaScript', 'Robin Nixon', 'Teknologi', 4, 'O\'Reilly Media', '2018', '2026-03-04 10:59:53'),
(4, '978-0-74-323348-8', 'Harry Potter and the Sorcerers Stone', 'J.K. Rowling', 'Fiksi', 6, 'Scholastic', '1997', '2026-03-04 10:59:53'),
(5, '978-6-02-394671-3', 'Laskar Pelangi', 'Andrea Hirata', 'Fiksi', 3, 'Bentang Pustaka', '2005', '2026-03-04 10:59:53'),
(6, '978-0-06-112008-4', 'To Kill a Mockingbird', 'Harper Lee', 'Fiksi', 2, 'J. B. Lippincott', '1960', '2026-03-04 10:59:53'),
(7, '978-6-02-060289-7', 'Sejarah Indonesia Modern', 'M.C. Ricklefs', 'Sejarah', 4, 'Gadjah Mada UP', '2005', '2026-03-04 10:59:53'),
(8, '978-0-14-028329-7', 'Sapiens', 'Yuval Noah Harari', 'Sains', 5, 'Harper', '2011', '2026-03-04 10:59:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned','overdue') NOT NULL DEFAULT 'borrowed',
  `fine` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `loans`
--

INSERT INTO `loans` (`id`, `member_id`, `book_id`, `user_id`, `loan_date`, `due_date`, `return_date`, `status`, `fine`) VALUES
(1, 1, 1, 1, '2026-03-04', '2026-03-11', NULL, 'borrowed', 0.00),
(2, 2, 3, 1, '2026-03-04', '2026-03-11', NULL, 'borrowed', 0.00),
(3, 3, 5, 2, '2026-02-22', '2026-03-01', NULL, 'overdue', 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `member_code` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `joined_at` date NOT NULL DEFAULT curdate(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `member_code`, `full_name`, `email`, `phone`, `address`, `joined_at`, `status`) VALUES
(1, 'MBR-0001', 'Budi Santoso', 'budi@email.com', '081234567890', 'Jl. Melati No.1, Jakarta', '2024-01-10', 'active'),
(2, 'MBR-0002', 'Ani Rahayu', 'ani@email.com', '082345678901', 'Jl. Mawar No.5, Bandung', '2024-02-15', 'active'),
(3, 'MBR-0003', 'Candra Wijaya', 'candra@email.com', '083456789012', 'Jl. Kenanga No.12, Surabaya', '2024-03-20', 'active'),
(4, 'MBR-0004', 'Dewi Kusuma', 'dewi@email.com', '084567890123', 'Jl. Dahlia No.3, Yogyakarta', '2024-04-05', 'active'),
(5, 'MBR-0005', 'Eko Prasetyo', 'eko@email.com', '085678901234', 'Jl. Anggrek No.8, Semarang', '2024-05-01', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL DEFAULT 'petugas',
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrator', '2026-03-04 10:59:53'),
(2, 'petugas', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'petugas', 'Petugas Perpustakaan', '2026-03-04 10:59:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indeks untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_code` (`member_code`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `loans_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
