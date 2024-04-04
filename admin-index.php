<?php
session_start();

include 'dbinfo.php';

$articles_query = "SELECT * FROM articles";
$articles_result = mysqli_query($con, $articles_query);

$background_image_url = "back_image.png"; // Change this to the path of your background image

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<style>
    body {
        background-image: url('<?php echo $background_image_url; ?>');
        background-size: cover;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
    }
    h1 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .add-form {
        margin-bottom: 20px;
    }
    .add-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .add-form input[type="text"],
    .add-form textarea {
        width: calc(100% - 18px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .add-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #653b70;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .add-form input[type="submit"]:hover {
        background-color: #653b70
    }
</style>
</head>
<body>

<div class="container">
    <h1>Trending Articles</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
        </tr>
        <?php
        if ($articles_result->num_rows > 0) {
            while($row = $articles_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . substr($row["content"], 0, 100) . "...</td>";
                echo "<td><img src='" . $row["image_url"] . "' alt='Article Image' style='max-width: 100px; max-height: 100px;'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No articles found</td></tr>";
        }
        ?>
    </table>

    <div class="add-form">
        <h3>Add New Article</h3>
        <form method="post" action="add-article.php">
            <label for="article_title">Title:</label><br>
            <input type="text" id="article_title" name="article_title" required><br>
            <label for="article_content">Content:</label><br>
            <textarea id="article_content" name="article_content" required></textarea><br>
            <label for="article_image_url">Image URL:</label><br>
            <input type="text" id="article_image_url" name="article_image_url"><br><br> 
            <input type="submit" name="add_article" value="Add Article">
        </form>
    </div>
</div>
</body>
</html>
