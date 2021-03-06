mysql> show create table comments;
+----------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Table    | Create Table                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
+----------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| comments | CREATE TABLE `comments` (
  `comment_story_id` smallint(5) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `comment_user` varchar(20) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_story_id` (`comment_story_id`),
  KEY `comment_user` (`comment_user`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_user`) REFERENCES `users` (`username`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_story_id`) REFERENCES `stories` (`story_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 |
+----------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)
