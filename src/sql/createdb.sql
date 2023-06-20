CREATE TABLE users (
                      user_id SERIAL PRIMARY KEY,
                      name VARCHAR(50) NOT NULL,
                      password VARCHAR(50) NOT NULL,
                      mail_address VARCHAR(255) UNIQUE NOT NULL,
                      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
)

CREATE TABLE article (
                         article_id SERIAL PRIMARY KEY,
                         user_id INT NOT NULL,
                         title VARCHAR(50) NOT NULL,
                         text TEXT NOT NULL,
                         thumbnail_image_id INT,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                         updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                         FOREIGN KEY (user_id) REFERENCES users (user_id)
)

CREATE TABLE image (
                       image_id SERIAL PRIMARY KEY,
                       article_id INT NOT NULL,
                       resource_id VARCHAR NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                       FOREIGN KEY (article_id) REFERENCES article (article_id)
)

CREATE TABLE tag (
                     tag_id SERIAL PRIMARY KEY,
                     tagname VARCHAR(10) NOT NULL UNIQUE
)

CREATE TABLE article_tag (
                             article_tag_id SERIAL PRIMARY KEY,
                             tag_id INT NOT NULL,
                             article_id INT NOT NULL,
                             created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                             updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                             FOREIGN KEY (tag_id) REFERENCES tag (tag_id),
                             FOREIGN KEY (article_id) REFERENCES article (article_id)
)
