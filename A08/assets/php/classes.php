<?php
class FlightLog
{
    public $flightNumber;
    public $departureDateTime;
    public $arrivalDateTime;
    public $flightDurationMinutes;
    public $airlineName;
    public $aircraftType;
    public $passengerCount;
    public $ticketPrice;
    public $pilotName;
    public $logsQuery;
    public $logsResult;
    public $condition;
    public function __construct($flightNumber)
    {
        $this->flightNumber = $flightNumber;
    }
    public function displayLog()
    {
        return '<tr>
                    <td>' . $this->flightNumber . '</td>
                    <td>' . $this->departureDateTime . '</td>
                    <td>' . $this->arrivalDateTime . '</td>
                    <td>' . $this->flightDurationMinutes . '</td>
                    <td>' . $this->airlineName . '</td>
                    <td>' . $this->aircraftType . '</td>
                    <td>' . $this->passengerCount . '</td>
                    <td>' . $this->ticketPrice . '</td>
                    <td>' . $this->pilotName . '</td>
                </tr>';
    }
    public function getAllLogs()
    {
        $this->logsQuery = "SELECT * FROM flightlogs" . " " . $this->condition;
        $this->logsResult = executeQuery($this->logsQuery);

        $flightLogs = array();
        while ($row = mysqli_fetch_assoc($this->logsResult)) {
            $log = new FlightLog($row['flightNumber']);
            $log->departureDateTime = $row['departureDatetime'];
            $log->arrivalDateTime = $row['arrivalDatetime'];
            $log->flightDurationMinutes = $row['flightDurationMinutes'];
            $log->airlineName = $row['airlineName'];
            $log->aircraftType = $row['aircraftType'];
            $log->passengerCount = $row['passengerCount'];
            $log->ticketPrice = $row['ticketPrice'];
            $log->pilotName = $row['pilotName'];

            array_push($flightLogs, $log);
        }

        return $flightLogs;
    }
    public function loadFilteredLogs($filterContents)
    {
        if (isset($_GET['name'])) {
            $filterBtnName = $_GET['name'];
            $filterID = explode('-', $filterBtnName);

            $categoryIndex = $filterID[0];
            $optionIndex = $filterID[1];
            $selectedFilter = $filterContents[$categoryIndex][$optionIndex];

            switch ($categoryIndex) {
                case 0:
                    if ($optionIndex == 0) {
                        $this->condition = "WHERE CONVERT(REPLACE(ticketPrice, '$', ''), SIGNED) < 100";
                    } elseif ($optionIndex == 1) {
                        $this->condition = "WHERE CONVERT(REPLACE(ticketPrice, '$', ''), SIGNED) BETWEEN 100 AND 300";
                    } elseif ($optionIndex == 2) {
                        $this->condition = "WHERE CONVERT(REPLACE(ticketPrice, '$', ''), SIGNED) BETWEEN 301 AND 700";
                    } elseif ($optionIndex == 3) {
                        $this->condition = "WHERE CONVERT(REPLACE(ticketPrice, '$', ''), SIGNED) > 700";
                    }
                    break;
                case 1:
                    if ($optionIndex == 0) {
                        $this->condition = "WHERE flightDurationMinutes < 60";
                    } elseif ($optionIndex == 1) {
                        $this->condition = "WHERE flightDurationMinutes BETWEEN 60 AND 120";
                    } elseif ($optionIndex == 2) {
                        $this->condition = "WHERE flightDurationMinutes BETWEEN 121 AND 300";
                    } elseif ($optionIndex == 3) {
                        $this->condition = "WHERE flightDurationMinutes > 300";
                    }
                    break;
                case 2:
                    if ($selectedFilter == 'Others') {
                        $excludedAirlines = implode("','", $filterContents[$categoryIndex]);
                        $this->condition = "WHERE NOT airlineName IN ('$excludedAirlines')";
                    } else {
                        $this->condition = "WHERE airlineName = '$selectedFilter'";
                    }
                    break;
                case 3:
                    $this->condition = "WHERE aircraftType = '$selectedFilter'";
                    break;
                default:
                    $this->condition = "";
                    break;
            }
        }
    }
}
?>