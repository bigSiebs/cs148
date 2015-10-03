<?php

include "top.php";

print "<article>";

$query = "SELECT pmkStudentId, fldFirstName, fldLastName, fldStreetAddress, fldCity, fldState, fldZip, fldGender";
$query .= " FROM tblStudents";
$query .= " LIMIT 10 OFFSET 999";
$data = array("");
$val = array(0, 0, 0, 0);

// Call select method
$info = $thisDatabaseReader->select($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);

// Execute if valid number is in URL
print '<h2>Total Records: ' . count($info) . '</h2>';
print '<h3>SQL: ' . $query . '</h3>';

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

