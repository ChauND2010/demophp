<?php
require('mysql_connect.php');

$id = (int) $_GET['id'];
$title = $content = $priority = "";
$sql_select = "SELECT * FROM notes WHERE id = $id";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    $priority = htmlspecialchars($_POST["priority"]);

    if (!empty($title) && !empty($content) && !empty($priority)) {

        if ($stmt = mysqli_prepare($conn, "UPDATE notes SET title=?, content=?, priority=? WHERE id = ?"))
        {
            mysqli_stmt_bind_param($stmt, 'sssi', $title, $content, $priority, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo '<div class="alert alert-success" role="alert">
                    Record updated successfully
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    An error occurred while updating
                  </div>';
        }

    }
}

$note = $conn->query($sql_select);
$conn->close();
?>

<!DOCTYPE html>
<html lang='vi'>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>CRUD - Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='index.php'>PHP CRUD</a>
        </div>
    </nav>

    <div class='container'>
        <div class='row pt-3'>
            <div class='col'>
                <div class='card'>
                    <span>
                        <a class='m-2' href='index.php'>Back</a>
                        <h1 class='card-title text-center'>UPDATE A NOTE</h5>
                    </span>
                    <div class='card-body'>
                        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?id=$id"); ?>' method='post'>

                            <?php
                            if ($note->num_rows > 0) {
                                while ($row = $note->fetch_assoc()) {
                                    $title = $row['title'];
                                    $content = $row['content'];
                                    $priority = $row['priority'];

                                    echo "
                                        <div class='mb-3'>
                                        <label for='title' class='form-label'>Title</label>
                                        <input type='text' class='form-control' id='title' name='title' placeholder='An indecredible title' value='$title' required />
                                        </div>
                                        <div class='mb-3'>
                                            <label for='content' class='form-label'>Content</label>
                                            <textarea class='form-control' id='content' name='content' placeholder='Enter your to-dos here or you won't forget!!' rows='3' required>$content</textarea>
                                        </div>
        
                                        <label for='priority' class='form-label'>Prority</label>
                                    
                                        ";
                                }
                            }
                            ?>

                            <select class='form-select' name='priority' required>
                                <option hidden>Select priority</option>
                                <option value='low' <?php if ($priority == 'low') {echo 'selected';} ?>>Low</option>
                                <option value='middle' <?php if ($priority == 'middle') {echo 'selected';} ?>>Middle</option>
                                <option value='high' <?php if ($priority == 'high') {echo 'selected';} ?>>High</option>
                            </select>

                            <div class='d-grid gap-2 pt-4'>
                                <button class='btn btn-primary' type='submit'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>