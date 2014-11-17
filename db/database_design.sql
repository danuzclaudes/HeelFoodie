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
) 

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
order_id INT,
customer_id INT,
order_phone CHAR(200),
order_address TEXT,
CONSTRAINT pk_Order PRIMARY KEY (order_id),
CONSTRAINT fk_Order FOREIGN KEY (customer_id)
REFERENCES a6_Customer(customer_id)
) 

CREATE Table a6_Menu_Order
(
menu_order_id INT,
menu_id INT,
order_id INT,
quantity INT,
order_date DATE,
CONSTRAINT pk_Menu_Order PRIMARY KEY (menu_order_id),
CONSTRAINT fk_Menu_Order FOREIGN KEY (order_id)
REFERENCES a6_Order(order_id),
CONSTRAINT fk_Menu_Order1 FOREIGN KEY (menu_id)
REFERENCES a6_Menu(menu_id)
) 

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
CONSTRAINT fk_Food_Review1 FOREIGN KEY (customer_id)
REFERENCES a6_Customer(customer_id)
) 

CREATE Table a6_Restaurant
(
restaurant_id INT,
restaurant_name CHAR(200),
regi_date DATE,
address TEXT,
city CHAR(200),
state CHAR(200),
zipcode CHAR(200),
work_phone CHAR(200),
open_hour TIME,
closed_hour TIME,
min_order DECIMAL(5,2),
delivery_fee DECIMAL(5,2),
location_id INT,
logo CHAR(200),
CONSTRAINT pk_Restaurant PRIMARY KEY (restaurant_id),
CONSTRAINT fk_Restaurant FOREIGN KEY (location_id)
REFERENCES a6_Location(location_id)
)

CREATE Table a6_Menu
(
menu_id INT,
food_id INT,
restaurant_id INT,
item_image CHAR(200),
item_thumb_image CHAR(200),
price  DECIMAL(5,2),
is_recommended BOOLEAN,
CONSTRAINT pk_a6_Menu PRIMARY KEY (menu_id),

CONSTRAINT fk_Menu FOREIGN KEY (food_id)
REFERENCES a6_Food(food_id),
CONSTRAINT fk_Menu1 FOREIGN KEY (restaurant_id)
REFERENCES a6_Restaurant(restaurant_id)
) 







