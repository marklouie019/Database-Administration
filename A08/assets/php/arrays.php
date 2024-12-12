<?php
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

?>