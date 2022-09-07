-- Database name: exam_portal
CREATE TABLE user_info(
    uid INT PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(128) NOT NULL,
    fullName VARCHAR(128) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(128) NOT NULL,
    pwd VARCHAR(128) NOT NULL
);

CREATE TABLE subjects(
    subid INT PRIMARY KEY AUTO_INCREMENT,
    subName VARCHAR(128) NOT NULL
);

CREATE TABLE quizes(
    quizid INT PRIMARY KEY AUTO_INCREMENT,
    quizName VARCHAR(256) NOT NULL,
    subid INT NOT NULL,
    FOREIGN KEY (subid) 
    REFERENCES subjects(subid)
    ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE question_answer(
    qid INT PRIMARY KEY AUTO_INCREMENT,
    quizid INT NOT NULL,
    question VARCHAR(1024) NOT NULL,
    opt1 VARCHAR(64) NOT NULL,
    opt2 VARCHAR(64) NOT NULL,
    opt3 VARCHAR(64) NOT NULL,
    opt4 VARCHAR(64) NOT NULL,
    answer INT(2) NOT NULL,
    FOREIGN KEY (quizid) 
    REFERENCES quizes(quizid)
    ON DELETE CASCADE ON UPDATE RESTRICT

);

CREATE TABLE admins(
    adminid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    pwd VARCHAR(128) NOT NULL
);

-- Insertion into tables

-- password for admin is '123'
INSERT INTO admins (adminid, name, pwd) VALUES (1, 'admin', '$2y$10$G0FJ0EvYBzcuLt.u3RmrROqMDAIWPMwvYiEnk6oPzXOa2HJzlEsXi');

