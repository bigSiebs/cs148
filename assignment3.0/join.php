<?php

include "top.php";

$queryNumber = "";

if (isset($_GET['query']))
    $queryNumber = (int)$_GET['query'];

print "<article>";

if ($queryNumber != "") {
    
    switch ($queryNumber) {
        case 1:
            $query = "SELECT DISTINCT fldCourseName FROM tblCourses, tblEnrolls WHERE fldGrade = ? AND tblCourses.pmkCourseId = tblEnrolls.fnkCourseId";
            $data = array(100);
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT DISTINCT fldCourseName FROM tblCourses, tblEnrolls WHERE fldGrade = 100 AND tblCourses.pmkCourseId = tblEnrolls.fnkCourseId";
            break;
        default:
            $query = "";
    }
    
    if ($query != "") {
        $test = $thisDatabaseReader->testquery($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);
        
        $info = $thisDatabaseReader->select($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);
        
        print "<h2>Total Records: " . count($info) . "</h2>";
        print "<h3>Query: " . $queryText . "</h3>";
        
        if ($debug) {
            print "<p>DATA: <pre>";
            print_r($info);
            print "</pre></p>";
        }
        
        // Start printing table
        print '<table>';
        print '<tr>';
        
        // Get headings from first subarray (removes indexes with filter function)
        $headers = array_keys($info[0]);
        $fields = array_filter($headers, 'is_string'); // Picks up only str values
        // For loop to print headings
        foreach ($fields as $head) {
            print '<th>' . $head . '</th>';
        }
        
        print "</tr>";
        
        // For loop to print records
        foreach ($info as $record) {
            print '<tr>';
            // Uses field names (AKA headers) as keys to pick from arrays
            foreach ($fields as $field) {
                print '<td>' . htmlentities($record[$field]) . '</td>';
            }
            print '</tr>';
        }
        
        // Close table
        print '</table>';
    }
}
print "</article>";

include "footer.php";
?>

