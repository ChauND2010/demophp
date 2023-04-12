<?php
    require("mysql_connect.php");

    $id = (int) $_GET["id"];
    if ($stmt = mysqli_prepare($conn, "SELECT * FROM notes WHERE id = ?"))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $note = $stmt->get_result();
        mysqli_stmt_close($stmt);
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Read</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP CRUD</a>
        </div>
    </nav>

    <div class="container">
        <div class="row pt-3">
            <div class="col">
                <div class="card">
                    <?php
                    if ($note->num_rows > 0) {
                        while ($row = $note->fetch_assoc()) {
                            $id = $row["id"];
                            $title = $row["title"];
                            $content = $row["content"];
                            $priority = ucfirst($row["priority"]);

                            echo "
                                    <h1 class='card-header text-center'>$id - $title</h1>
                                    <div class='card-body'>
                                        Content:
                                        $content
                                        <hr>
                                        Priority: $priority
                                    </div>
                                ";
                        }
                    }

                    echo '
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="index.php">Back</a>
                            <a class="btn btn-secondary" href="update.php?id='.$id.'">Edit</a>
                            <a class="btn btn-danger" href="delete.php?id='.$id.'">Delete</a>
                        </div>'

                    ?>
                    
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>
