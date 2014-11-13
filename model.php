<?php

$order_list = array();
$order_list[] = array('oid' => 'o0001',
					'mname' => 'Crab Rangoon',
					'qty' => 3,
					'star' => 5,
					'img_url' => "Crab-Rangoon.jpeg",
					'price' => 4.95);
$order_list[] = array('oid' => 'o0002',
					'mname' => 'Crispy Noodle',
					'qty' => 0,
					'star' => 4,
					'img_url' => "crispy-noodle.jpg",
					'price' => 0.5);
$order_list[] = array('oid' => 'o0003',
					'mname' => 'Orange Chicken',
					'qty' => 5,
					'star' => 4,
					'img_url' => "Orange-Chicken.jpg",
					'price' => 8.95);
$order_list[] = array('oid' => 'o0004',
					'mname' => 'Fried Chicken Wings',
					'qty' => 0,
					'star' => 3,
					'img_url' => "chickenwings.jpg",
					'price' => 6.95);
$order_list[] = array('oid' => 'o0005',
					'mname' => 'Beef with Broccoli',
					'qty' => 1,
					'star' => 2,
					'img_url' => "beef-broccoli.jpg",
					'price' => 9.25);
$order_list[] = array('oid' => 'o0006',
					'mname' => 'Pork Fried Rice',
					'qty' => 0,
					'star' => 0,
					'img_url' => "pork-fried-rice.jpg",
					'price' => 7.50);

function getOrderList() {
	global $order_list;
	return $order_list;
}
// function getMenuName($key)

?>		