<?php

    // configuration
    require("../includes/config.php"); 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(empty($_GET["id"]))
        {
        	//print "empty category";
        	redirect('./');
        }
        else
        {
      		$item=query("select * from news where id=?",$_GET["id"]);
        	$head=$item[0]["title"];
        	$item=$item[0];
        	$images=query("select address from images where id=?",$_GET["id"]);
        	$related=query("select id,title from news where category=(select category from news where id=?)",$_GET["id"]);
        	//print 'going to render';
        	render("show-individual-news.php",["title"=>$head,"item"=>$item,"images"=>$images,"related"=>$related]);
        }
    }
    else
    {
        redirect('./');
    }

?>
