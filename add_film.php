<?php
require_once "config.php";

$title = $length_in_minutes = $released_at = $country_of_origin = $summary = $youtube_trailer_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $length_in_minutes = $_POST['length_in_minutes'];
    $released_at = $_POST['released_at'];
    $country_of_origin = $_POST['country_of_origin'];
    $summary = $_POST['summary'];
    $youtube_trailer_id = $_POST['youtube_trailer_id'];

    $sql = "INSERT INTO movies (title, length_in_minutes, released_at, country_of_origin, summary, youtube_trailer_id)
            VALUES (:title, :length_in_minutes, :released_at, :country_of_origin, :summary, :youtube_trailer_id)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':length_in_minutes', $length_in_minutes);
    $stmt->bindParam(':released_at', $released_at);
    $stmt->bindParam(':country_of_origin', $country_of_origin);
    $stmt->bindParam(':summary', $summary);
    $stmt->bindParam(':youtube_trailer_id', $youtube_trailer_id);

    $stmt->execute();

    echo "New movie created successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add Movie</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="length_in_minutes" class="form-label">Length (in minutes):</label>
                <input type="number" class="form-control" id="length_in_minutes" name="length_in_minutes" required>
            </div>
            <div class="mb-3">
                <label for="released_at" class="form-label">Release Date:</label>
                <input type="date" class="form-control" id="released_at" name="released_at" required>
            </div>
            <div class="mb-3">
                <label for="country_of_origin" class="form-label">Country of Origin:</label>
                <input type="text" class="form-control" id="country_of_origin" name="country_of_origin" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary:</label>
                <textarea class="form-control" id="summary" name="summary" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="youtube_trailer_id" class="form-label">YouTube Trailer ID:</label>
                <input type="text" class="form-control" id="youtube_trailer_id" name="youtube_trailer_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
