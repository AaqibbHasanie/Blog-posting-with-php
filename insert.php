<?php
session_start();

// Create a connection to the database
$servername = "localhost";  // Replace with your database server name
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "userdeets";      // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['post_id'])) {
    // If the session variable doesn't exist, initialize it with a value of 1
    $_SESSION['post_id'] = 1;
}


if (isset($_POST['deleteCategory'])) {
    $categoryId = $_POST['categoryId'];

    // Retrieve the name of the category
    $getCategoryNameQuery = "SELECT name FROM category WHERE id = '$categoryId'";
    $getCategoryNameResult = mysqli_query($conn, $getCategoryNameQuery);

    if ($getCategoryNameResult) {
        $row = mysqli_fetch_assoc($getCategoryNameResult);
        $categoryName = $row['name'];

        // Check if the category exists in the posts table
        $checkQuery = "SELECT COUNT(*) as count FROM posts WHERE category = '$categoryName'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult) {
            $row = mysqli_fetch_assoc($checkResult);
            $count = $row['count'];
            if ($count > 0) {
                // Category is associated with posts, display error message
                $message = "Category '$categoryName' cannot be deleted because it is associated with one or more posts.";
                echo "<script> 
                          alert('$message');
                          // Redirect to category.php
                          window.location.href = 'category.php';
                      </script>";
                exit; // Terminate the execution of the script
            }
        }

        // Perform the delete query
        $deleteQuery = "DELETE FROM category WHERE id = '$categoryId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            // Deletion successful
            $message = "Category deleted successfully.";
        } else {
            // Handle database query error
            $message = "Error occurred while deleting category.";
        }

        echo "<script> 
                  alert('$message');
                  // Redirect to category.php
                  window.location.href = 'category.php';
              </script>";
    } else {
        // Handle error retrieving category name
        $message = "Error occurred while retrieving category information.";
        echo "<script> 
                  alert('$message');
                  // Redirect to category.php
                  window.location.href = 'category.php';
              </script>";
    }
}


if (isset($_POST['deletePost'])) {
    $postId = $_POST['postId'];

    // Perform the delete query for the post
    $deleteQuery = "DELETE FROM posts WHERE id = '$postId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    // Perform the delete query for the corresponding tags in the pivottable
    $deleteTagsQuery = "DELETE FROM pivottable WHERE postid = '$postId'";
    $deleteTagsResult = mysqli_query($conn, $deleteTagsQuery);

    if ($deleteResult && $deleteTagsResult) {
        // Deletion successful
        $message = "Post and associated tags deleted successfully.";
    } else {
        // Handle database query error
        $message = "Error occurred while deleting the post and associated tags.";
    }
    
    echo "<script> 
              alert('$message');
              // Redirect to desired page
              window.location.href = 'desired_page.php';
          </script>";
}



if (isset($_POST['deleteTag'])) {
    $tagId = $_POST['tagId'];

    // Retrieve the name of the tag
    $getTagNameQuery = "SELECT name FROM tags WHERE id = '$tagId'";
    $getTagNameResult = mysqli_query($conn, $getTagNameQuery);

    if ($getTagNameResult) {
        $row = mysqli_fetch_assoc($getTagNameResult);
        $tagName = $row['name'];

        // Check if the tag exists in the pivottable
        $checkQuery = "SELECT COUNT(*) as count FROM pivottable WHERE tagname = '$tagName'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult) {
            $row = mysqli_fetch_assoc($checkResult);
            $count = $row['count'];
            if ($count > 0) {
    // Tag is present in the pivottable, display error message
    $message = "Tag '$tagName' cannot be deleted because it is associated with one or more posts.";
    echo "<script> 
              alert('$message');
              // Redirect to desired page
              window.location.href = 'category.php';
          </script>";
    exit; // Terminate the execution of the script
}

        }

        // Perform the delete query
        $deleteQuery = "DELETE FROM tags WHERE id = '$tagId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            // Deletion successful
            $message = "Tag '$tagName' deleted successfully.";
        } else {
            // Handle database query error
            $message = "Error occurred while deleting tag.";
        }

        echo "<script> 
                  alert('$message');
                  // Redirect to desired page
                  window.location.href = 'tagDeleted.php';
              </script>";
    } else {
        // Handle error retrieving tag name
        $message = "Error occurred while retrieving tag information.";
        echo "<script> 
                  alert('$message');
                  // Redirect to desired page
                  window.location.href = 'category.php';
              </script>";
    }
}







if (isset($_POST['submitPost'])) {
    // Validate and sanitize the input data
    $email = $_SESSION['user_id'];
    $category = $_POST['post_category'];
    $tags = $_POST['post_tags_data']; // This will contain the selected tags as a JSON string
    $description = $_POST['post_description'];
    $postid = $_SESSION['post_id']; // Retrieve the post ID from the session
    $_SESSION['post_id'] += 1; // Increment the post ID for the next post

    // Prepare and execute the insert statement for the "posts" table
    try {
        $stmt = $conn->prepare("INSERT INTO posts (id, email, category, tags, descrip) VALUES (?, ?, ?, ?, ?)");
    } catch (Exception $e) {
        $postid += 1;
    }

    $stmt->bind_param("sssss", $postid, $email, $category, $tags, $description);
    $stmt->execute();

    // Check if the insert into the "posts" table was successful
    if ($stmt->affected_rows > 0) {
        $message = "Post inserted successfully.";
        echo "Post inserted successfully.";

        // Split the comma-separated tags
        $tagList = explode(",", $tags);

        // Increment the post ID for the "pivottable" table
        // $postid++;

        // Insert the tags into the "pivottable" table
        foreach ($tagList as $tag) {
            // Trim leading/trailing spaces from the tag
            $tagName = trim($tag);

            // Prepare and execute the insert statement for the "pivottable" table
            $pivottableStmt = $conn->prepare("INSERT INTO pivottable (`postid`, `tagname`) VALUES (?, ?)");
            $pivottableStmt->bind_param("ss", $postid, $tagName);
            $pivottableStmt->execute();
        }
    } else {
        $message = "Error inserting post: ";
        echo "Error inserting post: " . $stmt->error;
    }

    echo "<script> 
              alert('$message');
              // keep the user on the same page
              window.location.href = 'post.php';
          </script>";
}


// code for viewing all posts
if (isset($_GET["viewPost"])) {
    // Get the email of the logged-in user from the session
    $user_email = $_SESSION['user_id'];

    // Prepare the query with a WHERE clause to filter posts by user email
    $query = "SELECT id, email, category, tags, descrip FROM posts WHERE email = '$user_email'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $posts = array();

        // Fetch each row as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }

        // Send the posts as JSON response
        echo json_encode($posts);

    } else {
        // Handle database query error
        echo "Error occurred while fetching posts.";

    }
}



if (isset($_GET["view"])) {
    $query = "SELECT id, name FROM category"; // Corrected table name

    $result = mysqli_query($conn, $query);

    if ($result) {
        $categories = array();

        // Fetch each row as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }

        // Send the categories as JSON response
        echo json_encode($categories);
        
    } else {
        // Handle database query error
        echo "Error occurred while fetching categories.";
        
    }
}

if (isset($_GET["viewTag"])) {            // displaying tags
    $query = "SELECT id, name FROM tags"; // Corrected table name

    $result = mysqli_query($conn, $query);

    if ($result) {
        $tags = array();

        // Fetch each row as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $tags[] = $row;
        }

        // Send the categories as JSON response
        echo json_encode($tags);
        
    } else {
        // Handle database query error
        echo "Error occurred while fetching tags.";
        
    }
}

if (isset($_POST["submitt"])) {                /// inserting tag
    $tagName = $_POST["tag_name"];
    $tagName = $conn->real_escape_string($tagName);

    // Check if the category already exists
    $checkCategoryQuery = "SELECT id FROM tags WHERE name = '$tagName'";
    $checkCategoryResult = $conn->query($checkCategoryQuery);

    if ($checkCategoryResult->num_rows > 0) {
        $message = "Tag already exists.";
    } else {
        $existingIDs = [];
        $checkIDQuery = "SELECT id FROM tags";
        $checkIDResult = $conn->query($checkIDQuery);

        if ($checkIDResult->num_rows > 0) {
            while ($row = $checkIDResult->fetch_assoc()) {
                $existingIDs[] = $row["id"];
            }
        }

        $newID = 1;
        while (in_array($newID, $existingIDs)) {
            $newID++;
        }

        $insertCategoryQuery = "INSERT INTO tags (id, name) VALUES ('$newID', '$tagName')";

        if ($conn->query($insertCategoryQuery) === TRUE) {
            $message = "Tag created successfully with ID: " . $newID;
        } else {
            $message = "Error inserting tag: " . $conn->error;
        }
    }

    // Pass the message to the JavaScript code for displaying the prompt
    echo "<script> 
              alert('$message');
              // keep the user on the same page
              window.location.href = 'tag.php';
          </script>";
}



if (isset($_POST["submit"])) {                       // inserting a category
    $categoryName = $_POST["category_name"];
    $categoryName = $conn->real_escape_string($categoryName);

    // Check if the category already exists
    $checkCategoryQuery = "SELECT id FROM category WHERE name = '$categoryName'";
    $checkCategoryResult = $conn->query($checkCategoryQuery);

    if ($checkCategoryResult->num_rows > 0) {
        $message = "Category already exists.";
    } else {
        $existingIDs = [];
        $checkIDQuery = "SELECT id FROM category";
        $checkIDResult = $conn->query($checkIDQuery);

        if ($checkIDResult->num_rows > 0) {
            while ($row = $checkIDResult->fetch_assoc()) {
                $existingIDs[] = $row["id"];
            }
        }

        $newID = 1;
        while (in_array($newID, $existingIDs)) {
            $newID++;
        }

        $insertCategoryQuery = "INSERT INTO category (id, name) VALUES ('$newID', '$categoryName')";

        if ($conn->query($insertCategoryQuery) === TRUE) {
            $message = "Category created successfully with ID: " . $newID;
        } else {
            $message = "Error inserting category: " . $conn->error;
        }
    }

    // Pass the message to the JavaScript code for displaying the prompt
    echo "<script> 
              alert('$message');
              // keep the user on the same page
              window.location.href = 'category.php';
          </script>";
}

if (isset($_POST['submitEditPost'])) {
    $postId = $_POST['post_id'];
    $updatedDescription = $_POST['post_description'];
    $updatedCategory = $_POST['post_category'];
    $updatedTags = $_POST['post_tags_data'];

    // Perform the update query
    $query = "UPDATE posts SET descrip = '$updatedDescription', category = '$updatedCategory', tags = '$updatedTags' WHERE id = '$postId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful
        $message = "Post updated successfully.";

        // Delete all tags associated with the post from the pivottable
        $deleteQuery = "DELETE FROM pivottable WHERE postid = '$postId'";
        mysqli_query($conn, $deleteQuery);

        // Split the comma-separated tags
        $tagList = explode(",", $updatedTags);

        // Insert the new tags into the pivottable
        foreach ($tagList as $tag) {
            // Trim leading/trailing spaces from the tag
            $tagName = trim($tag);

            // Insert the tag into the pivottable
            $insertQuery = "INSERT INTO pivottable (postid, tagname) VALUES ('$postId', '$tagName')";
            mysqli_query($conn, $insertQuery);
        }

        $redirectUrl = "displayviewpost.php"; // Redirect to the dashboard or the desired page
    } else {
        // Handle database query error
        $message = "Error occurred while updating post.";
        $redirectUrl = "edit-post.php?postId=" . $postId; // Redirect back to the edit post form
    }

    echo "<script>
              alert('$message');
              window.location.href = '$redirectUrl';
          </script>";
}






if (isset($_POST['updateCategory'])) {
    $categoryId = $_POST['categoryId'];
    $updatedName = $_POST['updatedName'];

    // Perform the update query
    $query = "UPDATE category SET name = '$updatedName' WHERE id = '$categoryId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful
        $message = "Category updated successfully.";
        $redirectUrl = "categoryView.php";
    } else {
        // Handle database query error
        $message = "Error occurred while updating category.";
        $redirectUrl = "category.php"; // Redirect back to the form
    }

    echo "<script>
              alert('$message');
              window.location.href = 'n.php';
          </script>";
}

if (isset($_POST['updateTag'])) {
    $tagId = $_POST['tagId'];
    $updatedName = $_POST['updatedName'];

    // Perform the update query
    $query = "UPDATE tags SET name = '$updatedName' WHERE id = '$tagId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful
        $message = "Tag updated successfully.";
        $redirectUrl = "tagView.php";
    } else {
        // Handle database query error
        $message = "Error occurred while updating tag.";
        $redirectUrl = "tag.php"; // Redirect back to the form
    }

    echo "<script>
              alert('$message');
              window.location.href = 'n.php';
          </script>";
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if email contains the "@" symbol
    if (strpos($email, "@") === false) {
        echo "Please enter a valid email address.";
        exit; // Stop further execution
    }


    // Check if the form is submitted for signup (insertion)
    if (isset($_POST["signup"])) {
        $confirmPassword = $_POST['confirm_password'];

        // Validate if password and confirm password match
        if ($password != $confirmPassword) {
            echo "Password and confirm password do not match.";
            exit;
        }

        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT * FROM userdeets WHERE email = '$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);
        if ($checkEmailResult->num_rows > 0) {
            echo "Email already exists. Please use a different email.";
            exit;
        }
        $password = hash('sha256', $password);
        // Prepare and execute the SQL query for inserting new user details
        $insertQuery = "INSERT INTO userdeets (email, password) VALUES ('$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Signup successful. You can now log in.";
        } else {
            echo "Error inserting data: " . $conn->error;
            exit;
        }
    }

  
// Check if the form is submitted for creating a category
// Check if the form is submitted for creating a category
if (isset($_POST["submit"])) {
    $categoryName = $_POST["category_name"];

    // Escape special characters in the category name to prevent SQL injection
    $categoryName = $conn->real_escape_string($categoryName);

    // Construct the SQL query to insert a new category
    $insertCategoryQuery = "INSERT INTO category (name) VALUES ('$categoryName')";

    // Execute the query
    if ($conn->query($insertCategoryQuery) === TRUE) {
        echo "Category created successfully.";
        exit;
    } else {
        echo "Error inserting category: " . $conn->error;
    }
}



    // Check if the form is submitted for login
  if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);
    // Validate login credentials
    $loginQuery = "SELECT * FROM userdeets WHERE email = '$email' AND password = '$password'";
    $loginResult = $conn->query($loginQuery);
    if ($loginResult->num_rows > 0) {
        $user = $loginResult->fetch_assoc();
        $_SESSION['user_id'] = $email; // Assign the user_id to the session variable

        // Redirect to the desired page after successful login
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid email or password.";
        exit;
    }
}

}

// Close the database connection
$conn->close();
?>
