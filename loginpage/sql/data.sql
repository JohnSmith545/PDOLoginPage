-- Studios table
CREATE TABLE studios (
    studio_id INT PRIMARY KEY AUTO_INCREMENT,
    studio_name VARCHAR(100) NOT NULL,
    location VARCHAR(150),
    founder VARCHAR(100),
    established_year YEAR,
    website VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Anime table
CREATE TABLE anime (
    anime_id INT PRIMARY KEY AUTO_INCREMENT,
    anime_title VARCHAR(100) NOT NULL,
    genre VARCHAR(50),
    release_date DATE,
    episodes INT,
    studio_id INT,
    rating DECIMAL(3,2),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    added_by VARCHAR(50),
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);