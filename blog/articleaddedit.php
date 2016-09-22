<?php
require_once 'db.php';

if (!isset($_SESSION['user'])){
    echo '<h1>Access forbidden</h1>';
    echo "Only logged in users are allowed to post.";
    echo '<a href="index.php">Click to contunue</a>';
    exit();
}

//TODO: Add 3 state form with Subject and body (text area)
//Require subject atr least 4 characters long
//Require body at least 50 characters long
//Make sure you re-display subject and body if submission has failed.
//On successful submission, add article to database.

//index.php

//TODO:Add code to fetch the latest 5 articles from database
//and display their title, author, and date of creation. JOIN

//articleview.php?id=7

//TODO:Add code to fetch

//$authorID=$_SESSION['user']['ID'];
