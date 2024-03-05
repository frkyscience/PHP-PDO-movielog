<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM series WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $series = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($series) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Series Details</title>
        </head>

        <body class="bg-dark text-white">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h1><?= $series['title'] ?></h1>
                        <table class="table table-bordered text-light">
                            <tbody>
                                <tr>
                                    <td><strong>Has won Award:</strong></td>
                                    <td><?= $series['has_won_awards'] ? 'Ja' : 'Nee' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Rating:</strong></td>
                                    <td><?= $series['rating'] ?> </td>
                                </tr>
                                <tr>
                                    <td><strong>Seasons:</strong></td>
                                    <td><?= $series['seasons'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Country:</strong></td>
                                    <td><?= $series['country'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Language:</strong></td>
                                    <td><?= $series['spoken_in_language'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <h4>Description:</h4>
                        <p><?= $series['summary'] ?></p>
                        <a href="edit_serie.php?id=<?= $series['id'] ?>" class="btn btn-primary">Edit</a>

                    </div>
                </div>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "Series not found.";
    }
} else {
    echo "Invalid request. Please provide a valid series ID.";
}
?>