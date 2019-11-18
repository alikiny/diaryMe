-- CREATE TABLE
-- users (

CREATE TABLE users (
    id int PRIMARY KEY IDENTITY(1,1),
    age int,
    userName varchar(255),
    email varchar(255),
    Country varchar(255),
    City varchar(255)
);
ALTER TABLE diary
ADD FOREIGN KEY (userId) REFERENCES users(id);