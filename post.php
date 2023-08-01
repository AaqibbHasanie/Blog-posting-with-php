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
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
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
					<img src="images/user.png" class="pro-img" />
					<p>Aaqib Hasanie <span>Admin</span></p>
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
    displayCreatePostForm();
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

    // if ($(this).hasClass("active")) {
    //     return;
    // }

    // $(".icon-a").removeClass("active");
    // $(this).addClass("active");

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
            <h2>Welcome Mr. Aaqib Hasanie!</h2>
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
