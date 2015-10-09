<?php

include "top.php";

$startRecord = "";
$numberRecords = 10;

// Make sure to set query number as int for security
if (isset($_GET['startRecord'])) {
    $startRecord = (int) $_GET['startRecord'];
} else {
    $startRecord = 0;
}
    
print "<article>";

$queryTotal = "SELECT pmkStudentId, fldFirstName, fldLastName, fldStreetAddress, fldCity, fldState, fldZip, fldGender";
$queryTotal .= " FROM tblStudents";
$data = array("");
$val = array(0, 0, 0, 0);

// SELECT all records
$total = $thisDatabaseReader->select($queryTotal, $data, $val[0], $val[1], $val[2], $val[3], false, false);

print '<h2>SQL: ' . $queryTotal . '</h3>';
print '<h3>Total Records: ' . count($total) . '</h2>';

print '<h4>Displaying records ';
print ($startRecord + 1) . ' - ' . ($startRecord + $numberRecords) . '</h4>';

print '<ol>';
print '<li';
if ($startRecord - $numberRecords < 0) {
    print ' class="unavailable"';
}
print '><a href=?startRecord=' . ($startRecord - $numberRecords) . '>';
print 'Previous 10 Records</a></li>';
print '<li';
if ($startRecord + $numberRecords >= count($total)) {
    print ' class="unavailable"';
}
print '><a href=?startRecord=' . ($startRecord + $numberRecords) . '>';
print 'Next 10 Records</a></li>';
print '</ol>';

// SELECT according to $numberRecords and $startRecord
$query = "SELECT pmkStudentId, fldFirstName, fldLastName, fldStreetAddress, fldCity, fldState, fldZip, fldGender";
$query .= " FROM tblStudents";
$query .= " LIMIT " . $numberRecords . " OFFSET " . $startRecord;
$data = array("");
$val = array(0, 0, 0, 0);

// Call select method
$info = $thisDatabaseReader->select($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);

// To troubleshoot returned array
if ($debug) {
    print "<p>DATA: <pre>";
    print_r($info);
    print "</pre></p>";
}

// Start printing table
print '<table>';
print '<tr>';

// Get headings from first subarray (removes indexes with filter function)
$fields = array_keys($info[0]);
$headers = array_filter($fields, 'is_string'); // Picks up only str values
// Print headings
foreach ($headers as $head) {
    $camelCase = preg_split('/(?=[A-Z])/', substr($head, 3));

    $heading = "";

    foreach ($camelCase as $oneWord) {
        $heading .= $oneWord . " ";
    }

    print '<th>' . $heading . '</th>';
}

print "</tr>";

// For loop to print records
foreach ($info as $record) {
    print '<tr>';
    // Uses field names (AKA headers) as keys to pick from arrays
    foreach ($headers as $field) {
        print '<td>' . htmlentities($record[$field]) . '</td>';
    }
    print '</tr>';
}

// Close table
print '</table>';

print "</article>";

include "footer.php";
?>

