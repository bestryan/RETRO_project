CREATE TABLE forum_types (
    type_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR (100),
    type_description VARCHAR (150)
);

CREATE TABLE forum_topics (
    topic_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    topic_title VARCHAR (150),
    topic_create_time DATETIME,
    topic_owner VARCHAR (30),
    topic_email VARCHAR (30),
    type_id INT NOT NULL
);

CREATE TABLE forum_posts (
    post_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    topic_id INT NOT NULL,
    post_text TEXT,
    post_create_time DATETIME,
    post_owner VARCHAR (30),
    post_email VARCHAR (30),
    type_id INT NOT NULL
);


INSERT INTO forum_types
VALUES (1, 'Vinyl Collective Message Board', 'Everything and anything pertaining to records.'),
(2, 'Sale/Trade/Wants', 'Use this board to sell, trade and post your wanted stuff'),
(3, 'Everything Else Message Board', 'Use this board to discuss everything else.');