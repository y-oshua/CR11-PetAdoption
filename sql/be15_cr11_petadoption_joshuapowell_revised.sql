-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 03:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be15_cr11_petadoption_joshuapowell_revised`
--
CREATE DATABASE IF NOT EXISTS `be15_cr11_petadoption_joshuapowell_revised` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be15_cr11_petadoption_joshuapowell_revised`;

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `adoption_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`adoption_id`, `fk_animal_id`, `fk_user_id`, `date`) VALUES
(6, 4, 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `location`, `description`, `size`, `age`, `hobbies`, `breed`, `picture`) VALUES
(1, 'Bella', 'San Marcos', 'Strong, smart, lovely', 'Tiny. Weight: 5 lbs', 7, 'Eating, exploring, meowing', 'Shorthair', 'bella.jpg'),
(2, 'Mila', 'Vienna', 'Loveable, good energy, doggo', 'Small. Weight: 25 lbs', 3, 'Getting in the way, sleeping', 'Mixed', 'mila.jpg'),
(3, 'Wolfie', 'San Marcos', 'Male cat, big appetite, cutie pie', 'Thin. Weight: 6 lbs', 8, 'Relaxing, cuddling, exploring', 'Shorthair', 'wolfie.jpg'),
(4, 'OG', 'Vienna', 'Need of loving home, a bit old, worn out', 'Chonky. Weight: 35 lbs', 12, 'Panting, coughing, lounging', 'N/A', 'og.jpg'),
(5, 'Snuggles', 'Wonderland', 'Perfect cat, loves X-mas', 'Medium. 8 lbs', 6, 'Purring, cuddling, hunting', 'Tabby', 'snuggles.jpg'),
(6, 'Charles', 'Houston', 'Above average lizard', 'Fits in your hand', 1, 'Likes to bask', 'Yellow Lizard', 'lizard.jpg'),
(7, 'Radish', 'Austin', 'Big boi, likes to eat veggies', 'Large. 200 lbs', 40, 'Knocking down owner, chewing on grass, looking cute', 'Asian Razorface Tortoise', 'tortoise.jpg'),
(8, 'Larry', 'Austin', 'Super smart, too cool for school', 'Medium. 15 lbs', 8, 'Hooting, reading, eating mice', 'Great Horned Owl', 'larry.jpg'),
(9, 'Jim Bob', 'Back alley', 'This racoon is easy to please', 'Thick. 15 lbs', 4, 'Rummaging, munching, hanging out', 'Coon', 'jimbob.jpg'),
(10, 'Smiles', 'Vienna', 'Boa without a soul', '4 ft long. 10 lbs', 2, 'Basks-a-lot, eats mice, worships satan', 'Boa Constrictor Imperator', 'smiles.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `postal_code` int(15) NOT NULL,
  `city` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `date_of_birth`, `email`, `phone_number`, `address`, `address2`, `postal_code`, `city`, `picture`, `password`, `status`) VALUES
(1, 'Joshua', 'Admin', '1987-07-11', 'joshua@admin.com', '555-555-5555', '19507 Evergreen Dr', '', 77379, 'Spring', 'admavatar.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'adm'),
(2, 'Jimmy', 'User', '2004-01-29', 'jimmy@user.com', '5225335454', '6978 Brooklyn Way', 'Apt 319', 60210, 'New York', 'bizarro.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(3, 'Sandy', 'Surname', '2002-01-02', 'sandypandy@email.com', '5125335494', '17 Dont Know Rd', '', 54546, 'Seattle', 'sandy.jpg', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(4, 'George', 'Test', '2013-12-31', 'george@test.com', '5221223656', 'Ostendeweg', '', 2384, 'Breitenfurt bei Wien', '62443731403ac.jpeg', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
