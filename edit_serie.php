<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $rating = $_POST['rating'];
        $has_won_awards = $_POST['has_won_awards'];
        $seasons = $_POST['seasons'];
        $country = $_POST['country'];
        $language = $_POST['language'];
        $description = $_POST['description'];

        $sql = "UPDATE series SET title=?, rating=?, has_won_awards=?, seasons=?, country=?, language=?, description=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $rating, $has_won_awards, $seasons, $country, $language, $description, $id]);

        header("Location: detail_series.php?id=$id");
        exit;
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM series WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $series = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Series Details</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Series Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $series['id']; ?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $series['title']; ?>" required>
            </div>
            <div class="form-group">
                <label>Rating</label>
                <input type="text" name="rating" class="form-control" value="<?php echo $series['rating']; ?>" required>
            </div>
            <div class="form-group">
                <label>Has Won Awards</label>
                <input type="text" name="has_won_awards" class="form-control" value="<?php echo $series['has_won_awards']; ?>" required>
            </div>
            <div class="form-group">
                <label>Seasons</label>
                <input type="number" name="seasons" class="form-control" value="<?php echo $series['seasons']; ?>" required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" value="<?php echo $series['country']; ?>" required>
            </div>
            <div class="form-group">
                <label>Language</label>
                <input type="text" name="spoken_in_language" class="form-control" value="<?php echo $series['spoken_in_language']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>