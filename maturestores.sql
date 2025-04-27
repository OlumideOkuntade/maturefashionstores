-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 06:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maturestores`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_pwd` varchar(255) NOT NULL,
  `admin_loggedin` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_pwd`, `admin_loggedin`) VALUES
(1, 'OLUMIDE', '$2y$10$NLJLxP22LhPy21/fZGjj9uoksp2Z0gf83tCsswsp..1e6RknE2Rdu', '2025-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_userid` int(11) DEFAULT NULL,
  `cart_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_userid`, `cart_date`) VALUES
(2, 8, '2025-04-22 15:47:20'),
(3, 7, '2025-04-23 08:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `item_cartid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'T-shirts'),
(2, 'Jacket & Suits'),
(3, 'Short & Jean'),
(4, 'Hoodies');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `cust_stateid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `phone_number`, `email`, `city`, `password`, `cust_stateid`) VALUES
(1, 'Jacob', 'james', '08167546788', 'Jacobj@gmail.com', NULL, '1234', NULL),
(2, 'Toba', 'Anderson', '08167546788', 'Toba@gmail.com', NULL, '1234', NULL),
(3, 'Oreoluwa', 'Jayeola', '08167546788', 'Orejaye@gmail.com', NULL, '1234', NULL),
(4, 'Ruth', 'Peters', '08167546788', 'Ruth@gmail.com', NULL, '1234', NULL),
(5, 'Badmus', 'James', '098675433q1', 'badmus@gmail.com', NULL, '123456', NULL),
(6, 'Joy', 'Adeyanju', '09087651890', 'Adejoy@gmail.com', NULL, '1234', NULL),
(7, 'Ayomide', 'Adeyanju', '08167656711', 'Ayomide@gmail.com', NULL, '$2y$10$rIQuhJJ/rFlfGK7H1qTeQOezcwgkoq7IxgJa1sn2e2yhXdK3Gcm3q', NULL),
(8, 'Olumide', 'Kayode', '09123448491', 'Olukay@gmail.com', NULL, '$2y$10$3Xirl2mZ7QZfdUDGFCmGJO0uumKPc.ShprdVjGWp4CLej/hFs1AOm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT current_timestamp(),
  `order_amount` float DEFAULT NULL,
  `order_customerID` int(11) DEFAULT NULL,
  `order_size` varchar(255) DEFAULT NULL,
  `order_productid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_amount`, `order_customerID`, `order_size`, `order_productid`) VALUES
(1, '2025-04-05', 20000, 8, 'small', 3),
(39, '2025-04-22', 35000, 8, 'medium', 3),
(40, '2025-04-22', 35000, 8, 'medium', 3),
(41, '2025-04-22', 35000, 8, 'medium', 3),
(42, '2025-04-22', 35000, 8, 'medium', 3),
(43, '2025-04-22', 170000, 8, 'small', 9),
(44, '2025-04-24', 68000, 7, 'small', 4),
(45, '2025-04-24', 115000, 8, 'small', 12);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date DEFAULT current_timestamp(),
  `payment_amount` float DEFAULT NULL,
  `payment_cusid` int(11) NOT NULL,
  `payment_status` enum('Pending','Paid','Failed') NOT NULL DEFAULT 'Pending',
  `payment_ref` varchar(100) NOT NULL,
  `payment_orderid` int(11) NOT NULL,
  `payment_data` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_amount`, `payment_cusid`, `payment_status`, `payment_ref`, `payment_orderid`, `payment_data`) VALUES
(1, '2025-04-06', 16000, 8, 'Pending', 'REF/67f2d076c06f4', 7, NULL),
(2, '2025-04-06', 16000, 8, 'Pending', 'REF/67f2d0b6b1ac8', 7, NULL),
(3, '2025-04-11', 35000, 8, 'Pending', 'REF/67f980fe62c33', 16, NULL),
(17, '2025-04-16', 10000, 8, 'Pending', 'REF67ff6356584a1', 21, NULL),
(18, '2025-04-16', 10000, 8, 'Pending', 'REF67ff637cebed1', 22, NULL),
(19, '2025-04-21', 10000, 8, 'Pending', 'REF680663811beba', 36, NULL),
(20, '2025-04-21', 10000, 8, 'Paid', 'REF680664212ca00', 37, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":4892672971,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"REF680664212ca00\",\"receipt_number\":null,\"amount\":1000000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-04-21T15:28:47.000Z\",\"created_at\":\"2025-04-21T15:28:34.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.89.34.213\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1745249317,\"time_spent\":10,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":9},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":10}]},\"fees\":25000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_e3eax75m8x\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_sTCY6bk0fKpJ7t68vFj8\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":264854875,\"first_name\":null,\"last_name\":null,\"email\":\"olukay@gmail.com\",\"customer_code\":\"CUS_itucct9lth5ybba\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":{},\"order_id\":null,\"paidAt\":\"2025-04-21T15:28:47.000Z\",\"createdAt\":\"2025-04-21T15:28:34.000Z\",\"requested_amount\":1000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-04-21T15:28:34.000Z\",\"plan_object\":{},\"subaccount\":{}}}'),
(21, '2025-04-22', 35000, 8, 'Pending', 'REF6807975f9318e', 38, NULL),
(22, '2025-04-22', 35000, 8, 'Pending', 'REF6807976448f45', 39, NULL),
(23, '2025-04-22', 35000, 8, 'Pending', 'REF68079767cb5d8', 40, NULL),
(24, '2025-04-22', 35000, 8, 'Pending', 'REF6807976958828', 41, NULL),
(25, '2025-04-22', 35000, 8, 'Paid', 'REF68079801c94a0', 42, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":4895108476,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"REF68079801c94a0\",\"receipt_number\":null,\"amount\":3500000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-04-22T13:27:10.000Z\",\"created_at\":\"2025-04-22T13:22:10.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.89.34.213\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1745328135,\"time_spent\":297,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":296},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":297}]},\"fees\":62500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_7ygf4a4cr2\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_sTCY6bk0fKpJ7t68vFj8\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":264854875,\"first_name\":null,\"last_name\":null,\"email\":\"olukay@gmail.com\",\"customer_code\":\"CUS_itucct9lth5ybba\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":{},\"order_id\":null,\"paidAt\":\"2025-04-22T13:27:10.000Z\",\"createdAt\":\"2025-04-22T13:22:10.000Z\",\"requested_amount\":3500000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-04-22T13:22:10.000Z\",\"plan_object\":{},\"subaccount\":{}}}'),
(26, '2025-04-22', 170000, 8, 'Paid', 'REF6807c2a9a868d', 43, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":4895431851,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"REF6807c2a9a868d\",\"receipt_number\":null,\"amount\":17000000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-04-22T16:24:17.000Z\",\"created_at\":\"2025-04-22T16:24:10.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.89.34.213\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1745339054,\"time_spent\":3,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":3},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":3}]},\"fees\":200000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_rgzfgxtvh1\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_sTCY6bk0fKpJ7t68vFj8\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":264854875,\"first_name\":null,\"last_name\":null,\"email\":\"olukay@gmail.com\",\"customer_code\":\"CUS_itucct9lth5ybba\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":{},\"order_id\":null,\"paidAt\":\"2025-04-22T16:24:17.000Z\",\"createdAt\":\"2025-04-22T16:24:10.000Z\",\"requested_amount\":17000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-04-22T16:24:10.000Z\",\"plan_object\":{},\"subaccount\":{}}}'),
(27, '2025-04-24', 68000, 7, 'Paid', 'REF680a1ada5330f', 44, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":4900287000,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"REF680a1ada5330f\",\"receipt_number\":null,\"amount\":6800000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-04-24T11:05:12.000Z\",\"created_at\":\"2025-04-24T11:04:59.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.89.45.178\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1745492703,\"time_spent\":10,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":9},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":10}]},\"fees\":112000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_ukt0gqmqq4\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_sTCY6bk0fKpJ7t68vFj8\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":265876083,\"first_name\":null,\"last_name\":null,\"email\":\"ayomide@gmail.com\",\"customer_code\":\"CUS_6x37g4a48wcuas8\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":{},\"order_id\":null,\"paidAt\":\"2025-04-24T11:05:12.000Z\",\"createdAt\":\"2025-04-24T11:04:59.000Z\",\"requested_amount\":6800000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-04-24T11:04:59.000Z\",\"plan_object\":{},\"subaccount\":{}}}'),
(28, '2025-04-24', 115000, 8, 'Paid', 'REF680a256cc3ac8', 45, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":4900447402,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"REF680a256cc3ac8\",\"receipt_number\":null,\"amount\":11500000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-04-24T11:50:32.000Z\",\"created_at\":\"2025-04-24T11:50:06.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.89.45.178\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1745495418,\"time_spent\":21,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":6},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":21}]},\"fees\":182500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_br39jfjfwl\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_sTCY6bk0fKpJ7t68vFj8\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":264854875,\"first_name\":null,\"last_name\":null,\"email\":\"olukay@gmail.com\",\"customer_code\":\"CUS_itucct9lth5ybba\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":{},\"order_id\":null,\"paidAt\":\"2025-04-24T11:50:32.000Z\",\"createdAt\":\"2025-04-24T11:50:06.000Z\",\"requested_amount\":11500000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-04-24T11:50:06.000Z\",\"plan_object\":{},\"subaccount\":{}}}');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_image` varchar(45) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_quantity` float DEFAULT NULL,
  `product_status` varchar(45) DEFAULT NULL,
  `product_categoryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `product_status`, `product_categoryid`) VALUES
(2, 'Brown T-shirt', '../uploads/t-shirt-mockup.jpg', 15000, 15, 'active', 1),
(3, 'Typography t-shirt', '../uploads/typography_tshirt.jpg', 10000, 10, 'active', 1),
(4, 'mtn tshirt', '../uploads/mtn_tshirt.jpg', 8000, 5, 'active', 1),
(5, 'black man hoodie', '../uploads/hoodie_black.jpg', 30000, 15, 'active', 4),
(6, 'green hoodie', '../uploads/green_hoodie.jpg', 28000, 14, 'active', 4),
(7, 'pink hoodie', '../uploads/pink_hoodie.jpg', 35000, 27, 'active', 4),
(8, 'green suit', '../uploads/green_suit.jpeg', 85000, 10, 'active', 2),
(9, 'classico suit', '../uploads/classico_suit.jpg', 70000, 20, 'active', 2),
(10, 'jean jacket', '../uploads/blue_jacket.jpg', 20000, 35, 'active', 2),
(11, 'green radiant jacket', '../uploads/green_jacket.jpg', 35000, 20, 'active', 2),
(12, 'Jean', '../uploads/jeans-on-wh.jpg', 15000, 30, 'active', 3),
(13, 'shirt', '../uploads/mtn_tshirt.jpg', 5000, 50, 'active', 1),
(14, 'Jacket', '../uploads/blue_jacket.jpg', 15000, 20, 'active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `FK_CartItem` (`item_cartid`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `custstateid_idx` (`cust_stateid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_customer_order_idx` (`order_customerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `prodd_idx` (`product_categoryid`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `FK_CartItem` FOREIGN KEY (`item_cartid`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `custstateid` FOREIGN KEY (`cust_stateid`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_customer_order` FOREIGN KEY (`order_customerID`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `prodd` FOREIGN KEY (`product_categoryid`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
