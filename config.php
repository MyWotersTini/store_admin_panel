<?php

// SELECT students_list.*, groups_list.code, teachers_list.surname FROM `teachers_list`, groups_list, students_list  where groups_list.teacher = teachers_list.id and students_list.groups = groups_list.id;

	$bd_access = array(
		'host' => '127.0.0.1' ,
		'login' => 'root',
		'pass' => '',
		'bd' => 'plumber_management'
	);


	$connection = mysqli_connect(
		$bd_access['host'],
		$bd_access['login'],
		$bd_access['pass'],
		$bd_access['bd']
	);

	if ( $connection == false) {
		echo "False connect to BD. Error! 500";
		echo mysqli_connect_error();
		exit();
	};

	include_once "system/system.php";