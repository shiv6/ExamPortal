-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 04:56 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `rollno` varchar(10) DEFAULT NULL,
  `a1` int(2) DEFAULT NULL,
  `a2` int(2) DEFAULT NULL,
  `a3` int(2) DEFAULT NULL,
  `a4` int(2) DEFAULT NULL,
  `a5` int(2) DEFAULT NULL,
  `a6` int(2) DEFAULT NULL,
  `a7` int(2) DEFAULT NULL,
  `a8` int(2) DEFAULT NULL,
  `a9` int(2) DEFAULT NULL,
  `a10` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ques` varchar(1000) DEFAULT NULL,
  `op1` varchar(200) DEFAULT NULL,
  `op2` varchar(200) DEFAULT NULL,
  `op3` varchar(200) DEFAULT NULL,
  `op4` varchar(200) DEFAULT NULL,
  `ans` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ques`, `op1`, `op2`, `op3`, `op4`, `ans`) VALUES
('What is the worst case time comlexity for search, insert and delete operations in a general Binary Search Tree', 'O(n) for all', 'O(Log n) for all', 'O(Log n) for search and insert, and O(n) for delete', 'O(Log n) fro search, and O(n) for delete and insert', 1),
('How many distinct binary search trees can be created out of 4 distinct keys?', '4', '14', '24', '42', 2),
('Which of the following traversal outputs the data in sorted order in a BST?', 'Preorder', 'Inorder', 'Postorder', 'Level Order', 2),
('The preorder traversal sequence of a binary search tree is 30, 20, 10, 15, 25, 23, 39, 35, 42. Which one of the following is the postorder traversal sequence of the same tree?', '10, 20, 15 23, 35, 42, 39, 30', '15, 10, 25, 23, 20, 42, 35, 39, 30', '15, 20, 10, 23, 25, 42, 35, 39, 30', '15, 10, 23, 25, 20, 35, 42, 39, 30', 4),
('The worst case running time to search for an element in a balanced in a binary search tree with n2^n elements is', 'O(nlog n)', 'O(n2^n)', 'O(n)', 'O(log n)', 3),
('What is the maximum height of any AVL-tree with 7 nodes? Assume that the height of a tree with a single node is 0.', '2', '3', '4', '5', 2),
('What is the worst case possible height of AVL tree?', '1.44Log n', '2Log n', 'Depends upon implementation', 'Theta(n)', 1),
('Which one of the following is an application of Stack Data Structure?', 'Managing function calls', 'The stock span problem', 'Arithmetic expression evaluation', 'All of the above', 4),
('Which data structure is used for balancing of symbols?', 'Stack', 'Queue', 'Tree', 'Graph', 1),
('The concatenation of two lists is to be performed in O(1) time. Which of the following implementations of a list should be used?', 'Singly linked list', 'Doubly linked list', 'Circular doubly linked list', 'Array implementation of lists', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(50) DEFAULT NULL,
  `course` varchar(5) DEFAULT NULL,
  `semester` varchar(5) DEFAULT NULL,
  `rollno` varchar(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `marks` decimal(5,2) DEFAULT NULL,
  `visited` tinyint(1) DEFAULT '0',
  `starts_at` int(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`rollno`),
  ADD UNIQUE KEY `email` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
