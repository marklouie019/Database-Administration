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
                    <td class="text-center">' . $this->flightNumber . '</td>
                    <td class="text-center">' . $this->departureDateTime . '</td>
                    <td class="text-center">' . $this->arrivalDateTime . '</td>
                    <td class="text-center">' . $this->flightDurationMinutes . '</td>
                    <td>' . $this->airlineName . '</td>
                    <td>' . $this->aircraftType . '</td>
                    <td class="text-center">' . $this->passengerCount . '</td>
                    <td class="text-center">' . $this->ticketPrice . '</td>
                    <td>' . $this->pilotName . '</td>
                </tr>';
    }
    public function getAllLogs()
    {
        $sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : '';
        $sortDirection = isset($_GET['sortDirection']) ? $_GET['sortDirection'] : 'ASC';

        $tableColumns = array(
            'flightNumber',
            'departureDatetime',
            'arrivalDatetime',
            'flightDurationMinutes',
            'airlineName',
            'aircraftType',
            'passengerCount',
            'ticketPrice',
            'pilotName'
        );

        $sortColumnName = isset($tableColumns[$sortColumn]) ? $tableColumns[$sortColumn] : '';
        if (!$sortColumnName) {
            $sortColumnName = 'flightNumber';
        }

        if ($sortDirection !== 'ASC' && $sortDirection !== 'DESC') {
            $sortDirection = 'ASC';
        }

        $sortCondition = " ORDER BY " . $sortColumnName . " " . $sortDirection;
        $this->logsQuery = "SELECT * FROM flightlogs" . " " . $this->condition . $sortCondition;
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
    public function filterData()
    {
        $filterKeys = array('filter0', 'filter1', 'filter2', 'filter3');
        $filterColumns = array('ticketPrice', 'flightDurationMinutes', 'airlineName', 'aircraftType');

        $conditions = array();

        for ($i = 0; $i < count($filterKeys); $i++) {
            $filterKey = $filterKeys[$i];
            $columnName = $filterColumns[$i];

            if (isset($_GET[$filterKey]) && $_GET[$filterKey] != '') {
                $value = $_GET[$filterKey];

                if ($filterKey == 'filter0') {
                    $value = str_replace('$', '', $value);

                    if ($value == 'Less than 100.00') {
                        $conditions[] = "CONVERT(REPLACE($columnName, '$', ''), SIGNED) < 100";
                    } elseif ($value == '100.00-300.00') {
                        $conditions[] = "CONVERT(REPLACE($columnName, '$', ''), SIGNED) BETWEEN 100 AND 300";
                    } elseif ($value == '301.00-700.00') {
                        $conditions[] = "CONVERT(REPLACE($columnName, '$', ''), SIGNED) BETWEEN 301 AND 700";
                    } elseif ($value == 'More than 700.00') {
                        $conditions[] = "CONVERT(REPLACE($columnName, '$', ''), SIGNED) > 700";
                    }
                } elseif ($filterKey == 'filter1') {
                    if ($value == 'Less than 60 min') {
                        $conditions[] = "$columnName < 60";
                    } elseif ($value == '60-120 min') {
                        $conditions[] = "$columnName BETWEEN 60 AND 120";
                    } elseif ($value == '121-300 min') {
                        $conditions[] = "$columnName BETWEEN 121 AND 300";
                    } elseif ($value == 'More than 300 min') {
                        $conditions[] = "$columnName > 300";
                    }
                } elseif ($value == 'Others') {
                    $conditions[] = "$columnName NOT IN ('Skibox', 'Feedfire', 'Mynte')";
                } else {
                    $conditions[] = "$columnName = '$value'";
                }
            }
        }

        if (count($conditions) > 0) {
            $this->condition = "WHERE " . implode(' AND ', $conditions);
        } else {
            $this->condition = "";
        }
    }
}
?>