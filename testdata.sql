CREATE DATABASE IF NOT EXISTS lesson1 DEFAULT CHARACTER SET utf8mb4;
use lesson1;
DROP TABLE IF EXISTS user;
CREATE TABLE user (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    age INT(11),
    entry_date DATETIME
) default charset=utf8;
INSERT INTO user (name, age, entry_date) VALUE ("山田一郎", 22, NOW());
INSERT INTO user (name, age, entry_date) VALUE ("小野二郎", 20, NOW());
INSERT INTO user (name, age, entry_date) VALUE ("高田三郎", 22, NOW());
INSERT INTO user (name, age, entry_date) VALUE ("富田一子", 25, NOW());
INSERT INTO user (name, age, entry_date) VALUE ("山川美幸", 23, NOW());
INSERT INTO user (name, age, entry_date) VALUE ("園田太郎", 21, NOW());
INSERT INTO user (name, age, entry_date) VALUE ("山田花子", 26, NOW());
