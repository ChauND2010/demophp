<?php
    require("mysql_connect.php");
    $note = mysqli_query($conn, 'SELECT * FROM notes');
    $rowcount = mysqli_num_rows($note);
    echo $note;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset=UTF-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP CRUD</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($note -> fetch_assoc() > 0) {
                                while($row = $note -> fetch_assoc()) {
                                    $id = $row["id"];
                                    $title = $row["title"];
                                    $content = $row["content"];
                                    $priority = ucfirst($row["priority"]);
                                    
                                    echo "
                                        <tr>
                                            <th scope='row'>$id</th>
                                            <td>$title</td>
                                            <td>$content</td>
                                            <td>$priority</td>
                                            <td>
                                                <a class='btn btn-secondary' href='read_one.php?id=$id'>Read</a> 
                                                <a class='btn btn-secondary' href='update.php?id=$id'>Edit</a> 
                                                <a class='btn btn-danger' href='delete.php?id=$id'>Delete</a>
                                            </td>
                                        </tr>";
                                }
                            }
                            else {

                            }
                        ?>

                    </tbody>
                </table>

                <a class="btn btn-primary float-end m-4 ps-3 pe-3" href="create.php">Create a new note</a>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>
