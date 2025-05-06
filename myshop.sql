-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 11:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$dEBECXBIhxRKbbYPc2u4EeIRjk5XYUf2dDHMwysGRoBBMXbR9rXie');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_title`) VALUES
(1, 'Pantaloons'),
(2, 'Zara'),
(3, 'Nike'),
(4, 'Allen Solly'),
(5, 'H&M'),
(6, 'Calvin Klein'),
(7, 'Gucci'),
(8, 'Louis Vuitton');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`) VALUES
(1, 'kurti'),
(2, 'Pant'),
(3, 'formals'),
(4, 'Party Wear'),
(5, 'Casuals'),
(6, 'Sarees'),
(7, 'Traditional Outfits'),
(10, 'Night Wear');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 2, 1626770695, 3, 1, 'pending'),
(2, 2, 1751642134, 2, 1, 'pending'),
(3, 2, 613616516, 7, 1, 'pending'),
(4, 2, 747926537, 7, 1, 'pending'),
(5, 2, 1839911631, 6, 1, 'pending'),
(6, 2, 565051438, 1, 1, 'pending'),
(7, 2, 2147007195, 3, 3, 'pending'),
(8, 2, 1717990551, 2, 1, 'pending'),
(9, 2, 967764031, 5, 6, 'pending'),
(10, 2, 751330279, 13, 5, 'pending'),
(11, 2, 408181297, 13, 1, 'pending'),
(12, 2, 427636101, 13, 3, 'pending'),
(13, 2, 189170398, 13, 1, 'pending'),
(14, 2, 653112174, 2, 13, 'pending'),
(15, 2, 1927516977, 1, 1, 'pending'),
(16, 2, 1927516977, 7, 7, 'pending'),
(17, 2, 1298988404, 13, 1, 'pending'),
(18, 2, 1298988404, 3, 1, 'pending'),
(19, 2, 407369991, 4, 1, 'pending'),
(20, 2, 407369991, 13, 3, 'pending'),
(21, 2, 407369991, 5, 1, 'pending'),
(22, 2, 407369991, 3, 2, 'pending'),
(23, 2, 407369991, 6, 1, 'pending'),
(24, 2, 874160356, 7, 7, 'pending'),
(25, 7, 1096437338, 13, 2, 'pending'),
(26, 7, 1096437338, 1, 1, 'pending'),
(27, 7, 1096437338, 8, 1, 'pending'),
(28, 7, 1096437338, 3, 1, 'pending'),
(29, 7, 1096437338, 4, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_desc`, `product_keywords`, `brand_id`, `section_id`, `category_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `quantity`, `date`, `status`) VALUES
(1, 'White cute outfit', 'white top with loose bottom pants ', 'simple', 5, 2, 5, 'pro33.jfif', 'pro32.jfif', 'pro3.jpg', 500, 8, '2024-10-23 09:16:34', 'True'),
(2, 'Pink frock', 'Beautiful and comfortable pink frock', 'top, trending', 2, 2, 5, 'pro5.jpg', 'pro5.jpg', 'pro5.jpg', 700, 9, '2024-10-10 15:57:27', 'True'),
(3, 'Lehenga', 'A beautiful lehenga for haldi ', 'trending, beautiful, wedding, wedding-season, haldi, traditional', 2, 2, 7, 'pro16.jpg', 'pro162.jfif', 'pro163.jfif', 1000, 2, '2024-10-23 09:16:34', 'True'),
(4, 'Saree Gown', 'Beautiful Organza Gown which looks like a saree', 'festive wear', 5, 2, 6, 'pro173.jfif', 'pro172.jfif', 'pro17.jpg', 1000, 5, '2024-10-23 09:16:34', 'True'),
(5, 'Off shoulder formal outfit', 'off shoulder top with white loose bottom pant', 'formal', 2, 2, 3, 'pro2.jpg', 'pro2.jpg', 'pro2.jpg', 1000, 8, '2024-10-07 13:38:13', 'True'),
(6, 'Blue frock', 'Beautiful Blue knee length frock with flower prints', 'frock', 1, 2, 5, 'pro12.jpg', 'pro12.jpg', 'pro12.jpg', 300, 7, '2024-10-23 08:19:12', 'True'),
(7, 'T-Shirt and white trousers', 'Comfortable and stretchable T-shirt with white trousers. for casual wear', 'casual, comfortable, men, handsome, white, T-shirt, smart', 5, 1, 5, 'pro1.jpg', 'pro11.jfif', 'pro12.jfif', 700, 1, '2024-10-08 08:32:10', 'True'),
(8, 'Sherwani', 'Cotton sherwani', 'traditional, wedding, festival, men, trending, handsome, perfect.', 4, 1, 7, 'pro8.jpg', 'pro6.jpg', 'pro61.jpg', 700, 8, '2024-10-23 09:16:34', 'True'),
(13, 'Kids Night Wear', 'Colorful comfortable and cute night wear for kids', 'Matching, Kids, Night wear, cute, baby, pant, shirt', 5, 3, 10, 'k3-1.jfif', 'k3-2.jfif', 'k3-3.jfif', 700, 5, '2024-10-23 09:18:33', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section_title`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `address` varchar(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `address`, `order_date`, `order_status`) VALUES
(1, 2, 1000, 1626770695, 1, 'Chiplun', '2024-09-07 13:34:15', 'Complete'),
(2, 2, 700, 1751642134, 1, 'Chiplun', '2024-09-07 13:34:26', 'Complete'),
(3, 2, 2400, 613616516, 3, 'Chiplun', '2024-09-07 13:34:26', 'Complete'),
(4, 2, 1700, 747926537, 2, 'Chiplun', '2024-10-07 13:34:26', 'Complete'),
(5, 2, 1300, 1839911631, 2, 'Chiplun', '2024-10-07 13:34:26', 'Complete'),
(6, 2, 500, 565051438, 1, 'Chiplun', '2024-10-23 09:24:24', 'Complete'),
(7, 2, 3000, 2147007195, 1, 'Chiplun', '2024-10-23 09:24:29', 'Complete'),
(8, 2, 700, 1717990551, 1, 'Chiplun', '2024-10-23 09:24:34', 'Complete'),
(9, 2, 6000, 967764031, 1, 'Chiplun', '2024-10-07 13:34:26', 'pending'),
(10, 2, 3500, 751330279, 1, 'Chiplun', '2024-10-23 09:24:54', 'Complete'),
(11, 2, 700, 408181297, 1, 'Chiplun', '2024-10-07 13:34:26', 'pending'),
(12, 2, 1000, 427636101, 1, 'Chiplun', '2024-10-23 09:24:47', 'Complete'),
(13, 2, 1000, 189170398, 1, 'Chiplun', '2024-10-07 13:34:26', 'pending'),
(14, 2, 1000, 653112174, 1, 'Chiplun', '2024-10-07 13:34:26', 'pending'),
(18, 2, 4900, 874160356, 1, 'Chiplun', '2024-10-23 09:24:41', 'Complete'),
(19, 7, 4600, 1096437338, 5, 'chi', '2024-10-23 09:16:51', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 1, 1626770695, 1000, 'Pay Offline', '2024-08-02 09:29:32'),
(2, 2, 1751642134, 700, 'Pay Offline', '2024-08-02 09:29:32'),
(3, 3, 613616516, 2400, 'Pay Offline', '2024-08-02 09:29:32'),
(4, 4, 747926537, 1700, 'Pay Offline', '2024-09-02 09:29:32'),
(5, 5, 1839911631, 1300, 'UPI', '2024-09-02 09:29:32'),
(6, 19, 1096437338, 4600, 'Paypal', '2024-09-02 09:29:32'),
(7, 6, 565051438, 500, 'Pay Offline', '2024-10-23 09:24:24'),
(8, 7, 2147007195, 3000, 'Pay Offline', '2024-10-23 09:24:29'),
(9, 8, 1717990551, 700, 'Netbanking', '2024-10-23 09:24:34'),
(10, 18, 874160356, 4900, 'UPI', '2024-10-23 09:24:41'),
(11, 12, 427636101, 1000, 'Paypal', '2024-10-23 09:24:47'),
(12, 10, 751330279, 3500, 'Pay Offline', '2024-10-23 09:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_fullname` text NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_contact` bigint(10) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_fullname`, `user_email`, `user_image`, `password`, `user_contact`, `user_ip`, `user_address`) VALUES
(2, 'Nida', 'Nida Asif Chougle', 'nida@gmail.com', 'profile.jpg', '$2y$10$vpKt4mwgyYkieLdiozJM5egIZcGgpHEeol2pCrNwXQPbsOj1JsAnq', 9876543210, '127.0.0.1', 'Chiplun'),
(3, 'Nidz', 'Nida Asif Chougle', 'chouglenida@gmail.com', 'coder2_admin.jfif', '$2y$10$QCZSzCxH6WN7kywW/mDmrOxquwRIyFtcb0OwCcheQpvx4qrpyvCG6', 9171513211, '127.0.0.1', 'Chiplun'),
(4, 'Yasmeen', 'Yasmeen', 'yasu@gmail.com', 'coder_admin.jpg', '$2y$10$3OJue7HTrLiG6daxDVWPzuFzf1E3trgqwysaTb6v.pK3ly5sJryzu', 3216454987, '127.0.0.1', 'chiplun'),
(5, 'yasmeen asif chougle', 'yasmeen asif chougle', 'yasmeenchougle320@gmail.com', 'sideimg.png', '$2y$10$wYMS4UtXscRts.GGBsfPE.Mzn.HkBbbiOnCvazFEfSetB/e7iW6OG', 7276335009, '127.0.0.1', 'chiplun'),
(6, 'Kamran', 'kamran', 'kamran@gmail.com', 'img5.jfif', '$2y$10$yGCCfa066vNV9v1ZQz13qOlx28kS.VpcCj6j2qcGhVqcdmCERfhuy', 9876543210, '127.0.0.1', 'chi'),
(7, 'imran', 'imran', 'imii@gmail.com', 'img7.jfif', '$2y$10$j8nFYN8U0bOmEuXTb0HDd.26Tm9CDacnarDLTylmAkMuDkdXPuPwm', 9876543210, '127.0.0.1', 'chi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
