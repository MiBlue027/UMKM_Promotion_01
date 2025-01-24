-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 03:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_promotion_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(60) NOT NULL,
  `admin` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin`, `password`, `email`) VALUES
(0, 'admin1', '$2y$10$MTWDG5.9dNS9LkN7yO8gq.otzBRT6R13/wQnGAH0u1BF3BI4g/N/u', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart_temp`
--

CREATE TABLE `cart_temp` (
  `id` int(60) NOT NULL,
  `user_id` bigint(60) NOT NULL,
  `product_id` int(60) NOT NULL,
  `quantity` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criticism_suggestions`
--

CREATE TABLE `criticism_suggestions` (
  `id` int(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criticism_suggestions`
--

INSERT INTO `criticism_suggestions` (`id`, `name`, `email`, `message`) VALUES
(1, 'MC', 'mc@gmail.com', 'Semangatss!!!'),
(2, 'MC', 'mc@gmail.co', 'Hmmmm');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(60) NOT NULL,
  `question` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'Di toko mana saja saya bisa membeli Keripik Beruah?', 'Anda dapat membeli Keripik Beruah di toko resmi kami di Malang\r\n              atau melalui mitra resmi kami yang tersebar di berbagai kota besar\r\n              di Indonesia.'),
(2, 'Apakah Keripik Beruah tersedia di luar Malang?', 'Ya, kami memiliki beberapa mitra di luar Malang yang menjual\r\n              produk kami, atau Anda bisa memesannya secara online di situs\r\n              resmi kami.'),
(3, 'Apakah produk di marketplace (Shopee, Tokopedia, dll) asli?', 'Ya, produk Keripik Beruah yang dijual di marketplace resmi kami\r\n              dijamin keasliannya. Pastikan Anda membeli dari akun resmi untuk\r\n              menghindari produk palsu.'),
(4, 'Apakah pemesanan bisa diantarkan ke rumah?', 'Ya, kami menyediakan layanan pengantaran ke rumah melalui jasa\r\n              kurir lokal maupun ojek online di area tertentu.'),
(5, 'Apakah Keripik Beruah bisa dikirim ke luar kota?', 'Kami menyediakan layanan pengiriman ke luar kota dengan packing\r\n              khusus untuk memastikan produk sampai dalam kondisi baik.'),
(6, 'Hari apa saja saya bisa membeli Keripik Beruah di toko?', 'Anda bisa mengunjungi toko kami setiap hari dari pukul 08.00\r\n              hingga 20.00. Kami buka setiap hari, termasuk hari libur.');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(60) NOT NULL,
  `title` varchar(40) NOT NULL,
  `article` longtext NOT NULL,
  `image` varchar(250) NOT NULL,
  `trending` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `article`, `image`, `trending`) VALUES
(1, 'First Fine Dinning Event', 'Sebuah restoran baru dengan konsep unik telah hadir, menyajikan pengalaman fine dining berbasis keripik berbuah. Restoran ini memadukan camilan renyah seperti keripik pisang, apel, dan nanas dengan sentuhan mewah, mulai dari saus cokelat premium hingga taburan keju eksklusif.\r\n\r\nMengusung suasana elegan dengan layanan kelas atas, restoran ini menghadirkan menu bertahap ala fine dining, menjadikan keripik berbuah sebagai bintang utama setiap hidangan. Dengan kreativitas dalam rasa dan presentasi, restoran ini menawarkan pengalaman kuliner yang tak terlupakan bagi para pencinta inovasi.\r\n\r\nPastikan Anda tidak melewatkan kesempatan mencicipi keunikan restoran ini!', '../Asset/Gallery/fineDinning.jpg', 1),
(2, 'Presiden Kunjungi Toko Keripik Berbuah', 'Presiden baru-baru ini melakukan kunjungan ke restoran keripik berbuah Anda, yang dikenal sebagai pelopor konsep fine dining berbasis camilan lokal. Dalam kunjungannya, Presiden mengapresiasi kreativitas dan inovasi kuliner yang ditawarkan, serta upaya Anda dalam mengangkat makanan sederhana seperti keripik pisang, apel, dan nanas ke tingkat yang lebih mewah.\r\n\r\nPresiden mencicipi beberapa menu andalan, termasuk keripik apel dengan madu truffle dan keripik pisang berlapis cokelat premium, yang langsung mendapat pujian. Beliau juga memuji suasana restoran yang elegan namun tetap menghadirkan sentuhan lokal yang hangat.\r\n\r\nKunjungan ini menjadi bukti bahwa restoran Anda tidak hanya berhasil mencuri perhatian publik, tetapi juga mendapatkan pengakuan dari pemimpin negara. Sebuah langkah besar bagi inovasi kuliner Indonesia!', '../Asset/Gallery/kunjunganPresiden.jpg', 1),
(3, 'Keripik Berbuah Spill Bahan Baku yang Vi', 'Restoran keripik berbuah Anda kembali mencuri perhatian dengan ide kreatif untuk membuat konten viral. Kali ini, tim restoran sengaja melakukan \"spill\" bahan baku utama, seperti potongan buah segar, di area dapur. Spill tersebut bukan insiden, melainkan bagian dari konsep unik untuk memperlihatkan kesegaran bahan baku yang digunakan.\r\n\r\nDalam video yang diunggah di media sosial, terlihat potongan buah segar seperti pisang, apel, dan nanas jatuh dengan cantik, menampilkan warna-warni alami yang menggugah selera. Konten ini berhasil menarik perhatian warganet, yang memuji kreativitas restoran Anda dalam mempromosikan produk dengan cara yang segar dan menghibur.\r\n\r\nSelain memamerkan bahan berkualitas, video ini juga menjadi cara unik untuk meningkatkan engagement dan memperkuat branding restoran. Tak heran, restoran Anda terus menjadi perbincangan hangat di dunia kuliner!', '../Asset/Gallery/spillBahanBaku.jpg', 1),
(4, 'Kripek Buah Sehat: Camilan Lezat dan Ber', 'Kripek buah adalah camilan sehat yang terbuat dari buah segar seperti apel, pisang, dan mangga. Kaya akan serat, vitamin, dan mineral, kripek buah membantu melancarkan pencernaan dan memperkuat imun tubuh. Proses pembuatannya menjaga nutrisi tetap terjaga tanpa tambahan gula berlebih.\r\n\r\nPraktis dan lezat, kripek buah adalah pilihan sempurna untuk camilan sehat kapan saja. Cobalah sekarang dan nikmati manfaatnya!', '../Asset/Gallery/healthyChips.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(60) NOT NULL,
  `product_image` varchar(120) NOT NULL DEFAULT '../Asset/dummyImage1.png',
  `product_name` varchar(60) NOT NULL,
  `variant` varchar(60) NOT NULL,
  `price` bigint(60) NOT NULL,
  `product_description` longtext NOT NULL,
  `best_seller` tinyint(1) NOT NULL,
  `new` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_image`, `product_name`, `variant`, `price`, `product_description`, `best_seller`, `new`) VALUES
(1, '../Asset/Products/kelapa.jpg', 'Keripik Kelapa', 'Buah', 35000, 'Keripik kelapa adalah camilan renyah yang terbuat dari irisan tipis kelapa muda yang digoreng hingga crispy. Dengan rasa alami yang sedikit manis dan gurih, keripik kelapa menyajikan sensasi berbeda dibandingkan keripik lainnya. Keripik ini sering diberi tambahan bumbu seperti garam, gula, atau rempah untuk meningkatkan cita rasanya. Cocok dinikmati sebagai snack ringan atau pelengkap hidangan, keripik kelapa memberikan perpaduan rasa yang memikat dengan tekstur yang menggugah selera.', 1, 0),
(2, '../Asset/Products/pisang_durian.jpg', 'Keripik Pisang Durian', 'Buah', 65000, 'Keripik pisang durian adalah camilan unik yang menggabungkan kelezatan pisang matang dengan aroma khas durian. Irisan tipis pisang digoreng hingga renyah, lalu dipadukan dengan bubuk durian yang kaya rasa dan harum. Perpaduan rasa manis dari pisang dan gurihnya durian menciptakan sensasi rasa yang berbeda dan menggugah selera. Keripik pisang durian cocok bagi pecinta durian yang ingin menikmati camilan praktis dengan cita rasa yang khas.', 1, 1),
(3, '../Asset/Products/sayur.jpg', 'Keripik Sayur', 'Sayur', 30000, 'Keripik sayur adalah camilan sehat yang terbuat dari berbagai jenis sayuran seperti kale, bayam, wortel, dan ubi, yang dipotong tipis dan digoreng hingga renyah. Dengan bumbu ringan, keripik sayur menawarkan rasa gurih dan renyah yang menyenangkan, sambil tetap mempertahankan kandungan gizi dari sayuran. Camilan ini cocok bagi mereka yang mencari alternatif sehat dan rendah kalori tanpa mengorbankan rasa.', 1, 0),
(4, '../Asset/Products/kentang.jpg', 'Keripik Kentang', 'Sayur', 40000, 'Keripik kentang adalah camilan klasik yang terbuat dari irisan tipis kentang yang digoreng hingga renyah dan diberi bumbu gurih. Dengan rasa yang ringan namun menggugah selera, keripik kentang menjadi pilihan populer sebagai snack atau pelengkap hidangan. Tersedia dalam berbagai varian rasa, seperti asin, keju, atau pedas, keripik kentang menawarkan sensasi crunchy yang sempurna untuk menemani waktu santai Anda.', 1, 0),
(5, '../Asset/Products/mangga.jpg', 'Keripik Mangga', 'Buah', 40000, 'Keripik mangga adalah camilan renyah yang terbuat dari irisan tipis mangga segar yang dikeringkan atau digoreng. Dengan rasa manis dan sedikit asam alami dari mangga, keripik ini menawarkan sensasi segar dan unik. Cocok dinikmati sebagai snack sehat, keripik mangga juga bisa menjadi pilihan menyegarkan bagi pencinta buah tropis yang ingin menikmati camilan praktis dengan cita rasa khas mangga.', 0, 0),
(6, '../Asset/Products/nangka.jpg', 'Keripik Nangka', 'Buah', 45000, 'Keripik nangka adalah camilan lezat yang terbuat dari buah nangka matang berkualitas, yang diiris tipis dan digoreng hingga kering dan renyah. Dengan rasa manis alami khas nangka, keripik ini menawarkan sensasi garing yang memuaskan dan aroma tropis yang menggugah selera. Kaya akan serat dan bebas bahan tambahan berbahaya, keripik nangka menjadi pilihan camilan sehat yang sempurna bagi siapa saja yang ingin menikmati kelezatan alami sambil tetap menjaga pola makan. Cocok untuk dinikmati kapan saja sebagai kudapan ringan yang bergizi.', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(60) NOT NULL,
  `product_id` int(60) NOT NULL,
  `stock` int(60) NOT NULL,
  `total_order` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `stock`, `total_order`) VALUES
(1, 2, 80, 0),
(2, 1, 0, 26),
(3, 4, 5, 0),
(4, 5, 80, 35),
(5, 3, 0, 20),
(6, 6, 87, 13);

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(60) NOT NULL,
  `user_id` bigint(60) NOT NULL,
  `transaction_details_id` int(60) NOT NULL,
  `rating` int(8) NOT NULL,
  `review` longtext DEFAULT NULL,
  `image1` varchar(60) DEFAULT NULL,
  `image2` varchar(60) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `user_id`, `transaction_details_id`, `rating`, `review`, `image1`, `image2`, `visibility`) VALUES
(1, 20241223001, 1, 5, 'Wenak Polllll!!!!!', '../Asset/Testi/UserAdd/img1_6791a1e757c9d0.88334643.jpg', NULL, 1),
(2, 20241223002, 4, 4, 'Kecut, lumayan enak!', NULL, NULL, 1),
(3, 20250123005, 6, 5, 'First time I taste durian... WENAKK POLLLL!!! MANTAPPP BENTUULLLL', '../Asset/Testi/UserAdd/img1_6791ed57dc3875.53331731.jpg', NULL, 1),
(4, 20241223001, 2, 4, '', NULL, NULL, 0),
(5, 20241223001, 3, 3, '', NULL, NULL, 0),
(6, 20241223001, 20, 4, '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(60) NOT NULL,
  `id_user` bigint(60) NOT NULL,
  `payment_method` varchar(60) NOT NULL,
  `transaction_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `id_user`, `payment_method`, `transaction_date`) VALUES
(1, 20241223001, 'BCA', '2025-01-23 01:54:51.122057'),
(2, 20241223002, 'Mandiri', '2025-01-23 04:45:22.276463'),
(3, 20250123005, 'Paypal', '2025-01-23 07:17:52.494593'),
(4, 20250123005, 'BCA', '2025-01-23 07:29:32.983774'),
(5, 20241223001, 'BCA', '2025-01-23 12:16:30.746691'),
(6, 20241223001, 'BCA', '2025-01-23 12:33:35.399110'),
(7, 20241223001, 'Mandiri', '2025-01-23 12:43:24.672699'),
(8, 20241223001, 'BCA', '2025-01-23 15:10:01.723768'),
(9, 20241223001, 'BCA', '2025-01-23 16:26:44.423861'),
(10, 20241223001, 'BCA', '2025-01-23 16:39:19.194853');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(60) NOT NULL,
  `transaction_id` int(60) NOT NULL,
  `product_id` int(60) NOT NULL,
  `quantity` int(60) NOT NULL,
  `testi_status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `quantity`, `testi_status`) VALUES
(1, 1, 2, 5, 1),
(2, 1, 4, 10, 1),
(3, 1, 6, 5, 1),
(4, 2, 5, 2, 1),
(5, 3, 5, 5, 0),
(6, 3, 2, 2, 1),
(7, 4, 4, 5, 0),
(8, 5, 4, 1, 0),
(9, 6, 4, 1, 0),
(10, 7, 4, 2, 0),
(11, 8, 4, 1, 0),
(12, 8, 2, 4, 0),
(13, 9, 4, 5, 0),
(14, 9, 2, 5, 0),
(15, 9, 6, 5, 0),
(16, 9, 5, 5, 0),
(17, 10, 2, 5, 0),
(18, 10, 6, 3, 0),
(19, 10, 4, 5, 0),
(20, 10, 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(60) NOT NULL,
  `avatar` varchar(250) NOT NULL DEFAULT '../Asset/dummyUser.png',
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `register_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `address` varchar(40) DEFAULT NULL,
  `phone_number` bigint(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `username`, `password`, `email`, `register_date`, `address`, `phone_number`) VALUES
(20241223001, '../Asset/dummyUser.png', 'MC', '$2y$10$n.UY0NSFgHn7EOfsp77y6OKjyk6QHqdCLAwEIlzgAcvTD1JiBN3xG', 'mc@gmail.com', '2024-12-23 05:09:30.283947', 'Jl. MCAddressNEW', 82123456780),
(20241223002, '../Asset/ProfileAsset/ProfilePicture/User1_PP.png', 'User1', '$2y$10$Rnt9XrrwWrInqVZ6PQ8QbumNdWmuU6RjGQWBnpzxAh8VN1FYREipy', 'user1@gmail.com', '2024-12-23 05:23:57.754294', 'Jl. User1Address', 987667853425),
(20241223003, '../Asset/dummyUser.png', 'User2', '$2y$10$8W/jJqMJAXt68IepF/9w/uH.z1GjFBX/pvO6ItJzukSPH8bUBrMyi', 'User2', '2024-12-23 06:09:54.316912', NULL, NULL),
(20250123004, '../Asset/dummyUser.png', 'Sugab', '$2y$10$RiTzCSnscg9Xg6LbBw592.Qj.X6Cnuz0vU61nU6Ef0CEF9SE0e92C', 'sugab@gmail.com', '2025-01-23 07:03:04.577565', NULL, NULL),
(20250123005, '../Asset/dummyUser.png', 'User3', '$2y$10$VpZIy7iFMUxRne1mUkUkDu3OkM3bCrLEdBoS53Jk.hzT6pQnsfEs2', 'user3@gmail.com', '2025-01-23 07:17:08.795896', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_temp`
--
ALTER TABLE `cart_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `criticism_suggestions`
--
ALTER TABLE `criticism_suggestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `transaction_details_id` (`transaction_details_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_temp`
--
ALTER TABLE `cart_temp`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `criticism_suggestions`
--
ALTER TABLE `criticism_suggestions`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_temp`
--
ALTER TABLE `cart_temp`
  ADD CONSTRAINT `cart_temp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_temp_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimony`
--
ALTER TABLE `testimony`
  ADD CONSTRAINT `testimony_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testimony_ibfk_2` FOREIGN KEY (`transaction_details_id`) REFERENCES `transaction_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
