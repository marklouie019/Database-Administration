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
        $query = "SELECT * FROM flightlogs LIMIT 20";
        $result = executeQuery($query);

        $flightLogs = array();
        while ($row = mysqli_fetch_assoc($result)) {
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
}
class Filter
{
    public $name;
    public $list = array();
    public function __construct($name, $list)
    {
        $this->name = $name;
        $this->list = $list;
    }
    public function displayFilter()
    {

    }
}
?>