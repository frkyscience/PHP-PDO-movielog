<?php
require_once "config.php";

// Initialize variables
$id = $title = $rating = $has_won_awards = $seasons = $country = $language = $summary = $description = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $has_won_awards = $_POST['has_won_awards'];
    $seasons = $_POST['seasons'];
    $country = $_POST['country'];
    $language = $_POST['language'];
    $summary = $_POST['summary'];
    $description = $_POST['description'];

    $sql = "UPDATE series SET title=?, rating=?, has_won_awards=?, summary=?, seasons=?, country=?, language=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $rating, $has_won_awards, $summary, $seasons, $country, $language, $description, $id]);

    header("Location: detail_series.php?id=$id");
    exit;
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM series WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $series = $stmt->fetch(PDO::FETCH_ASSOC);

    $title = $series['title'];
    $rating = $series['rating'];
    $has_won_awards = $series['has_won_awards'];
    $seasons = $series['seasons'];
    $country = $series['country'];
    $language = $series['language'];
    $summary = $series['summary'];
    $description = $series['description'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Series Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">add Series </h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="text" name="rating" class="form-control" value="<?php echo $rating; ?>" required>
            </div>
            <div class="mb-3">
                <label for="has_won_awards" class="form-label">Has Won Awards</label>
                <input type="text" name="has_won_awards" class="form-control" value="<?php echo $has_won_awards; ?>" required>
            </div>
            <div class="mb-3">
                <label for="seasons" class="form-label">Seasons</label>
                <input type="number" name="seasons" class="form-control" value="<?php echo $seasons; ?>" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" class="form-control" value="<?php echo $country; ?>" required>
            </div>
            <div class="mb-3">
                <label for="language" class="form-label">Language</label>
                <input type="text" name="language" class="form-control" value="<?php echo $language; ?>" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <input type="text" name="summary" class="form-control" value="<?php echo $summary; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>