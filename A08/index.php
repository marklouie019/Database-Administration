<?php
include("assets/php/connect.php");
include("assets/php/classes.php");
include("assets/php/arrays.php");

$flightLog = new FlightLog(null);
$flightLog->filterData();
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
        <form method="GET">
            <div class="top">
                <h1>Flights Log</h1>
                <div class="filters">
                    <ul class="filters-wrap">
                        <li>
                            <a href="./">
                                <button type="button" class="btn btn-secondary btn-sm mt-4">Clear filters</button>
                            </a>
                        </li>
                        <?php for ($i = 0; $i < count($filterContents); $i++) { ?>
                            <li class="filters-item">
                                <label for="filter<?php echo $i; ?>"><?php echo $filters[$i]; ?></label>
                                <select onchange="this.form.submit()" name="filter<?php echo $i; ?>"
                                    id="filter<?php echo $i; ?>" class="form-select form-select-sm select-dropdown"
                                    aria-label="Default select example">
                                    <option value="" selected>All</option>
                                    <?php foreach ($filterContents[$i] as $filterOption) {
                                        $isSelected = (isset($_GET["filter$i"]) && $_GET["filter$i"] == $filterOption) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $filterOption; ?>" <?php echo $isSelected; ?>>
                                            <?php echo $filterOption; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <input type="hidden" name="sortColumn" id="sortColumn"
                value="<?php echo isset($_GET['sortColumn']) ? $_GET['sortColumn'] : ''; ?>">
            <input type="hidden" name="sortDirection" id="sortDirection"
                value="<?php echo isset($_GET['sortDirection']) ? $_GET['sortDirection'] : 'ASC'; ?>">
            <div class="logs-table m-3" style="overflow-x:auto;">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <?php
                            $counter = 0;
                            foreach ($tableColumns as $tableColumn) {
                                ?>
                                <th scope="col">
                                    <div class="log-column d-flex">
                                        <?php echo $tableColumn; ?>
                                        <a onclick="changeSort(<?php echo $counter; ?>)">
                                            <div class="sort ms-2" id="sorter<?php echo $counter ?>"
                                                name="sorter<?php echo $counter ?>">
                                                <i class="bi <?php echo ($sortDirection == 'ASC') ? 'bi-arrow-up-short' : 'bi-arrow-down-short'; ?>"
                                                    style="font-size:28px;font-weight:600;"></i>
                                            </div>
                                        </a>
                                    </div>
                                </th>
                                <?php $counter++;
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($flightLogList) > 0) {
                            foreach ($flightLogList as $flightLogItem) {
                                echo $flightLogItem->displayLog();
                            }
                        } else {
                            echo '<tr><td colspan="9" class="text-center">No data is found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function changeSort(column) {
            var currentDirection = document.getElementById('sortDirection').value;
            var newDirection = currentDirection === 'ASC' ? 'DESC' : 'ASC';

            document.getElementById('sortColumn').value = column;
            document.getElementById('sortDirection').value = newDirection;
            document.forms[0].submit();
        }
    </script>
</body>

</html>