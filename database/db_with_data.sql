SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `db_codeigniter_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int NOT NULL,
  `user_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_status` tinyint NOT NULL DEFAULT '0' COMMENT '0 - Pending,1= Active, 2 - Blocked',
  `user_token` text NOT NULL,
  `user_token_expire_on` timestamp NOT NULL,
  `user_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users` MODIFY `user_id` int NOT NULL AUTO_INCREMENT;


INSERT INTO `tbl_users` (`user_id`, `user_email`, `user_password`, `user_status`, `user_token`, `user_token_expire_on`, `user_updated_on`, `user_added_on`) VALUES (NULL, 'anuj877@yahoo.com', MD5('Anuj$123'), '1', '123456abcdefghijklmnop', '2021-10-02 21:58:47', CURRENT_TIMESTAMP, '2021-10-02 19:58:47');