CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    role VARCHAR(255)
);

CREATE TABLE offers (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL REFERENCES users(id)
);

-- Insert sample data into the 'users' table
INSERT INTO users (username, password, first_name, last_name, role) VALUES
('john_doe', 'password123', 'John', 'Doe', 'admin'),
('jane_smith', 'password456', 'Jane', 'Smith', 'user'),
('alice_wong', 'password789', 'Alice', 'Wong', 'user'),
('bob_jones', 'password101', 'Bob', 'Jones', 'user');

-- Insert sample data into the 'offers' table
-- Ensure the user_id matches the id of an existing user in the 'users' table
INSERT INTO offers (name, location, description, price, user_id) VALUES
('Summer Vacation Package', 'Hawaii', 'Enjoy a 7-day vacation in Hawaii with flights and hotel included.', 1500.00, 1),
('Winter Ski Trip', 'Switzerland', '5-day ski trip in the Swiss Alps, including equipment rental.', 2000.00, 2),
('City Break in Paris', 'Paris', '3-day city break in Paris with guided tours and meals.', 1200.00, 3),
('Beach Resort Stay', 'Maldives', 'Relax at a luxury beach resort with all-inclusive amenities.', 2500.00, 4),
('Mountain Hiking Adventure', 'Colorado', '7-day hiking adventure in the Rocky Mountains.', 1800.00, 1);