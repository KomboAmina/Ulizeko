/*
* Database frame for the Ulizeko app. Loads with empty tables.
*/
CREATE TABLE `topics`(
    id INT(5) NOT NULL AUTO_INCREMENT,
    topic VARCHAR(50) NOT NULL,
    slug VARCHAR(255) NOT NULL,

    PRIMARY KEY(id),
    UNIQUE(topic),
    UNIQUE(slug)
);

CREATE TABLE `articles`(
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    brief VARCHAR(500) NOT NULL,
    body TEXT,
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    visible BOOLEAN NOT NULL DEFAULT true,

    PRIMARY KEY(id),
    UNIQUE(slug)
);

CREATE TABLE `article_topics`(
    id INT(30) NOT NULL AUTO_INCREMENT,
    articleid INT(11) NOT NULL,
    topicid INT(5) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(articleid) REFERENCES `articles`(id),
    FOREIGN KEY(topicid) REFERENCES `topics`(id)
);
