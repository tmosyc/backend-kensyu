CREATE TABLE article (
                         article_id SERIAL PRIMARY KEY,
                         user_id INT NOT NULL,
                         title VARCHAR(50) NOT NULL,
                         text TEXT NOT NULL,
                         thumbnail_image_id INT,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                         updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
)

CREATE TABLE image (
                       image_id SERIAL PRIMARY KEY,
                       article_id INT NOT NULL,
                       resource_id INT,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
)
--                        FOREIGN KEY (article_id) REFERENCES article (article_id)
