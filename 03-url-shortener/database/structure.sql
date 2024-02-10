CREATE DATABASE IF NOT EXISTS url_shortener;

use url_shortener;

CREATE TABLE IF NOT EXISTS urls (
    id        INTEGER PRIMARY KEY AUTO_INCREMENT,
    real_url  VARCHAR(512) NOT NULL,
    shortcode VARCHAR(50)  NOT NULL UNIQUE
);
