<?php
require_once "db.php";
session_start();
require 'includes/guardgeneral.ssi';
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>
<body  id="home">
<h1>Instructions</h1>

<p>Now that you are logged in, you may entered household, project, or user information into the database. 
After you are done entering or modifying information, always <b>log out.</b></p>


<h4><a href="add.php">New Entry</a></h4>

<p>1. Click on "New Entry" from the header to enter household information.</p> 
<p>2. Enter data: A new page appears with multiple fields where you can input survey information. 
When you are finished, click the "Add New" button at the end of the survey.</p>
<p>3. Verify data: A new page appears with your entries. This is your last opportunity to review and edit your entries 
before it is submitted into the database. Once it is submitted, you cannot make changes unless you are an administrator.
If you are satisfied with the entry, click on "Update entry" and the information will be submitted into the database.</p>
<p>Repeat steps 1-3 for a new household entry. </p>


<h4><a href="search.php">Search</a></h4>
<p>The query tool tabulates entered household data by districts and categories.</p>

<h4><a href="manageprojects.php">Manage Projects</a></h4>

<p>Only administrators can access this page. Administrators are responsible for creating a project for each surveying period. Each project must have a unique number that
allows CDP to track surveying progress for each district over time.</p>


<p><a href="addproject.php">Add Project</a></p>

<p>1. Click on "Add A New Project."</p> 
<p>2. A new page will appear where you can enter a project number, the project name, and provide a description for the project. 
Once you are done, click on "Add New" to input the project into the database.</p> 
<p>3. You will be redirected to a new page where you will see your entry at the bottom of the table. Here, you also have the opportunity
to edit or delete the project. </p> 

<h4><a href="manageusers.php">Manage Users</a></h4> 
<p>Only head administrators may create, edit, and delete users.</p> 

<p><a href="adduser.php">Add User</a></p>
<p>1. Click on "Add New User."</p>
<p>2. The first name, last name, email, password, and access level must be entered. Once this information is complete, 
click "Add New."</p> 
<p>3. You will be redirected to a new page where the list of users is displayed. This page allows the administrator to 
add, edit or delete users as needed.</p>
</body>
</html>