CREATE Table a6_Category
(
category_id INT,
category_name CHAR(200) NOT NULL,
CONSTRAINT pk_Cate PRIMARY KEY (category_id)
) 

CREATE Table a6_Food
(
food_id INT,
food_name CHAR(200) NOT NULL,
CONSTRAINT pk_Food PRIMARY KEY (food_id)
) 

CREATE Table a6_Admin
(
admin_id INT,
admin_name CHAR(200),
password CHAR(200),
CONSTRAINT pk_Admin PRIMARY KEY (admin_id)
) 

CREATE Table a6_Location
(
location_id INT,
location_name CHAR(200),
zipcode CHAR(200),
longitude CHAR(200),
latitude CHAR(200),
CONSTRAINT pk_Location PRIMARY KEY (location_id)
) 

CREATE Table a6_Customer
(
customer_id INT,
username CHAR(200) ,
password CHAR(200) ,
regi_date DATE ,
firstname CHAR(200),
lastname CHAR(200),
middlename CHAR(200),
email CHAR(200),
cellphone1 CHAR(200),
cellphone2 CHAR(200),
address TEXT,
city CHAR(200),
state CHAR(200),
zipcode CHAR(200),
CONSTRAINT pk_Customer PRIMARY KEY (customer_id)
);

CREATE Table a6_Food_Category
(
food_category_id INT,
category_id INT,
food_id INT,
CONSTRAINT pk_Food_Cate PRIMARY KEY (food_category_id),
CONSTRAINT fk_Food_Cate FOREIGN KEY (category_id)
REFERENCES a6_Category(category_id),
CONSTRAINT fk_Food_Cate1 FOREIGN KEY (food_id)
REFERENCES a6_Food(food_id)
) 

CREATE Table a6_Order
(
order_id char(20) not null auto_increment,
customer_id INT,
order_phone CHAR(30),
order_address TEXT,
order_date DATE,
CONSTRAINT pk_Order PRIMARY KEY (order_id),
CONSTRAINT fk_Order FOREIGN KEY (customer_id) REFERENCES a6_Customer(customer_id)
);

CREATE Table a6_Menu_Order
(
menu_id int(11) NOT NULL,
order_id char(20) NOT NULL,
quantity int,
CONSTRAINT pk_Menu_Order PRIMARY KEY (menu_id, order_id),
CONSTRAINT fk_Menu_Order FOREIGN KEY (order_id) REFERENCES a6_Order(order_id),
CONSTRAINT fk_Menu_Order1 FOREIGN KEY (menu_id) REFERENCES a6_Menu(menu_id)
);

CREATE Table a6_Food_Review
(
food_review_id INT,
menu_order_id INT,
customer_id INT,
rating INT,
comment TEXT,
email CHAR(200),
Reviewimage CHAR(200),
CONSTRAINT pk_food_review PRIMARY KEY (food_review_id),
CONSTRAINT fk_Food_Review FOREIGN KEY (menu_order_id)
REFERENCES a6_Menu_Order(menu_order_id),
CONSTRAINT fk_Food_Review1 FOREIGN KEY (customer_id) REFERENCES a6_Customer(customer_id)
) 

CREATE Table a6_Restaurant
(
restaurant_id int not null auto_increment,
restaurant_name CHAR(60),
regis_date DATE,
address VARCHAR(80),
city VARCHAR(20),
state VARCHAR(20),
zipcode VARCHAR(20),
work_phone VARCHAR(20),
open_hour TIME,
closed_hour TIME,
min_order DECIMAL(5,2),
delivery_fee DECIMAL(5,2),
latitude float(10,6),
longitude float(10,6),
logo VARCHAR(255),
CONSTRAINT pk_Restaurant PRIMARY KEY (restaurant_id)
-- CONSTRAINT fk_Restaurant FOREIGN KEY (location_id)
-- REFERENCES a6_Location(location_id)
);

CREATE TABLE IF NOT EXISTS a6_Menu (
menu_id int(11) NOT NULL AUTO_INCREMENT,
food_id int(11) DEFAULT NULL,
restaurant_id int(11) DEFAULT NULL,
item_image char(200) DEFAULT NULL,
item_thumb_image char(200) DEFAULT NULL,
price decimal(5,2) DEFAULT NULL,
is_recommended tinyint(1) DEFAULT NULL,
constraint PRIMARY KEY (menu_id)
);

-- insert into 
INSERT INTO `a6_Menu` (`menu_id`, `food_id`, `restaurant_id`, `item_image`, `item_thumb_image`, `price`, `is_recommended`) VALUES
(1, 1, 1, NULL, 'Crab-Rangoon.jpeg', '4.95', NULL),
(2, 2, 1, NULL, 'crispy-noodle.jpg', '8.50', NULL),
(3, 3, 1, NULL, 'Orange-Chicken.jpg', '8.95', NULL),
(4, 4, 1, NULL, 'chickenwings.jpg', '6.95', NULL),
(5, 5, 1, NULL, 'beef-broccoli.jpg', '9.25', NULL),
(6, 6, 1, NULL, 'pork-fried-rice.jpg', '7.50', NULL);

INSERT INTO `a6_Customer` (`customer_id`, `username`, `password`, `regi_date`, `firstname`, `lastname`, `middlename`, `email`, `cellphone1`, `cellphone2`, `address`, `city`, `state`, `zipcode`) VALUES
(1, 'comp', 'comp426', '2014-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `a6_Food` (`food_id`, `food_name`) VALUES
(1, 'Crab Rangoon'),
(2, 'Crispy Noodle'),
(3, 'Orange Chicken'),
(4, 'Fried Chicken Wings'),
(5, 'Beef with Broccoli'),
(6, 'Pork Fried Rice');

INSERT INTO `a6_Food_Review` (`food_review_id`, `menu_id`, `customer_id`, `rating`, `comment`, `email`, `Reviewimage`) VALUES
(1, 1, 1, 5, NULL, NULL, NULL),
(2, 2, 1, 4, NULL, NULL, NULL),
(3, 3, 1, 4, NULL, NULL, NULL),
(4, 4, 1, 2, NULL, NULL, NULL),
(5, 5, 1, 2, NULL, NULL, NULL),
(6, 0, 0, NULL, NULL, NULL, NULL);
