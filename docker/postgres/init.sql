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
    category_id INT NOT NULL REFERENCES categories(id) ON DELETE CASCADE,
    PRIMARY KEY (offer_id, category_id)
);

INSERT INTO users (id, username, password, first_name, last_name, phone_number, role) VALUES
(1, 'john_doe', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'John', 'Doe', '48500100200', 'user'),
(2, 'jane_smith', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'Jane', 'Smith', '48500300400', 'user'),
(3, 'admin', 'ad9056406390cfaa42b23010b8287717eb0aaa46', 'Adam', 'Admin', '48500500600', 'admin');

INSERT INTO categories (id, name, category_id) VALUES
(1, 'Electronics', NULL),
(2, 'Laptops', 1),
(3, 'Phones', 1),
(4, 'Animals', NULL),
(5, 'Dogs', 4),
(6, 'Fish', 4),
(7, 'Home', NULL),
(8, 'Furniture', 7),
(9, 'Food', 7),
(10, 'Bread', 9),
(11, 'Fruits', 9),
(12, 'Apples', 11),
(13, 'Vehicles', NULL),
(14, 'Bikes', 13);

INSERT INTO offers (id, title, description, location, price, image, user_id, created_date) VALUES
(1, 'Powerful Gaming Laptop with RGB Keyboard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'Warsaw', 4500.00, 'uploads/laptop.jpg', 1, '2024-03-10 14:30:00'),
(2, 'Vintage Wooden Dining Table', 'Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.', 'Krakow', 1200.00, 'uploads/furniture.jpg', 2, '2024-03-11 09:15:00'),
(3, 'Mountain Bike with 21 Gears', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Gdansk', 800.00, 'uploads/bike.jpg', 3, '2024-03-12 16:45:00'),
(4, 'Golden Retriever Puppies', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.', 'Poznan', 2500.00, 'uploads/dog.jpg', 2, '2024-03-13 11:00:00'),
(5, 'Organic Whole Grain Bread', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.', 'Wroclaw', 8.50, 'uploads/bread.jpg', 3, '2024-03-14 07:30:00'),
(6, 'Fresh Red Delicious Apples', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.', 'Lodz', 4.99, 'uploads/apple.jpg', 2, '2024-03-15 12:15:00'),
(7, 'Latest Smartphone Model 2024', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.', 'Katowice', 3499.99, 'uploads/phone.jpg', 1, '2024-03-16 10:00:00'),
(8, 'Exotic Tropical Fish Aquarium Set', 'Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.', 'Gdynia', 600.00, 'uploads/fish.jpg', 3, '2024-03-17 14:20:00');

INSERT INTO offers_categories (offer_id, category_id) VALUES
(1, 2),
(2, 8),
(3, 14),
(4, 5),
(5, 10),
(6, 12),
(7, 3),
(8, 6);


create view vOffers as select o.*, c.name, u.first_name, u.last_name, u.phone_number from offers o 
left join offers_categories oc on o.id = oc.offer_id
left join categories c on c.id = oc.category_id
left join users u on u.id = o.user_id