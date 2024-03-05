<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $released_at = $_POST['released_at'];
        $country_of_origin = $_POST['country_of_origin'];
        $length_in_minutes = $_POST['length_in_minutes'];
        $summary = $_POST['summary'];

        $sql = "UPDATE movies SET title=?, released_at=?, country_of_origin=?, length_in_minutes=?, summary=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $released_at, $country_of_origin, $length_in_minutes, $summary, $id]);

        header("Location: detail_movie.php?id=$id");
        exit;
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM movies WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Movie Details</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Movie Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $movie['title']; ?>" required>
            </div>
            <div class="form-group">
                <label>Date Released</label>
                <input type="text" name="released_at" class="form-control" value="<?php echo $movie['released_at']; ?>" required>
            </div>
            <div class="form-group">
                <label>Country of Origin</label>
                <input type="text" name="country_of_origin" class="form-control" value="<?php echo $movie['country_of_origin']; ?>" required>
            </div>
            <div class="form-group">
                <label>Duration (in minutes)</label>
                <input type="number" name="length_in_minutes" class="form-control" value="<?php echo $movie['length_in_minutes']; ?>" required>
            </div>
            <div class="form-group">
                <label>Summary</label>
                <textarea name="summary" class="form-control" rows="5" required><?php echo $movie['summary']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>