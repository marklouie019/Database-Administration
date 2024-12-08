<?php
include("assets/php/connect.php");
include("assets/php/classes.php");

$flightLog = new FlightLog(null);
$flightLogList = $flightLog->getAllLogs();

$filters = array(
    'Ticket price range',
    'Flight duration',
    'Airline',
    'Aircraft'
);

$tableColumns = array(
    'Flight no.',
    'Departure time',
    'Arrival time',
    'Flight duration',
    'Airline',
    'Aircraft',
    'No. of passengers',
    'Ticker price',
    'Pilot name'
);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUP Airport | FlightLogs</title>
    <link rel="icon" href="assets/img/pup-airport-fav.svg" type="image/svg+xml">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="background-color: #800000 !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="./"><img src="assets/img/pup-airport-logo2.svg" alt="pup airport logo"></a>
        </div>
    </nav>
    <div class="page-top py-2">
        <div class="row">
            <div class="page-title col">
                <h1 class="ps-3">Flight Logs</h1>
            </div>
            <div class="filters col">
                <ul class="d-flex align-items-center">
                    <?php foreach ($filters as $filter) { ?>
                        <li class="px-2">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <?php echo $filter; ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php }
                    ; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="logs-table">
        <table class="custom-table">
            <thead>
                <tr>
                    <?php foreach ($tableColumns as $tableColumn) { ?>
                        <th scope="col"><?php echo $tableColumn ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flightLogList as $flightLogItem) {
                    echo $flightLogItem->displayLog();
                } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>