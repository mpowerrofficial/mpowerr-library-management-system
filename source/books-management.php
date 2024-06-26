<?php

include "php_controllers/db_connection.php";

session_start();

if ($_SESSION["permission"] != 'true'){
    // Redirect to index.php
    header("Location: index.php");
    die();
}

$sql = "SELECT * FROM books_details"; // Assuming your table name is "books"
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}


?>
<?php include "layout/upper_section.php";?>

<div class="container-fluid">
    <h1 class="text-center">Books Management</h1>
    <hr>

    <form style="margin-left: 150px; margin-right: 150px;" action="php_controllers/register_books.php" method="post">
        <div class="form-group">
            <label for="BookNameInput">Book Name</label>
            <input name="book_name" type="text" class="form-control" id="Book_NameInput" placeholder="Enter Book Name">
        </div>
        <div class="form-group">
            <label for="ISBNNoInput">ISBN No</label>
            <input name="isbn_no" type="text" class="form-control" id="ISBN_NoInput" placeholder="Enter ISBN No">
        </div>
        <div class="form-group">
            <label for="GenresInput">Genres</label>
            <input name="genres" type="text" class="form-control" id="GenresInput" placeholder="Enter Genres">
        </div>
        <div class="form-group">
            <label for="AuthorInput">Author</label>
            <input name="author" type="text" class="form-control" id="AuthorInput" placeholder="Enter Author">
        </div>
        <div class="form-group">
            <label for="PriceInput">Price</label>
            <input name="price" class="form-control" id="PriceInput" placeholder="Enter Book Price">
        </div>
        <div class="form-group">
            <label for="Release_DateInput">Release Date</label>
            <input name="release_date" type="text" class="form-control" id="Release_Date" placeholder="Enter Release Date">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <h1 class="text-center">Book Details</h1>
    <hr>

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Book Name</th>
                <th scope="col">ISBN No</th>
                <th scope="col">Author</th>
                <th scope="col">Genres</th>
                <th scope="col">Price</th>
                <th scope="col">Release Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Existing code ...

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['book_name']}</td>
                <td>{$row['isbn_no']}</td>
                <td>{$row['author']}</td>
                <td>{$row['genres']}</td>
                <td>{$row['price']}</td>
                <td>{$row['release_date']}</td>
                <td>
                    <a href='php_controllers/books_edit.php?auto_id={$row['auto_id']}' class='btn btn-primary'>Edit</a>
                    <a href='php_controllers/books_delete_data.php?auto_id={$row['auto_id']}' class='btn btn-danger'>Delete</a>
                </td>
              </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
    }
    ?>
                      
        </tbody>
    </table>
</div>

<?php include "layout/bottom_section.php";?>
