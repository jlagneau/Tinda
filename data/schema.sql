DROP TABLE IF EXISTS `matcha_user`;
CREATE TABLE `matcha_user` (
  `id`        INTEGER PRIMARY KEY AUTOINCREMENT,
  `username`  CHAR(50)  NOT NULL UNIQUE,
  `email`     CHAR(50)  NOT NULL UNIQUE,
  `password`  CHAR(128) NOT NULL,
  `hash`      CHAR(128) NOT NULL UNIQUE,
  `active`    INT(1)    NOT NULL
);
