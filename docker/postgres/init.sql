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
    title VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    image VARCHAR(255),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL REFERENCES users(id)
);

INSERT INTO users (username, password, first_name, last_name, role) VALUES
('john_doe', 'password123', 'John', 'Doe', 'admin'),
('jane_smith', 'password456', 'Jane', 'Smith', 'user'),
('alice_wong', 'password789', 'Alice', 'Wong', 'user'),
('bob_jones', 'password101', 'Bob', 'Jones', 'user');

INSERT INTO offers (title, location, description, price, user_id) VALUES
('Smartphone X200', 'New York', 'Latest model with 128GB storage, 5G support, and 48MP camera.', 799.99, 1),
('Wireless Noise-Canceling Headphones', 'California', 'Premium over-ear headphones with 30-hour battery life.', 299.99, 2),
('4K Ultra HD Smart TV', 'Texas', '55-inch 4K UHD Smart TV with HDR and built-in streaming apps.', 899.99, 3),
('Laptop Pro 15', 'Washington', 'Powerful 15-inch laptop with 16GB RAM and 512GB SSD.', 1299.99, 4),
('Designer Leather Jacket', 'Italy', 'High-quality leather jacket available in black and brown.', 499.99, 1),
('Smart Home Security Camera', 'California', '1080p HD security camera with motion detection and night vision.', 149.99, 2),
('Electric Stand Mixer', 'Germany', '1500W stand mixer with 5-speed settings and 3 attachments.', 399.99, 3),
('Gaming Console X', 'Japan', 'Next-gen gaming console with 1TB storage and 4K gaming support.', 499.99, 4),
('Yoga Mat with Carrying Strap', 'India', 'Eco-friendly yoga mat with non-slip surface and carrying strap.', 49.99, 1),
('Bluetooth Portable Speaker', 'China', 'Waterproof Bluetooth speaker with 20-hour playtime.', 79.99, 2);