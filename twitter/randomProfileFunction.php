<?php

	
	/*
	de pagina url wordt dan:
	http://www.onzepagina.nl?user=123456&accessCode=987654
	*/

	//get data from sql with friendnames and codes who can view your page
	
	$friend = "mentosmenno";
	$friendaccesscode = mt_rand(100000,999999);
	array_push($friends,$friend);
	array_push($friends,$friendaccesscode);
	
	//update data in sql
	
	
	/*
	stel iemand wil op je pagina komen dandoe je de volgende validatie
	*/
	
	//get data from sql with friendnames and codes who can view your page
	
	if (/*als session_friend zit in de sql data en get_accesscode hoort daarbij*/) {
		//displaypage();
	}
	
	else {
		echo "you are not allowed to view this page";
	}
	
?>