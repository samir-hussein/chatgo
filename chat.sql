-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 10:35 PM
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
(449, 21, 24, 'VA5ShBUe+YQp3PhxgcWAsZTrkY8Fq00i/ySxVFxkC3M+xv90JZc0Zawc3lTwj5qQ6/Qz62x1ATkUE13HPMym5sm8PP5m3r19XVMji38K/etYMTbVmD81oZUfijOZuyEPNwwHleC7W7sQZF3r+81fcrr2', '2021-04-04 19:41:43', 50, 'read', NULL, 'l|»´(¹t', 'ÍÐ\rz=§ÉA', 'x³ui:JoîÄ+¦à', NULL, NULL),
(450, 19, 17, 'jS8=', '2021-04-04 22:05:27', 71, 'read', NULL, 'zN³Yñ@GÌ\nûß', 'ÀZW;.}.¸Å', '»ÉKy òo»íÙC', NULL, NULL),
(451, 19, 17, 'qVQysXpkOy6rswbpQfmLBu2nS3KuUB+fNzs=', '2021-04-04 22:05:40', 71, 'read', NULL, '­Ü&DÇK:YîZ', 'ÀäÈùìOÊ¨', 'E~Fô\'¯ß½¨\';xÇm', NULL, NULL),
(452, 19, 18, 'DdU=', '2021-04-04 22:10:55', 72, 'read', NULL, 'g\0SÎªqhâ', 'ÛfïÚfã', 'Dàà.£²l·\r 7-Ô', NULL, NULL),
(453, 19, 18, 'dqc=', '2021-04-04 22:11:10', 72, 'read', NULL, '·ÝÄá$p+¯æ', 'âè<Å¸6|', '¢¼\nAcAN\ZÆÑã0D', NULL, NULL),
(468, 18, 19, 'uX8=', '2021-04-06 11:43:10', 72, 'unread', NULL, 'ú¦F!j', 'àjë^åPJ', 'ï³4\\ýàýÈ½ûóJòA', NULL, NULL),
(498, 24, 17, 'SSg=', '2021-04-12 11:53:19', 73, 'read', NULL, 'õ#ë~HÛÃ', ' Û|ÎeNË', 'É*$pè0&å·Ã[G', NULL, NULL),
(499, 17, 24, 'Wns=', '2021-04-12 11:54:22', 73, 'read', NULL, '÷ljò| ûý', '8àûû$Èb«', '³çËýÕ§818hÛèÉ', NULL, NULL),
(500, 17, 24, 'uFw=', '2021-04-12 11:54:32', 73, 'read', NULL, 'ÙþÌG²[uÿ	', 'r¦ÙõÁÚÕ¡', 'ë¿[iW¹f?¢ù&[¨', NULL, NULL),
(501, 24, 17, 'JaE=', '2021-04-12 11:54:42', 73, 'read', NULL, '{X¯ãõúA', 'íçÉ.ûê¿=åå', '(§÷+=Dì^', NULL, NULL),
(502, 24, 17, '3HY=', '2021-04-12 11:55:00', 73, 'read', NULL, 'gº§ @µOÐðÓ\'', '\n1õè´Úß', '#~¯ÖA9ÏfÆÒ×ÓÑ%', NULL, NULL),
(503, 17, 24, 'dPM=', '2021-04-12 11:55:31', 73, 'read', NULL, '¼{ÌÎ)Ì7\r:', 'ÃÓTÂ5VB', 'h\'¤wåè.Xc\"\'Þ', NULL, NULL),
(504, 24, 17, 'GUQ=', '2021-04-12 11:55:38', 73, 'read', NULL, '¾S¿\\¨P', 'Eu1Bå%>Ì{ÿ', ')N2¡+Ìò£¼°ñÓ', NULL, NULL),
(505, 24, 17, 'G1Y=', '2021-04-12 11:56:55', 73, 'read', NULL, 'ºyj(oãØ', '0Ò;}÷×\'\Z', 'º\"nóã\rÒ°ÿÕEÉ¶', 24, NULL),
(506, 24, 17, 'YpD4aq31wr7QfH3BVrTgeaEp', '2021-04-12 15:34:38', 73, 'read', NULL, 'IÅY9E.jÝ:D*', '\'¬éÈmßr·', '¨è¯HE_`[`;àî', NULL, NULL),
(507, 17, 24, 'An0lgG0=', '2021-04-12 15:35:07', 73, 'read', NULL, '¡aQ\r á4{ÕÂ*I', '¤f,Êd¤vÃp', '{ÙZÁb£Á)´ïÿ%Öð', NULL, NULL),
(508, 24, 17, 'o4/s9w==', '2021-04-12 16:12:21', 73, 'read', NULL, 'm±ÿe·6[3', '×¥÷ûmdúÔ<', 'øj\n2ªõsÊ0»', NULL, NULL),
(509, 24, 17, 'V5R3VA==', '2021-04-12 16:12:28', 73, 'read', NULL, 'fËvÜ4Kdøx¯', '¿ÿä¹åë¢4o', 'XçhucLdh®Ï÷', NULL, NULL),
(510, 24, 17, 'WjOMiA==', '2021-04-12 16:13:24', 73, 'read', NULL, 'eÈ|tÔ)ãðW²', '»µeòõÙä', '\0ØÀ\0³ã ;qW¡²2', NULL, NULL),
(511, 24, 17, 'p8A2QEFK4H65CwhvjEYDlipZ0w==', '2021-04-12 16:13:37', 73, 'read', NULL, ' ýeúÕ+®X\ZÁd', '\'zé\'N¬', 'rÕüZÒM±°ÑÑÞ', NULL, NULL),
(512, 24, 17, 'b9XE', '2021-04-12 16:17:38', 73, 'read', NULL, '©°ïOV¼	ÅR', 'ë¥òNÚH^', 'èÌnsÐ¤0%ÐLO', NULL, NULL),
(513, 24, 17, '5GrMrg==', '2021-04-12 16:34:14', 73, 'read', NULL, '¡2öyûï5', 'ÊéãÇ¤Õ', 'XïÅ>+ÛeÊ\n]|Þã', NULL, NULL),
(514, 24, 17, '6vX9XSAD', '2021-04-12 16:55:03', 73, 'read', NULL, '§Vµí÷¥hÕ°b', '¹<rÒ\n\Z\0', 'oÝßmYJ¿HÆír_+a', NULL, NULL),
(515, 24, 17, 'mhmiH81NUjIcGGNqk2i0EeXzNTPBOOU=', '2021-04-12 16:55:15', 73, 'read', NULL, '[Ñ<ÍKL%4', 'ñww¢|f', 'ïõ¼nÜ\r)©x', NULL, NULL),
(516, 17, 24, 'DVWsWA==', '2021-04-12 16:55:37', 73, 'read', NULL, '¹Ô[p×1ªh', 'æÆSûÊÄkÆ', 'E_U¸j1/ñ\n[ëÅTmk', NULL, NULL),
(517, 21, 25, 'Svf95yp0B6MBXK9MKUtFOXrWzayblxd1kFskhINY8a4D7ZMAmMqr4kNP1n7FFCwKQ6/UY24bS4b/FGXbWspfEiGqLKkOd08N5GLxub7BvN9MEJgjqfePmbJEN3QK8u+cdOWXZb4/1o5uHmZ0Plizvic7', '2021-04-12 17:28:05', 75, 'read', NULL, '.ö¥\Z½jPÞ', 'fIz\\ÐùC^K', 'ü°ÅG®SKòÒÙ*±', NULL, NULL),
(518, 24, 17, '2ZY=', '2021-07-10 18:40:41', 73, 'read', NULL, '¸¢þqË¿iYn', 'øpË¾AÝx', 'X¢öÕ+1×ÅÔÆÇ', NULL, NULL),
(519, 17, 24, 'fTL4KA==', '2021-07-10 18:43:51', 73, 'read', NULL, '.Ûâ8éÌõí', ')9ÒÔÂð\0´', 'Óiý¤ QVt*®zÅ2', NULL, NULL),
(520, 24, 17, '97c=', '2021-07-10 18:44:19', 73, 'read', NULL, '\\ÖKª,#Vdjù', '¹M¯)\Z]\"Ô', 'aÄBãc^fRv?@\\0', NULL, NULL),
(521, 17, 24, 'RS8N', '2021-07-10 18:44:37', 73, 'read', NULL, 'ò´¹òpQG6M_', 'öÐTÉ¢äDr²', 'I3i~1O+-rñÙ)eÿí', NULL, NULL),
(522, 24, 17, 'AlyW1LLiDZNcjhJp0kNEwJ4=', '2021-07-10 18:44:55', 73, 'read', NULL, '£:;Nî[mbS', 'lOR\"µ¶', 'H>~Õ¥LüoÑV­=ªá', NULL, NULL),
(523, 24, 17, 'e3o=', '2021-07-10 18:58:31', 73, 'read', NULL, '×BëQÜË4æõ4q', 'Ôi0ótnB', 'î¡rZÉ&		Q{CUË', NULL, NULL),
(524, 24, 17, NULL, '2021-07-10 18:58:36', 73, 'read', 'CG_60e9eddcd74af.wav', NULL, NULL, NULL, NULL, NULL),
(525, 24, 17, NULL, '2021-07-10 18:58:40', 73, 'read', 'CG_60e9ede0dabe1.wav', NULL, NULL, NULL, NULL, NULL),
(526, 24, 17, NULL, '2021-07-10 18:59:31', 73, 'read', 'CG_60e9ee130c32e.png', NULL, NULL, NULL, NULL, 'logo.png'),
(527, 17, 24, NULL, '2021-07-10 19:01:04', 73, 'read', 'CG_60e9ee7073cc9.wav', NULL, NULL, NULL, 17, NULL),
(530, 17, 24, 'VLatgP4=', '2021-07-10 20:31:49', 73, 'read', NULL, 'ödmm	[Ôl£É', '­W]GSª3y', 'ý^á»$èx­kíf@æ}', NULL, NULL),
(531, 24, 17, NULL, '2021-07-10 20:31:58', 73, 'read', 'CG_60ea03bee18c7.wav', NULL, NULL, NULL, NULL, NULL);

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
(17, 'samir ebrahim', 'admin2@admin.com', '01020203477', 'user_profile60ea03ac5da4d.webp', '$2y$10$IPsURMOm8zJ/PO2lcQ4iOe0GYwwC8uQ5AJ7MJD34TNQxOgnvimuL.', NULL, '2021-07-10 22:33 pm', 'no', 'this is pio', 'no', NULL, NULL),
(18, 'ahmed', 'admin3@admin.com', '01024416335', 'Blank-Avatar.png', '$2y$10$R70xyJCpyS.76fTUrVSbwOiyKhuGeO7Qg7egrChO3OOzuFq.N2qFW', NULL, '2021-04-09 02:17 am', 'yes', 'I\'m Web developer', 'no', NULL, NULL),
(19, 'amr', 'admin4@admin.com', '01025824254', 'Blank-Avatar.png', '$2y$10$75sKZo5oXiGsF6MxP2l7WerNhjsHt3hZAbvZoEimmHSpi4obivWLC', NULL, '2021-04-09 01:30 am', 'no', NULL, 'no', NULL, NULL),
(21, 'Chat go', 'chatgo@gmail.com', '01033324218', 'apple-touch-icon.png', '$2y$10$WAp8Tm.5UAQJW.OS8zHmbeLZMGw.jI9WGPYQGynCJahXWJNs7guH2', NULL, '2021-04-04 21:33 pm', 'yes', NULL, 'no', NULL, NULL),
(24, 'Red Doe', 'samir@example.com', '01144435326', 'user_profile60ea033e3fbe2.webp', '$2y$10$0ikvDXZermcopZV3tSJevefRdpTCK8Hp2rR0orKFaih2yg15euZRO', NULL, 'Active now', 'no', 'ماشى بنور الله ماااااااشى بدعى و اقول يارب', 'no', NULL, NULL),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=532;

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
