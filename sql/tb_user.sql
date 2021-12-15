CREATE TABLE `tb_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` char(32) NOT NULL,
  `account` char(11) NOT NULL,
  `password` char(6) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `sex` enum('男','女','保密') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `authKey` varchar(16) DEFAULT NULL,
  `accessToken` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`,`userId`),
  UNIQUE KEY `userId_UNIQUE` (`userId`),
  UNIQUE KEY `account_UNIQUE` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

INSERT INTO `tb_user` (userId, account, password, name, sex, age, authKey, accessToken) VALUES ('2021121410002','15012475461','123456','Alis', '女', 20, 'BF234AC345343DCA', 'ABFDCBF5655AFDEDCBF3434ACFEDB');

