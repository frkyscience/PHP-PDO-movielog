<?php
require_once "config.php";

$sortColumnSeries = isset($_GET['sort_series']) ? $_GET['sort_series'] : 'title';
$sortOrderSeries = isset($_GET['order_series']) ? $_GET['order_series'] : 'asc';

$sortColumnFilms = isset($_GET['sort_films']) ? $_GET['sort_films'] : 'title';
$sortOrderFilms = isset($_GET['order_films']) ? $_GET['order_films'] : 'asc';

$sqlSeries = "SELECT * FROM series ORDER BY $sortColumnSeries $sortOrderSeries";
$stmtSeries = $conn->prepare($sqlSeries);
$stmtSeries->execute();
$series_rows = $stmtSeries->fetchAll(PDO::FETCH_ASSOC);

$sqlFilms = "SELECT * FROM movies ORDER BY $sortColumnFilms $sortOrderFilms";
$stmtFilms = $conn->prepare($sqlFilms);
$stmtFilms->execute();
$films_rows = $stmtFilms->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Netland beheerders panel</title>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class=" text-center"> Netland beheerders Paneel</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Series</p>
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-light">
                                <td><a href="?sort_series=title&order_series=<?= ($sortColumnSeries == 'title' && $sortOrderSeries == 'asc') ? 'desc' : 'asc' ?>">Title</a></td>
                                <td><a href="?sort_series=rating&order_series=<?= ($sortColumnSeries == 'rating' && $sortOrderSeries == 'asc') ? 'desc' : 'asc' ?>">Rating</a></td>
                                <td>Action</td>
                            </tr>
                            <?php foreach ($series_rows as $row) : ?>
                                <tr>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['rating'] ?></td>
                                    <td><a href="detail_serie.php?id=<?= $row['id'] ?>" class="btn btn-primary">Details</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Films</p>
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-light">
                                <td><a href="?sort_films=title&order_films=<?= ($sortColumnFilms == 'title' && $sortOrderFilms == 'asc') ? 'desc' : 'asc' ?>">Title</a></td>
                                <td><a href="?sort_films=length_in_minutes&order_films=<?= ($sortColumnFilms == 'length_in_minutes' && $sortOrderFilms == 'asc') ? 'desc' : 'asc' ?>">Duration</a></td>
                                <td>Action</td>
                            </tr>
                            <?php foreach ($films_rows as $row) : ?>
                                <tr>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['length_in_minutes'] ?></td>
                                    <td><a href="detail_film.php?id=<?= $row['id'] ?>" class="btn btn-primary">Details</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>