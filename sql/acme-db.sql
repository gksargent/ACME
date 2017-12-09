-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 09, 2017 at 11:19 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(1, 'Greg', 'Sargent', 'gksargent@gmail.com', '$2y$10$gIgvg2FTqlRDVkMKBXKXhOYne3W7fiN3A/ITSdrDLKeeS0CQgtF.G', '3', ''),
(2, 'Test', 'User', 'test@test.com', '$2y$10$D399P5JBQgQ6wlNZ1h.30uKyFPp5tF0tAPN7dn./c6FKLa/8Bl5se', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(13, 1, 'rocket.png', '/acme/images/products/rocket.png', '2017-12-02 23:26:56'),
(14, 1, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2017-12-02 23:26:56'),
(15, 8, 'anvil.png', '/acme/images/products/anvil.png', '2017-12-02 23:35:11'),
(16, 8, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2017-12-02 23:35:12'),
(17, 3, 'catapult.png', '/acme/images/products/catapult.png', '2017-12-02 23:35:27'),
(18, 3, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2017-12-02 23:35:27'),
(19, 14, 'helmet.png', '/acme/images/products/helmet.png', '2017-12-02 23:35:41'),
(20, 14, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2017-12-02 23:35:41'),
(21, 4, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2017-12-02 23:36:01'),
(22, 4, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2017-12-02 23:36:01'),
(23, 5, 'trap.jpg', '/acme/images/products/trap.jpg', '2017-12-02 23:36:25'),
(24, 5, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2017-12-02 23:36:25'),
(25, 13, 'piano.jpg', '/acme/images/products/piano.jpg', '2017-12-02 23:36:36'),
(26, 13, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2017-12-02 23:36:36'),
(27, 6, 'hole.png', '/acme/images/products/hole.png', '2017-12-02 23:36:47'),
(28, 6, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2017-12-02 23:36:47'),
(29, 7, 'koenigsegg.jpg', '/acme/images/products/koenigsegg.jpg', '2017-12-02 23:39:11'),
(30, 7, 'koenigsegg-tn.jpg', '/acme/images/products/koenigsegg-tn.jpg', '2017-12-02 23:39:11'),
(31, 10, 'mallet.png', '/acme/images/products/mallet.png', '2017-12-02 23:39:21'),
(32, 10, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2017-12-02 23:39:21'),
(33, 9, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2017-12-02 23:40:30'),
(34, 9, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2017-12-02 23:40:30'),
(35, 2, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2017-12-02 23:40:39'),
(36, 2, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2017-12-02 23:40:39'),
(37, 15, 'rope.jpg', '/acme/images/products/rope.jpg', '2017-12-02 23:40:54'),
(38, 15, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2017-12-02 23:40:54'),
(39, 12, 'seed.jpg', '/acme/images/products/seed.jpg', '2017-12-02 23:41:13'),
(40, 12, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2017-12-02 23:41:13'),
(41, 16, 'bomb.png', '/acme/images/products/bomb.png', '2017-12-02 23:41:28'),
(42, 16, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2017-12-02 23:41:28'),
(43, 11, 'tnt.png', '/acme/images/products/tnt.png', '2017-12-02 23:41:43'),
(44, 11, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2017-12-02 23:41:43'),
(45, 7, 'koenigsegg-2.jpg', '/acme/images/products/koenigsegg-2.jpg', '2017-12-03 00:49:44'),
(46, 7, 'koenigsegg-2-tn.jpg', '/acme/images/products/koenigsegg-2-tn.jpg', '2017-12-03 00:49:44'),
(47, 7, 'koenigsegg-3.jpg', '/acme/images/products/koenigsegg-3.jpg', '2017-12-03 00:49:52'),
(48, 7, 'koenigsegg-3-tn.jpg', '/acme/images/products/koenigsegg-3-tn.jpg', '2017-12-03 00:49:52'),
(49, 7, 'koenigsegg-4.jpg', '/acme/images/products/koenigsegg-4.jpg', '2017-12-07 15:13:51'),
(50, 7, 'koenigsegg-4-tn.jpg', '/acme/images/products/koenigsegg-4-tn.jpg', '2017-12-07 15:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invStock` smallint(6) NOT NULL DEFAULT '0',
  `invSize` smallint(6) NOT NULL DEFAULT '0',
  `invWeight` smallint(6) NOT NULL DEFAULT '0',
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Acme Rocket', 'The Acme Rocket meets multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast! Launch stand is included.', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '132000.00', 5, 60, 90, 'Albuquerque, New Mexico', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRuner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX Car', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/products/koenigsegg.jpg', '/acme/images/products/koenigsegg-tn.jpg', '99999999.99', 1, 25000, 3000, 'Stockholm, Sweden', 3, 'Koenigsegg', 'Metal'),
(8, 'Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '150.00', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs cannot resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(13, 'Grand Piano', 'This upright grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(16, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`,`invId`),
  ADD KEY `invId` (`invId`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_inv_categories` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
