-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 10:45 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user1` bigint(20) UNSIGNED NOT NULL,
  `user2` bigint(20) UNSIGNED NOT NULL,
  `block` varchar(255) NOT NULL DEFAULT 'no',
  `blocked_from1` bigint(20) UNSIGNED DEFAULT NULL,
  `blocked_from2` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_from1` bigint(20) UNSIGNED DEFAULT NULL,
  `time1` timestamp NULL DEFAULT NULL,
  `deleted_from2` bigint(20) UNSIGNED DEFAULT NULL,
  `time2` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user1`, `user2`, `block`, `blocked_from1`, `blocked_from2`, `deleted_from1`, `time1`, `deleted_from2`, `time2`) VALUES
(50, 21, 24, 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 17, 18, 'no', NULL, NULL, 17, '2021-04-09 00:00:01', 18, '2021-04-08 23:59:38'),
(71, 17, 19, 'yes', NULL, 19, 17, '2021-04-08 22:50:22', NULL, NULL),
(72, 19, 18, 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(73, 17, 24, 'no', NULL, NULL, 24, '2021-04-12 11:56:50', 17, '2021-04-12 11:18:28'),
(74, 24, 18, 'no', NULL, NULL, 24, '2021-04-08 23:47:08', 18, '2021-04-08 23:46:48'),
(75, 21, 25, 'no', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user` bigint(20) UNSIGNED NOT NULL,
  `to_user` bigint(20) UNSIGNED NOT NULL,
  `body` varchar(10000) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unread',
  `files` varchar(255) DEFAULT NULL,
  `c1` varchar(255) DEFAULT NULL,
  `c2` varchar(255) DEFAULT NULL,
  `c3` varchar(255) DEFAULT NULL,
  `deleted_from` bigint(20) UNSIGNED DEFAULT NULL,
  `oldName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `body`, `time`, `chat_id`, `status`, `files`, `c1`, `c2`, `c3`, `deleted_from`, `oldName`) VALUES
(449, 21, 24, 'VA5ShBUe+YQp3PhxgcWAsZTrkY8Fq00i/ySxVFxkC3M+xv90JZc0Zawc3lTwj5qQ6/Qz62x1ATkUE13HPMym5sm8PP5m3r19XVMji38K/etYMTbVmD81oZUfijOZuyEPNwwHleC7W7sQZF3r+81fcrr2', '2021-04-04 19:41:43', 50, 'read', NULL, 'l|????????(??????t', '????\rz=????A', 'x????ui:Jo????????+??????', NULL, NULL),
(450, 19, 17, 'jS8=', '2021-04-04 22:05:27', 71, 'read', NULL, 'zN??Y??@G??\n????', '????ZW;.}.????', '????Ky?? ????o??????????C', NULL, NULL),
(451, 19, 17, 'qVQysXpkOy6rswbpQfmLBu2nS3KuUB+fNzs=', '2021-04-04 22:05:40', 71, 'read', NULL, '????????&D??K:Y??Z', '????????????O????', 'E~F??\'??????????\';x??m', NULL, NULL),
(452, 19, 18, 'DdU=', '2021-04-04 22:10:55', 72, 'read', NULL, 'g\0S??????qh??????', '????f????????f??', 'D??????.????l????\r?? 7-??', NULL, NULL),
(453, 19, 18, 'dqc=', '2021-04-04 22:11:10', 72, 'read', NULL, '????????$??p+????', '??????<????6|', '????\nAcAN\Z??????0D??', NULL, NULL),
(468, 18, 19, 'uX8=', '2021-04-06 11:43:10', 72, 'unread', NULL, '????????F!j??', '??j??^??????PJ', '??????4\\????????????????J??A', NULL, NULL),
(498, 24, 17, 'SSg=', '2021-04-12 11:53:19', 73, 'read', NULL, '??#??~H??????', '????|????eN??????', '??*$p??0&??????[G??', NULL, NULL),
(499, 17, 24, 'Wns=', '2021-04-12 11:54:22', 73, 'read', NULL, '??lj????|????????', '8??????$??b??', '??????????????818h??????', NULL, NULL),
(500, 17, 24, 'uFw=', '2021-04-12 11:54:32', 73, 'read', NULL, '????????G??[??u??	', 'r????????????????', '??????[iW??f?????&[??', NULL, NULL),
(501, 24, 17, 'JaE=', '2021-04-12 11:54:42', 73, 'read', NULL, '{X????????????A', '??????.??????=????', '(??????+=D??????^', NULL, NULL),
(502, 24, 17, '3HY=', '2021-04-12 11:55:00', 73, 'read', NULL, 'g???? @??O??????\'', '\n1????????????', '#??~????A9??f????????????%', NULL, NULL),
(503, 17, 24, 'dPM=', '2021-04-12 11:55:31', 73, 'read', NULL, '??{??????????)??7\r:', '??????T????5VB', 'h??\'????w????.Xc??\"\'??', NULL, NULL),
(504, 24, 17, 'GUQ=', '2021-04-12 11:55:38', 73, 'read', NULL, '??S??\\????P????', 'Eu1B??%>??{??', '??)??N2??+??????????????', NULL, NULL),
(505, 24, 17, 'G1Y=', '2021-04-12 11:56:55', 73, 'read', NULL, '??yj????(o????', '0??;}??????\'\Z', '??\"n????\r????????????E????', 24, NULL),
(506, 24, 17, 'YpD4aq31wr7QfH3BVrTgeaEp', '2021-04-12 15:34:38', 73, 'read', NULL, 'I??Y9E.j??:D*', '\'????????m??r????', '??????H??E_`[`??;????', NULL, NULL),
(507, 17, 24, 'An0lgG0=', '2021-04-12 15:35:07', 73, 'read', NULL, '??aQ\r????4{????*I', '??f,??d??v????p', '{????Z??b????)????????%????', NULL, NULL),
(508, 24, 17, 'o4/s9w==', '2021-04-12 16:12:21', 73, 'read', NULL, 'm????e??????6[??3', '????????md????<', '??j\n2????s??0??', NULL, NULL),
(509, 24, 17, 'V5R3VA==', '2021-04-12 16:12:28', 73, 'read', NULL, 'f??v??4Kd??x??', '??????????????4o', 'X??hu????cLdh??????', NULL, NULL),
(510, 24, 17, 'WjOMiA==', '2021-04-12 16:13:24', 73, 'read', NULL, 'e??|t??)????????W??', '????e??????????', '\0????\0????????;qW??????2', NULL, NULL),
(511, 24, 17, 'p8A2QEFK4H65CwhvjEYDlipZ0w==', '2021-04-12 16:13:37', 73, 'read', NULL, '????e????+??X\Z??d', '\'z??????\'N??', 'r????????Z??M????????????', NULL, NULL),
(512, 24, 17, 'b9XE', '2021-04-12 16:17:38', 73, 'read', NULL, '??????OV????	??R', '????????N????H^', '??????ns????0%??LO', NULL, NULL),
(513, 24, 17, '5GrMrg==', '2021-04-12 16:34:14', 73, 'read', NULL, '????2??y????????5', '??????????????', 'X????>+??e??\n]??|????', NULL, NULL),
(514, 24, 17, '6vX9XSAD', '2021-04-12 16:55:03', 73, 'read', NULL, '??V????????h??????b', '??????<r??\n\Z??\0', 'o??????mYJ??H??????r_+a', NULL, NULL),
(515, 24, 17, 'mhmiH81NUjIcGGNqk2i0EeXzNTPBOOU=', '2021-04-12 16:55:15', 73, 'read', NULL, '[??<??KL??%????4', '??w????w????|f', '??????n????????\r)??x', NULL, NULL),
(516, 17, 24, 'DVWsWA==', '2021-04-12 16:55:37', 73, 'read', NULL, '????????[p??1??h', '??????S??????k??', 'E_U??j1/??\n[??????Tmk', NULL, NULL),
(517, 21, 25, 'Svf95yp0B6MBXK9MKUtFOXrWzayblxd1kFskhINY8a4D7ZMAmMqr4kNP1n7FFCwKQ6/UY24bS4b/FGXbWspfEiGqLKkOd08N5GLxub7BvN9MEJgjqfePmbJEN3QK8u+cdOWXZb4/1o5uHmZ0Plizvic7', '2021-04-12 17:28:05', 75, 'read', NULL, '??.??????\Z????jP??', 'fIz\\????C^K', '??????G??S??K??????*????', NULL, NULL),
(518, 24, 17, '2ZY=', '2021-07-10 18:40:41', 73, 'read', NULL, '????????q????iYn', '????p????A??x', 'X????????+1??????????????', NULL, NULL),
(519, 17, 24, 'fTL4KA==', '2021-07-10 18:43:51', 73, 'read', NULL, '.????8??????????', '??)9????????\0????', '????i???? QVt??*??z????2', NULL, NULL),
(520, 24, 17, '97c=', '2021-07-10 18:44:19', 73, 'read', NULL, '??\\??K??,#Vdj??', '??M??)\Z]??\"??', 'a????B??c^fRv?@??\\0', NULL, NULL),
(521, 17, 24, 'RS8N', '2021-07-10 18:44:37', 73, 'read', NULL, '????????pQG6??M_', '??????T??????Dr??', 'I3i~1O+-r????)e????', NULL, NULL),
(522, 24, 17, 'AlyW1LLiDZNcjhJp0kNEwJ4=', '2021-07-10 18:44:55', 73, 'read', NULL, '????:;N??[??mbS', '??lO??R\"????', 'H>~????L??o????V??=????', NULL, NULL),
(523, 24, 17, 'e3o=', '2021-07-10 18:58:31', 73, 'read', NULL, '????B??Q????4????4q', '??i0??tnB', '????rZ??&		??Q{CU??', NULL, NULL),
(524, 24, 17, NULL, '2021-07-10 18:58:36', 73, 'read', 'CG_60e9eddcd74af.wav', NULL, NULL, NULL, NULL, NULL),
(525, 24, 17, NULL, '2021-07-10 18:58:40', 73, 'read', 'CG_60e9ede0dabe1.wav', NULL, NULL, NULL, NULL, NULL),
(526, 24, 17, NULL, '2021-07-10 18:59:31', 73, 'read', 'CG_60e9ee130c32e.png', NULL, NULL, NULL, NULL, 'logo.png'),
(527, 17, 24, NULL, '2021-07-10 19:01:04', 73, 'read', 'CG_60e9ee7073cc9.wav', NULL, NULL, NULL, 17, NULL),
(530, 17, 24, 'VLatgP4=', '2021-07-10 20:31:49', 73, 'read', NULL, '??dmm	??[??l????', '????W]GS????3y', '??????^????$??x??k??f@??}', NULL, NULL),
(531, 24, 17, NULL, '2021-07-10 20:31:58', 73, 'read', 'CG_60ea03bee18c7.wav', NULL, NULL, NULL, NULL, NULL),
(532, 24, 17, '3uSQwukvO2Y=', '2021-07-10 20:42:19', 73, 'read', NULL, 'h&??\Z????????????????', 'e:??1??????????', '????b?? ??_????]_????`', NULL, NULL),
(533, 24, 17, NULL, '2021-07-10 20:42:25', 73, 'read', 'CG_60ea063183525.wav', NULL, NULL, NULL, 17, NULL),
(534, 17, 24, NULL, '2021-07-10 20:43:36', 73, 'read', 'CG_60ea0678ef4ee.wav', NULL, NULL, NULL, 24, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'Blank-Avatar.png',
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `only_me` varchar(255) NOT NULL DEFAULT 'no',
  `about` varchar(255) DEFAULT NULL,
  `lastSeen_onlyMe` varchar(255) NOT NULL DEFAULT 'no',
  `is_type` bigint(20) UNSIGNED DEFAULT NULL,
  `is_recording` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `password`, `role`, `status`, `only_me`, `about`, `lastSeen_onlyMe`, `is_type`, `is_recording`) VALUES
(17, 'samir ebrahim', 'admin2@admin.com', '01020203477', 'user_profile60ea06639d94a.webp', '$2y$10$IPsURMOm8zJ/PO2lcQ4iOe0GYwwC8uQ5AJ7MJD34TNQxOgnvimuL.', NULL, '2021-07-10 22:43 pm', 'no', 'this is pio', 'no', NULL, NULL),
(18, 'ahmed', 'admin3@admin.com', '01024416335', 'Blank-Avatar.png', '$2y$10$R70xyJCpyS.76fTUrVSbwOiyKhuGeO7Qg7egrChO3OOzuFq.N2qFW', NULL, '2021-04-09 02:17 am', 'yes', 'I\'m Web developer', 'no', NULL, NULL),
(19, 'amr', 'admin4@admin.com', '01025824254', 'Blank-Avatar.png', '$2y$10$75sKZo5oXiGsF6MxP2l7WerNhjsHt3hZAbvZoEimmHSpi4obivWLC', NULL, '2021-04-09 01:30 am', 'no', NULL, 'no', NULL, NULL),
(21, 'Chat go', 'chatgo@gmail.com', '01033324218', 'apple-touch-icon.png', '$2y$10$WAp8Tm.5UAQJW.OS8zHmbeLZMGw.jI9WGPYQGynCJahXWJNs7guH2', NULL, '2021-04-04 21:33 pm', 'yes', NULL, 'no', NULL, NULL),
(24, 'Red Doe', 'samir@example.com', '01144435326', 'user_profile60ea033e3fbe2.webp', '$2y$10$0ikvDXZermcopZV3tSJevefRdpTCK8Hp2rR0orKFaih2yg15euZRO', NULL, '2021-07-10 22:43 pm', 'no', '???????? ???????? ???????? ???????????????????? ???????? ?? ???????? ????????', 'no', NULL, NULL),
(25, 'Gfbbh Vbjju', 'samirhussein@gmail.com', '653578', 'Blank-Avatar.png', '$2y$10$rGjpKeJnx4vqTOhk8/mpSOgOzBU0wirTlQPt9/3.mq9RKPTWt7zcS', NULL, '2021-04-12 19:28 pm', 'no', NULL, 'no', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_ibfk_1` (`user1`),
  ADD KEY `chat_ibfk_2` (`user2`),
  ADD KEY `chat_ibfk_3` (`blocked_from2`),
  ADD KEY `chat_ibfk_4` (`blocked_from1`),
  ADD KEY `chat_ibfk_5` (`deleted_from1`),
  ADD KEY `chat_ibfk_6` (`deleted_from2`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user` (`from_user`),
  ADD KEY `to_user` (`to_user`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `deleted_from` (`deleted_from`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_type` (`is_type`),
  ADD KEY `is_recording` (`is_recording`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_3` FOREIGN KEY (`blocked_from2`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_4` FOREIGN KEY (`blocked_from1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_5` FOREIGN KEY (`deleted_from1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_6` FOREIGN KEY (`deleted_from2`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_4` FOREIGN KEY (`deleted_from`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`is_type`) REFERENCES `chat` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`is_recording`) REFERENCES `chat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
