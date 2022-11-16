DROP DATABASE IF EXISTS crud;

CREATE DATABASE crud DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci;

DROP USER IF EXISTS  'crud_user'@'localhost';
    
CREATE USER 'crud_user'@'localhost' IDENTIFIED BY 'mysql';

GRANT ALL PRIVILEGES ON crud.* TO 'crud_user'@'localhost';