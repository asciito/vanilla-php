CREATE DATABASE IF NOT EXISTS `simple_blog_system`;

USE `simple_blog_system`;


CREATE TABLE IF NOT EXISTS `posts`
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    title   VARCHAR(128) NOT NULL,
    content MEDIUMTEXT NULL
)