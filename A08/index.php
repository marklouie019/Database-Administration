<?php
include("assets/php/connect.php");
include("assets/php/classes.php");

$filters = array(
    'Ticket price range',
    'Flight duration',
    'Airline',
    'Aircraft'
);

$filterContents = array(
    array(
        'Less than $100.00',
        '$100.00-$300.00',
        '$301.00-$700.00',
        'More than $700.00'
    ),
    array(
        'Less than 60 min',
        '60-120 min',
        '121-300 min',
        'More than 300 min'
    ),
    array(
        'Skibox',
        'Feedfire',
        'Mynte',
        'Others'
    ),
    array(
        'Airbus A320',
        'Boeing 737',
        'Embraer E190'
    )
);

$tableColumns = array(
    'Flight no.',
    'Departure time',
    'Arrival time',
    'Flight duration',
    'Airline',
    'Aircraft',
    'No. of passengers',
    'Ticket price',
    'Pilot name'
);

$flightLog = new FlightLog(null);
$flightLog->loadFilteredLogs($filterContents);
$flightLogList = $flightLog->getAllLogs();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="background-color: #800000 !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="./"><img src="assets/img/pup-airport-logo2.svg" alt="pup airport logo"></a>
        </div>
    </nav>
    <div class="base">
        <div class="top">
            <h1>Flights Log</h1>
            <div class="filters">
                <ul class="filters-wrap">
                    <?php for ($i = 0; $i < count($filters); $i++) { ?>
                        <li class="filters-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <?php echo $filters[$i]; ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php for ($j = 0; $j < count($filterContents[$i]); $j++) {
                                        $separator = '-';
                                        ?>
                                        <li>
                                            <a class="dropdown-item" name="<?php echo $i . $j ?>"
                                                href="index.php?name=<?php echo $i . $separator . $j ?>">
                                                <?php
                                                echo $filterContents[$i][$j];
                                                ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ; ?>
                                </ul>
                            </div>
                        </li>
                    <?php }
                    ; ?>
                </ul>
            </div>
        </div>
        <div class="logs-table" style="overflow-x:auto;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <?php
                        $counter = 1;
                        foreach ($tableColumns as $tableColumn) {
                            ?>
                            <th scope="col">
                                <div class="log-column d-flex">
                                    <?php echo $tableColumn ?>
                                    <div class="sort" onclick="changeOrientation('sorter<?php echo $counter ?>')"
                                        id="sorter<?php echo $counter ?>" name="sorter<?php echo $counter ?>">
                                        <i class="bi bi-arrow-down-short" style="font-size:28px;font-weight:600"></i>
                                    </div>
                                </div>
                            </th>
                            <?php $counter++;
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flightLogList as $flightLogItem) {
                        echo $flightLogItem->displayLog();
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function changeOrientation(btnID){
            var btnSort = document.getElementById(btnID);
            btnSort.
        }
    </script>
</body>

</html>