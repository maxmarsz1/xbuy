CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    phone_number VARCHAR(255),
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
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    category_id INT REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE offers_categories (
    offer_id INT NOT NULL REFERENCES offers(id) ON DELETE CASCADE,
    category_id INT NOT NULL REFERENCES categories(id) ON DELETE SET NULL
);

INSERT INTO categories (name, category_id) VALUES
('Electronics', null),
('Home & Garden', null),
('Fashion', null),
('Sport', null),
('Food', null),
('Laptops', 1),
('Phones', 1),
('Computers', 1),
('Tablets', 1),
('Furniture', 2),
('Kitchen', 2),
('Clothing', 3),
('Shoes', 3),
('Accessories', 3),
('Bikes', 4),
('Scooters', 4),
('Skateboards', 4),
('Dogs', 5),
('Cats', 5),
('Meat', 5),
('Fish', 5),
('Beverages', 5),
('Fruits', 5),
('Vegetables', 5),
('Breads', 5);


INSERT INTO users (username, password, first_name, last_name, role, phone_number) VALUES
('admin', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'Admin', 'User', 'admin', '123-456-7890'),
('john_doe', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'John', 'Doe', 'admin', '234-567-8901'),
('jane_smith', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'Jane', 'Smith', 'user', '345-678-9012'),
('alice_wong', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'Alice', 'Wong', 'user', '456-789-0123'),
('bob_jones', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'Bob', 'Jones', 'user', '567-890-1234');


INSERT INTO offers (title, location, description, price, image, user_id) VALUES
('Laptop', 'Warsaw', 'It''s a laptop', 2000.00, 'uploads/laptop.jpg', 1),
('Phone', 'Warsaw', 'It''s a phone', 1000.00, 'uploads/phone.jpg', 2),
('Furniture', 'Warsaw', 'It''s a furniture', 500.00, 'uploads/furniture.jpg', 3),
('Bike', 'Warsaw', 'It''s a bike', 1500.00, 'uploads/bike.jpg', 4),
('Dog', 'Warsaw', 'It''s a dog', 100.00, 'uploads/dog.jpg', 5),
('Fish', 'Warsaw', 'It''s a fish', 50.00, 'uploads/fish.jpg', 5),
('Bread', 'Warsaw', 'It''s a bread', 10.00, 'uploads/bread.jpg', 5),
('Apple', 'Warsaw', 'It''s an apple', 5.00, 'uploads/apple.jpg', 5);


INSERT INTO offers_categories (offer_id, category_id) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 4),
(5, 5),
(6, 5),
(7, 5),
(8, 5);