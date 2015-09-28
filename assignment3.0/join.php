<?php

include "top.php";

$queryNumber = "";

if (isset($_GET['query']))
    $queryNumber = (int)$_GET['query'];

print "<article>";

if ($queryNumber != "") {
    
    switch ($queryNumber) {
        case 1:
            $query = "SELECT DISTINCT fldCourseName";
            $query .= " FROM tblCourses, tblEnrolls";
            $query .= " WHERE fldGrade = ?";
            $query .= " AND tblCourses.pmkCourseId = tblEnrolls.fnkCourseId";
            $query .= " ORDER by fldCourseName";
            $data = array(100);
            $val = array(1, 2, 0, 0);
            $queryText = "SELECT DISTINCT fldCourseName FROM tblCourses, tblEnrolls WHERE fldGrade = 100 AND tblCourses.pmkCourseId = tblEnrolls.fnkCourseId ORDER BY fldCourseName";
            break;
        case 2:
            $query = "SELECT DISTINCT fldDays, fldStart, fldStop";
            $query .= " FROM tblSections, tblTeachers";
            $query .= " WHERE fldFirstName = ? AND fldLastName = ?";
            $query .= " AND tblTeachers.pmkNetId = tblSections.fnkTeacherNetId";
            $query .= " ORDER BY fldStart";
            $data = array('Robert Raymond', 'Snapp');
            $val = array(1, 3, 0, 0);
            $queryText = "SELECT DISTINCT fldDays, fldStart, fldStop FROM tblSections, tblTeachers WHERE fldFirstName = 'Robert Raymond' AND fldLastName = 'Snapp' AND tblTeachers.pmkNetId = tblSections.fnkTeacherNetId ORDER BY fldStart";
            break;
        case 3:
            $query = "SELECT DISTINCT fldCourseName, fldDays, fldStart, fldStop";
            $query .= " FROM tblCourses, tblSections, tblTeachers";
            $query .= " WHERE fldFirstName = ? AND fldLastName = ?";
            $query .= " AND tblTeachers.pmkNetId = tblSections.fnkTeacherNetId";
            $query .= " AND tblCourses.pmkCourseId = tblSections.fnkCourseId";
            $query .= " ORDER BY fldStart";
            $data = array('Jackie Lynn', 'Horton');
            $val = array(1, 4, 0, 0);
            $queryText = "SELECT DISTINCT fldCourseName, fldDays, fldStart, fldStop FROM tblCourses, tblSections, tblTeachers WHERE fldFirstName = 'Jackie Lynn' AND fldLastName = 'Horton' AND tblTeachers.pmkNetId = tblSections.fnkTeacherNetId AND tblCourses.pmkCourseId = tblSections.fnkCourseId ORDER BY fldStart";
            break;
        case 4:
            $query = "SELECT fnkSectionId, fldFirstName, fldLastName";
            $query .= " FROM tblStudents, tblEnrolls, tblCourses";
            $query .= " WHERE fldDepartment = ? AND fldCourseNumber = ?";
            $query .= " AND tblCourses.pmkCourseId = tblEnrolls.fnkCourseId";
            $query .= " AND tblEnrolls.fnkStudentId = tblStudents.pmkStudentId";
            $query .= " ORDER BY fnkSectionId, fldLastName, fldFirstName";
            $data = array('CS', 148);
            $val = array(1, 4, 0, 0);
            $queryText = "SELECT fnkSectionId, fldFirstName, fldLastName FROM tblStudents, tblEnrolls, tblCourses WHERE fldDepartment = 'CS' AND fldCourseNumber = 148 AND tblCourses.pmkCourseId = tblEnrolls.fnkCourseId AND tblEnrolls.fnkStudentId = tblStudents.pmkStudentId ORDER BY fnkSectionId, fldLastName, fldFirstName";
            break;
        default:
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

