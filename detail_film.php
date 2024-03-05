<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM movies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($movie) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Movie Details</title>
        </head>

        <body class="bg-dark text-light">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h1><?= $movie['title'] ?></h1>
                        <table class="table table-bordered text-light">
                            <tbody>
                                <tr>
                                    <td><strong>Datum van uitkomst:</strong></td>
                                    <td><?= $movie['released_at'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Land van herkomst:</strong></td>
                                    <td><?= $movie['country_of_origin'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Duur:</strong></td>
                                    <td><?= $movie['length_in_minutes'] ?> minuten</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4>Description:</h4>
                        <p><?= $movie['summary'] ?></p>
                        <a href="edit_film.php?id=<?= $movie['id'] ?>" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "Movie not found.";
    }
} else {
    echo "Invalid request. Please provide a valid movie ID.";
}
?>