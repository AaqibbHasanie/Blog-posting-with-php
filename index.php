<?php
session_start();

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: Aaqib_task1.php");
    exit;
}


?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Dashboard</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
        .post-buttons {
    text-align: center;
    margin-top: 10px;
}

.edit-button, .delete-button {
    padding: 8px 16px;
    margin: 0 5px;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

.edit-button:hover, .delete-button:hover {
    background-color: #45a049;
}

		.message-container {
	background-color: white;
	padding: 20px;
	border-radius: 10px;
	margin: 20px;
	text-align: center;
	max-height: 500px;
	overflow: auto;
}

 .post-container {
		background-color: #h3243;
	padding: 20px;
	border-radius: 10px;
	margin: 20px;
	text-align: center;
	max-height: 500px;
	overflow: auto;
 }


		.message-container h2 {
			color: black;
			font-size: 24px;
		}

		#category-table {
			max-height: 100%;
			overflow-y: auto;
			border-collapse: collapse;
			width: 100%;
		}

		#category-table th,
		#category-table td {
			padding: 8px;
			text-align: left;
			color: black;
		}

		#category-table th {
			background-color: #f2f2f2;
		}

		#category-table tr:nth-child(even) {
			background-color: #f8f8f8;
		}

		/* Style for the Create a Post form */
.message-container {
  text-align: center;
}

h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

textarea {
  width: 100%;
  height: 150px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical;
}

select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

#selected-tags-container {
  margin-top: 20px;
}

ul#selected-tags-list {
  list-style-type: none;
  padding: 0;
}

.selected-tag {
  display: inline-block;
  background-color: #f2f2f2;
  color: #333;
  padding: 5px 10px;
  margin-right: 5px;
  margin-bottom: 5px;
  border-radius: 5px;
}

.remove-tag {
  cursor: pointer;
  margin-left: 5px;
  color: #999;
}

button[type="submit"] {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #45a049;
}

.posts-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.post {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
	
}

.post h3 {
	font-weight: bold;
}

.post-category {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.post-description {
    font-size: 16px;
    margin-bottom: 10px;
	
}

.tags {
    list-style-type: none;
    padding: 0;
    margin: auto;
}

.tags li {
    display: inline-block;
    background-color: #ebebeb;
    padding: 6px 12px;
    border-radius: 4px;
    margin-right: 5px;
    font-size: 14px;
}

p.no-posts {
    text-align: center;
    font-size: 16px;
    color: #888;
    margin-top: 20px;
}

body{
	margin:0px;
	padding: 0px;
	background-color:#1b203d;
	overflow: hidden;
	font-family: system-ui;
}
.clearfix{
	clear: both;
}
.logo{
	margin: 0px;
	margin-left: 28px;
    font-weight: bold;
    color: white;
    margin-bottom: 30px;
}
.logo span{
	color: #f7403b;
}
.sidenav {
  height: 100%;
  width: 300px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #272c4a;
  overflow: hidden;
  transition: 0.5s;
  padding-top: 30px;
}
.sidenav a {
  padding: 15px 8px 15px 32px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  transition: 0.3s;
}
.sidenav a:hover {
  color: #f1f1f1;
  background-color:#1b203d;
}
.sidenav{
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
}
#main {
  transition: margin-left .5s;
  padding: 16px;
  margin-left: 300px;
}
.head{
	padding:20px;
}
.col-div-6{
	width: 50%;
	float: left;
}
.profile{
	display: inline-block;
	float: right;
	width: 160px;
}
.pro-img{
	float: left;
	width: 40px;
	margin-top: 5px;
}
.profile p{
	color: white;
	font-weight: 500;
	margin-left: 55px;
	margin-top: 10px;
	font-size: 13.5px;
}
.profile p span{
	font-weight: 400;
    font-size: 12px;
    display: block;
    color: #8e8b8b;
}
.col-div-3{
	width: 25%;
	float: left;
}
.box{
	width: 85%;
	height: 100px;
	background-color: #272c4a;
	margin-left: 10px;
	padding:10px;
}
.box p{
	 font-size: 35px;
    color: white;
    font-weight: bold;
    line-height: 30px;
    padding-left: 10px;
    margin-top: 20px;
    display: inline-block;
}
.box p span{
	font-size: 20px;
	font-weight: 400;
	color: #818181;
}
.box-icon{
	font-size: 40px!important;
    float: right;
    margin-top: 35px!important;
    color: #818181;
    padding-right: 10px;
}
.col-div-8{
	width: 70%;
	float: left;
}
.col-div-4{
	width: 30%;
	float: left;
}
.content-box{
	padding: 20px;
}
.content-box p{
	margin: 0px;
    font-size: 20px;
    color: #f7403b;
}
.content-box p span{
	float: right;
    background-color: #ddd;
    padding: 3px 10px;
    font-size: 15px;
}
.box-8, .box-4{
	width: 95%;
	background-color: #272c4a;
	height: 330px;
	
}
.nav2{
	display: none;
}

.box-8{
	margin-left: 10px;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}
td, th {
  text-align: left;
  padding:15px;
  color: #ddd;
  border-bottom: 1px solid #81818140;
}
.circle-wrap {
  margin: 50px auto;
  width: 150px;
  height: 150px;
  background: #e6e2e7;
  border-radius: 50%;
}
.circle-wrap .circle .mask,
.circle-wrap .circle .fill {
  width: 150px;
  height: 150px;
  position: absolute;
  border-radius: 50%;
}
.circle-wrap .circle .mask {
  clip: rect(0px, 150px, 150px, 75px);
}

.circle-wrap .circle .mask .fill {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #f7403b;
}
.circle-wrap .circle .mask.full,
.circle-wrap .circle .fill {
  animation: fill ease-in-out 3s;
  transform: rotate(126deg);
}

@keyframes fill {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(126deg);
  }
}
.circle-wrap .inside-circle {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  background: #fff;
  line-height: 130px;
  text-align: center;
  margin-top: 10px;
  margin-left: 10px;
  position: absolute;
  z-index: 100;
  font-weight: 700;
  font-size: 2em;
}
	</style>
</head>
<body>
	<div id="mySidenav" class="sidenav">
		<p class="logo"><span>Book</span>-me</p>
		<a href="#" class="icon-a active" data-option="dashboard"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
    <a href="#" class="icon-a" data-option="create-category"><i class="fa fa-users icons"></i> Create a category</a>

    <a href="#" class="icon-a" data-option="view-category" name="vieww"><i class="fa fa-list icons"></i> View categories</a>
    <a href="#" class="icon-a" data-option="create-tag"><i class="fa fa-users icons"></i> Create a tag</a>
    <a href="#" class="icon-a" data-option="view-tag"><i class="fa fa-list icons"></i> View tags</a>
		<a href="#" class="icon-a" data-option="create-post"><i class="fa fa-users icons"></i> Create a post</a>
	
		<a href="#" class="icon-a" data-option="view-posts"><i class="fa fa-shopping-bag icons"></i> View my posts</a>
		
		<a href="logout.php" class="icon-a"><i class="fa fa-sign-out icons"></i> Sign Out</a>
	</div>
	<div id="main">
		<div class="head">
			<div class="col-div-6">
				<span style="font-size:30px;cursor:pointer; color: white;" class="nav">&#9776; Dashboard</span>
				<span style="font-size:30px;cursor:pointer; color: white;" class="nav2">&#9776; Dashboard</span>
			</div>
			<div class="col-div-6">
				<div class="profile">
					<img src="data:image/png;base64,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" class="pro-img" />
					<p>Admin <span></span></p>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="dashboard">
			<div class="message-container">
				<h2>Welcome Mr. Aaqib Hasanie!</h2>
				<p>If no one else has not told you today, you are doing GREAT and don't forget to drink water and eat food because that's all that matter.</p>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
                                                $(document).ready(function() {
    displayDashboard();
});
		$(".nav").click(function(){
			$("#mySidenav").css('width', '70px');
			$("#main").css('margin-left', '70px');
			$(".logo").css('visibility', 'hidden');
			$(".logo span").css('visibility', 'visible');
			$(".logo span").css('margin-left', '-10px');
			$(".icon-a").css('visibility', 'hidden');
			$(".icons").css('visibility', 'visible');
			$(".icons").css('margin-left', '-8px');
			$(".nav").css('display', 'none');
			$(".nav2").css('display', 'block');
			if ($(".dashboard").hasClass("active")) {
				$(".message-container").show();
			}
		});

		$(".nav2").click(function(){
			$("#mySidenav").css('width', '300px');
			$("#main").css('margin-left', '300px');
			$(".logo").css('visibility', 'visible');
			$(".icon-a").css('visibility', 'visible');
			$(".icons").css('visibility', 'visible');
			$(".nav").css('display', 'block');
			$(".nav2").css('display', 'none');
			if ($(".dashboard").hasClass("active")) {
				$(".message-container").show();
			}
		});

$(document).on("click", ".icon-a", function() {
    var option = $(this).data("option");


    if (option === "dashboard") {
        displayDashboard();
    } 

	else if (option === "view-category") {
		displayViewCategory();
	}

	else if (option === "create-tag") {
		displayCreateTagForm();
	}
	else if (option === "view-tag") {
		displayViewTag();
	}

	else if (option === "create-post") {
		displayCreatePostForm();
	}

	 else if (option === "view-posts") {
        displayViewPosts();
    }
	else {
        // $(".dashboard").removeClass("active");
        // $(".message-container").hide();

        if (option === "create-category") {
            displayCreateCategoryForm();
        }
    }
});

function displayDashboard() {
    $(".dashboard").addClass("active");
    $(".message-container").show();
    $(".dashboard").html(`
        <div class="message-container">
            <h2>Welcome Admin!</h2>
            <p>If no one else has told you today, you are doing GREAT, and don't forget to drink water and eat food because that's all that matters.</p>
        </div>
    `);
}

var isEditFormDisplayed = false;

function displayViewCategory() {
    // Create a container element
    var container = $("<div class='form-container'></div>");

    // Append the container to the dashboard
    $(".dashboard").html(container);

    // Add the "View Categories" screen to the container
    var viewCategoriesScreen = `
    <br> <br>
    <navbar style="background: red; font-size: 20px; margin-left: 100px;"> Category will not be deleted if present in a post<navbar>
        <div class="message-container">
            <h2>View Categories</h2>
            <table id="category-table">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    `;
    container.append('<div id="edit-form-container"></div>');
    container.append(viewCategoriesScreen);

    // Make AJAX request to fetch categories from backend
    $.ajax({
        url: "insert.php?view=true",
        method: "GET",
        dataType: "json",
        success: function (response) {
            // Populate the table body with category data
            var tableBody = $("#category-table tbody");
            tableBody.empty(); // Remove any existing tbody elements

            $.each(response, function (index, category) {
                var row = $("<tr></tr>");
                row.append(`<td>${category.id}</td>`);
                row.append(`<td>${category.name}</td>`);
                row.append(`
                    <td>
                        <button class="delete-category-button" data-id="${category.id}" onclick="deleteCategory(${category.id})">
                            Delete
                        </button>
                        <button class="edit-category-button" onclick="displayEditForm(${category.id}, '${category.name}')">
                            Edit
                        </button>
                    </td>
                `);
                tableBody.append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
            // Handle error
        }
    });
}



function displayEditForm(categoryId, categoryName) {
    // Check if edit form is already displayed
    if (isEditFormDisplayed) {
        return;
    }

    // Create the form HTML
    var form = `
        <div class="message-container edit-form">
            <h2>Edit Category</h2>
            <form id="edit-category-form" method="POST" action="insert.php">
                <label for="category-name">Category Name:</label>
                <input type="text" id="category-name" name="updatedName" value="${categoryName}" required>
                <input type="hidden" name="updateCategory">
                <input type="hidden" name="categoryId" value="${categoryId}">
                <button type="submit">Save</button>
            </form>
            <button class="close-button" onclick="closeEditForm()">Close</button>
        </div>
    `;

    // Append the form to the edit-form-container
    $("#edit-form-container").html(form);

    // Update the flag to indicate the edit form is displayed
    isEditFormDisplayed = true;
}


function closeEditForm() { 
    // Remove the edit form from the edit-form-container
    $("#edit-form-container").empty();

    // Update the flag to indicate the edit form is not displayed
    isEditFormDisplayed = false;
}


function deleteCategory(categoryId) {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this category?");

    if (confirmDelete) {
        // Make AJAX request to delete the category from the backend
        $.ajax({
            url: "insert.php",
            method: "POST",
            data: {
                deleteCategory: true,
                categoryId: categoryId
            },
            success: function(response) {
                // Category deleted successfully
                console.log(response);
                

                // Refresh the category list
                displayViewCategory();
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error
            }
        });
    }
}


function deleteTag(tagId) {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this tag?");

    if (confirmDelete) {
        // Make AJAX request to delete the category from the backend
        $.ajax({
            url: "insert.php",
            method: "POST",
            data: {
                deleteTag: true,
                tagId: tagId
            },
            success: function(response) {
    if (response === "error") {
        alert("Tag cannot be deleted because it is present in a post");
    } else {
        // alert("Tag deleted successfully");
        // Refresh the category list
        displayViewTag();
    }
},

            error: function(xhr, status, error) {
                alert ("Tag not deleted because it is present in a post");
                console.error(error);
                // Handle error
            }
        });
    }
}



function displayViewTag() {
    $(".dashboard").html(`
     <br> <br>
    <navbar style="background: red; font-size: 20px; margin-left: 100px;"> Tag will not be deleted if present in a post<navbar>
        <div class="message-container">
            <h2>View Tags</h2>
            <table id="category-table">
                <thead>
                    <tr>
                        <th>Tag ID</th>
                        <th>Tag Name</th>
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    `);

    // Make AJAX request to fetch categories from backend 
    $.ajax({
        url: "insert.php?viewTag=true",
        method: "GET",
        dataType: "json",
        success: function(response) {
            // Populate the table body with category data
            var tableBody = $("#category-table tbody");
            tableBody.empty(); // Remove any existing tbody elements

            $.each(response, function(index, tag) {
                var row = $("<tr></tr>");
                row.append(`<td>${tag.id}</td>`);
                row.append(`<td>${tag.name}</td>`);
                 row.append(`
                    <td>
                        <button class="delete-category-button" data-id="${tag.id}" onclick="deleteTag(${tag.id})">
                            Delete
                        </button>
                        <button class="edit-category-button" onclick="displayEditFormTag(${tag.id}, '${tag.name}')">
                            Edit
                        </button>
                    </td>
                `);
                tableBody.append(row);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error
        }
    });
}

function displayEditFormTag(id, tagName) {
    // Create the edit form HTML
    var editFormHTML = `
        <div class="message-container edit-form">
            <h2>Edit Category</h2>
            <form id="edit-category-form" method="POST" action="insert.php">
                <label for="category-name">Category Name:</label>
                <input type="text" id="category-name" name="updatedName" value="${tagName}" required>
                <input type="hidden" name="updateTag">
                <input type="hidden" name="tagId" value="${id}">
                <button type="submit">Save</button>
            </form>
            <button class="close-button" onclick="closeEditFormt()">Close</button>
        </div>
    `;

    // Display the edit form HTML above the message-container
    $(".dashboard .message-container").before(editFormHTML);

    // Handle form submission
    $("#edit-category-form").on("submit", function(event) {
        event.preventDefault();

        // Perform AJAX request to update the tag
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: $(this).serialize(),
            success: function(response) {
                alert("Tag Updated Successfully"); // Show the response message from the backend

                // Refresh the view after updating the tag
                displayViewTag();

                // Close the edit form
                closeEditFormt();
            },
            error: function(xhr, status, error) {
                alert("error");
                console.error(error);
                // Handle error
            }
        });
    });
}

function closeEditFormt() {
    // Remove the edit form from the DOM
    $(".edit-form").remove();
}









function displayCreateCategoryForm() {
    $(".dashboard").html(`
        <div class="message-container">
            <h2>Create a Category</h2>
            <form action="insert.php"  id="create-category-form" method="POST">
                <label for="category-name">Enter category name:</label>
                <input type="text" id="category-name" name="category_name" required>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    `);
}

function displayCreateTagForm() {
	$(".dashboard").html(`
		<div class="message-container">
			<h2>Create a Tag</h2>
			<form action="insert.php" id="create-tag-form" method="POST">
				<label for="tag-name">Enter tag name:</label>
				<input type="text" id="tag-name" name="tag_name" required>
				<button type="submit" name="submitt">Submit</button>
			</form>
		</div>
	`);
}


function displayCreatePostForm() {
    $(".dashboard").html(`
        <div class="message-container">
            <h2>Create a Post</h2>
            <form action="insert.php" id="create-post-form" method="POST">

                <label for="post-description">Description:</label>
                <textarea id="post-description" name="post_description" required></textarea>

                <br><br>

                <label for="post-category">Category:</label>
                <select id="post-category" name="post_category" required>
                    <!-- Populate the options dynamically from the backend -->
                </select>

                <br><br>

                <label for="post-tags">Tags:</label>
                <select id="post-tags" name="post_tags_data" required>
                    <!-- Populate the options dynamically from the backend -->
                </select>
				
                <div id="selected-tags-container">
                    <ul id="selected-tags-list"></ul>
					<!-- This is the place where tags are displayed -->
                </div>
			
                <input type="hidden" id="selected-tags-data" name="post_tags_data" required>
                <input type="hidden" id="post-id" name="post_id" required>

                <button type="submit" name="submitPost">Submit</button>
            </form>
        </div>
    `);

    var selectedTagsData = []; // Array to store selected tag values

    // Make AJAX request to fetch tags from backend and populate the select options
    $.ajax({
        url: "insert.php?viewTag=true",
        method: "GET",
        dataType: "json",
        success: function(response) {
            var selectElement = $("#post-tags");

            $.each(response, function(index, tag) {
                selectElement.append(`<option value="${tag.name}">${tag.name}</option>`);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error
        }
    });

    // Handle the selection of tags and display them in the selected tags container
    $("#post-tags").on("change", function() {
        var selectedTags = Array.from($("#post-tags option:selected"));
        var selectedTagsList = $("#selected-tags-list");

        selectedTags.forEach(function(tag) {
            var tagId = $(tag).val();
            var tagName = $(tag).text();
            if (!$(`li[data-id="${tagId}"]`).length) {
                selectedTagsList.append(`<li class="selected-tag" data-id="${tagId}">${tagName}<i class="fa fa-times remove-tag"></i></li>`);
                selectedTagsData.push(tagId); // Add the tag value to selectedTagsData array
            }
        });
    });

    // Remove a selected tag when the remove-tag button is clicked
    $(document).on("click", ".remove-tag", function() {
        $(this).parent().remove();
    });

    // Make AJAX request to fetch categories from backend and populate the select options
    $.ajax({
        url: "insert.php?view=true",
        method: "GET",
        dataType: "json",
        success: function(response) {
            var selectElement = $("#post-category");

            $.each(response, function(index, category) {
                selectElement.append(`<option value="${category.name}">${category.name}</option>`);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error
        }
    });

    // Submit form handler
    $("#create-post-form").on("submit", function() {
        $("#selected-tags-data").val(selectedTagsData.join(',')); // Convert the array to a comma-separated string
    });
}

function deletePost(postId) {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this post?");

    if (confirmDelete) {
        // Make AJAX request to delete the post from the backend
        $.ajax({
            url: "insert.php",
            method: "POST",
            data: {
                deletePost: true,
                postId: postId
            },
            success: function(response) {
                // Post deleted successfully
                console.log(response);
                alert("Post deleted successfully");
                // Refresh the post list
                displayViewPosts();
            },
            error: function(xhr, status, error) {
                alert("Post not deleted");
                console.error(error);
                // Handle error
            }
        });
    }
}

function editPost(postId, description, category, tags) {
  // Display the form for editing the post
  $(".dashboard").html(`
    <div class="message-container">
      <h2>Edit Post</h2>
      <form action="insert.php" id="edit-post-form" method="POST">
        <input type="hidden" name="post_id" value="${postId}">
        
        <label for="post-description">Description:</label>
        <textarea id="post-description" name="post_description" required>${description}</textarea>
        
        <br><br>
        
        <label for="post-category">Category:</label>
        <select id="post-category" name="post_category" required>
          <!-- Populate the options dynamically from the backend -->
        </select>
        
        <br><br>
        
        <label for="post-tags">Tags:</label>
        <select id="post-tags" name="post_tags_data" required multiple>
          <!-- Populate the options dynamically from the backend -->
        </select>
        
        <div id="selected-tags-container">
          <ul id="selected-tags-list">
            <!-- Display selected tags here -->
          </ul>
        </div>
        
        <button type="submit" name="submitEditPost">Update</button>
      </form>
    </div>
  `);

  var selectedTagsData = tags.split(',');

  // Make AJAX request to fetch tags from the backend and populate the select options
  $.ajax({
    url: "insert.php?viewTag=true",
    method: "GET",
    dataType: "json",
    success: function (response) {
      var selectElement = $("#post-tags");

      $.each(response, function (index, tag) {
        var selected = selectedTagsData.includes(tag.name) ? "selected" : "";
        selectElement.append(`<option value="${tag.name}" ${selected}>${tag.name}</option>`);
      });

      // Trigger the change event to display the selected tags initially
      selectElement.trigger("change");
    },
    error: function (xhr, status, error) {
      console.error(error);
      // Handle error
    }
  });

  // Handle the selection of tags and display them in the selected tags container
  $("#post-tags").on("change", function () {
    var selectedTags = Array.from($("#post-tags option:selected"));
    var selectedTagsList = $("#selected-tags-list");

    selectedTagsList.empty();

    selectedTagsData.forEach(function (tag) {
      selectedTagsList.append(`<li>${tag} <button class="tag-close-button">X</button></li>`);
    });

    selectedTags.forEach(function (tag) {
      var tagName = $(tag).val();
      if (!selectedTagsData.includes(tagName)) {
        selectedTagsList.append(`<li>${tagName} <button class="tag-close-button">X</button></li>`);
        selectedTagsData.push(tagName);
      }
    });
  });

  // Remove the selected tag when the close button is clicked
  $(document).on("click", ".tag-close-button", function () {
    var selectedTag = $(this).parent().text().trim();
    $(this).parent().remove();

    var index = selectedTagsData.indexOf(selectedTag);
    if (index > -1) {
      selectedTagsData.splice(index, 1);
    }
  });

  // Make AJAX request to fetch categories from the backend and populate the select options
  $.ajax({
    url: "insert.php?view=true",
    method: "GET",
    dataType: "json",
    success: function (response) {
      var selectElement = $("#post-category");

      $.each(response, function (index, category) {
        var selected = (category.name === category) ? "selected" : "";
        selectElement.append(`<option value="${category.name}" ${selected}>${category.name}</option>`);
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
      // Handle error
    }
  });

  // Submit form handler
  $("#edit-post-form").on("submit", function () {
    // Update the selected tags data field with the selected tags
    var selectedTags = Array.from($("#selected-tags-list li")).map(tag => $(tag).text().trim().slice(0, -1));
    $("#post-tags").val(selectedTags);

    // Update the selected tags data field with the selected tags
    var selectedTagsDataInput = $('<input>')
      .attr('type', 'hidden')
      .attr('name', 'post_tags_data')
      .val(selectedTags.join(','));

    $(this).append(selectedTagsDataInput);
  });
}


function displayViewPosts() {
    // Centering this div and making its background color white
    $(".dashboard").html(`
        <h2 style="color:white; text-align:center;">Your Posts</h2>
        <div class="post-container">
            <div id="posts-list" class="posts-list"></div>
        </div>
    `);

    // Make AJAX request to fetch user's posts from the backend
    $.ajax({
        url: "insert.php?viewPost=true",
        method: "GET",
        dataType: "json",
        success: function(response) {
            var postsList = $("#posts-list");

            // Check if there are any posts
            if (response.length > 0) {
                $.each(response, function(index, post) {
                    var postHtml = `
                        <div class="post">
                            <h3 class="post-category">${post.category}</h3>
                            <p class="post-description">${post.descrip}</p>
                            <ul class="tags">Tags: 
                    `;

                    // Display tags if available
                    if (post.tags) {
                        var tags = post.tags.split(",");
                        tags.forEach(function(tag) {
                            postHtml += `<li>${tag.trim()}</li>`;
                        });
                    }

                    postHtml += `
                            </ul>
                           <div class="post-buttons">
    <button class="edit-button" onclick="editPost('${post.id}','${post.descrip}','${post.category}','${post.tags}')">Edit Post</button>
    <button class="delete-button" onclick="deletePost(${post.id})">Delete Post</button>
</div>

                        </div>
                    `;

                    postsList.append(postHtml);
                });
            } else {
                postsList.append("<p>No posts found.</p>");
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error
        }
    });
}

	</script>
</body>
</html>
