// set up restaurants data
Restaurants.all = [];
Restaurants.all.push(new Restaurants(1,"Asian Cafe",35.913237, -79.055839, "118 E Franklin St, Chapel Hill, NC 27514", "(919) 929-0168", true));
Restaurants.all.push(new Restaurants(2,"Top of Hill",35.914019, -79.056741, "100 E Franklin St #3, Chapel Hill, NC 27514", "(919) 929-8676", false));
Restaurants.all.push(new Restaurants(3,"Sweet Frog",35.913133, -79.055464, "105 E Franklin St, Chapel Hill, NC 27514", "(919) 537-8616", true));




// set up menu data
Menu.all = [];
Menu.all.push(new Menu('1', 'Crab Rangoon', 0, "5", "Crab-Rangoon.jpeg", 4.95));
Menu.all.push(new Menu('2', 'Crispy Noodle', 0, "4", "crispy-noodle.jpg", 0.50));
Menu.all.push(new Menu('3', 'Orange Chicken', 0, "4", "Orange-Chicken.jpg", 8.95));
Menu.all.push(new Menu('4', 'Fried Chicken Wings', 0, "3", "chickenwings.jpg", 6.95));
Menu.all.push(new Menu('5', 'Beef with Broccoli', 0, "2", "beef-broccoli.jpg", 9.25));
Menu.all.push(new Menu('6', 'Pork Fried Rice', 0, "0", "pork-fried-rice.jpg", 7.50));

// // set up orderlist data
// OrderList.all = [];
// OrderList.all.push(new Menu('1', 'Crab Rangoon', 3, "5", "Crab-Rangoon.jpeg", 4.95));
// OrderList.all.push(new Menu('2', 'Crispy Noodle', 0, "4", "crispy-noodle.jpg", 0.50));
// OrderList.all.push(new Menu('3', 'Orange Chicken', 5, "4", "Orange-Chicken.jpg", 8.95));
// OrderList.all.push(new Menu('4', 'Fried Chicken Wings', 0, "3", "chickenwings.jpg", 6.95));
// OrderList.all.push(new Menu('5', 'Beef with Broccoli', 1, "2", "beef-broccoli.jpg", 9.25));
// OrderList.all.push(new Menu('6', 'Pork Fried Rice', 0, "0", "pork-fried-rice.jpg", 7.50));

// INSERT INTO `a6_Restaurant` VALUES ('restaurant_id', 'restaurant_name', 'regis_date', 'address', 'city', 'state', 'zipcode', 'work_phone', 'open_hour', 'closed_hour', 'min_order', 'delivery_fee', 'latitude', 'longitude', 'logo')# 1 row affected.
// INSERT INTO `a6_Restaurant` VALUES ('1', 'Asian Cafe', '2014/11/23', '118 E Franklin St', 'Chapel Hill', 'NC', '27514', '919-000-0000', '8:00:00', '20:00:00', '5', '2', '35.913239', '-79.05584', '')# 1 row affected.
// INSERT INTO `a6_Restaurant` VALUES ('2', 'Top of Hill', '2014/11/24', '100 E Franklin St #3, Chapel Hill, NC 27514', NULL, NULL, NULL, '(919) 929-8676', NULL, NULL, NULL, NULL, '35.914019', '-79.056741', NULL)# 1 row affected.
// INSERT INTO `a6_Restaurant` VALUES ('3', 'Sweet Frog', '', '105 E Franklin St, Chapel Hill, NC 27514', '', '', '', '(919) 537-8616', '', '', '', '', '35.913133', '-79.055464', '')# 1 row affected.
// [...]";