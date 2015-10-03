<?php

include "top.php";

$queryNumber = "";

// Make sure to set query number as int for security
if (isset($_GET['query']))
    $queryNumber = (int)$_GET['query'];

print "<article>";

if ($queryNumber != "") {
    
    switch ($queryNumber) {
        case 1:
            $query = "SELECT DISTINCT fldCourseName";
            $query .= " FROM tblCourses";
            $query .= " JOIN tblEnrolls ON pmkCourseId = fnkCourseId";
            $query .= " WHERE fldGrade = ?";
            $query .= " ORDER BY fldCourseName";
            $data = array(100);
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT DISTINCT fldCourseName FROM tblCourses JOIN tblEnrolls ON pmkCourseId = fnkCourseId WHERE fldGrade = 100 ORDER BY fldCourseName";
            break;
        case 2:
            $query = "SELECT DISTINCT fldDays, fldStart, fldStop";
            $query .= " FROM tblSections";
            $query .= " JOIN tblTeachers ON pmkNetId = fnkTeacherNetId";
            $query .= " WHERE fldFirstName = ? AND fldLastName = ?";
            $query .= " ORDER BY fldStart";
            $data = array('Robert Raymond', 'Snapp');
            $val = array(1, 2, 0, 0);
            $queryText = "SELECT DISTINCT fldDays, fldStart, fldStop FROM tblSections JOIN tblTeachers ON pmkNetId = fnkTeacherNetId WHERE fldFirstName = 'Robert Raymond' AND fldLastName = 'Snapp' ORDER BY fldStart";
            break;
        case 3:
            $query = "SELECT DISTINCT fldCourseName, fldDays, fldStart, fldStop";
            $query .= " FROM tblCourses";
            $query .= " JOIN tblSections ON fnkCourseId = pmkCourseId";
            $query .= " JOIN tblTeachers ON pmkNetId = fnkTeacherNetId";
            $query .= " WHERE fldFirstName = ? AND fldLastName = ?";
            $query .= " ORDER BY fldStart";
            $data = array('Jackie Lynn', 'Horton');
            $val = array(1, 2, 0, 0);
            $queryText = "SELECT DISTINCT fldCourseName, fldDays, fldStart, fldStop FROM tblCourses JOIN tblSections ON fnkCourseId = pmkCourseId JOIN tblTeachers ON pmkNetId = fnkTeacherNetId WHERE fldFirstName = 'Jackie Lynn' AND fldLastName = 'Horton' ORDER BY fldStart";
            break;
        case 4:
            $query = "SELECT fnkSectionId, fldFirstName, fldLastName";
            $query .= " FROM tblEnrolls";
            $query .= " JOIN tblStudents ON fnkStudentId = pmkStudentId";
            $query .= " JOIN tblCourses ON pmkCourseId = fnkCourseId";
            $query .= " WHERE fldDepartment = ? AND fldCourseNumber = ?";
            $query .= " ORDER BY fnkSectionId, fldLastName, fldFirstName";
            $data = array('CS', 148);
            $val = array(1, 2, 0, 0);
            $queryText = "SELECT fnkSectionId, fldFirstName, fldLastName FROM tblEnrolls JOIN tblStudents ON fnkStudentId = pmkStudentId JOIN tblCourses ON pmkCourseId = fnkCourseId WHERE fldDepartment = 'CS' AND fldCourseNumber = 148 ORDER BY fnkSectionId, fldLastName, fldFirstName";
            break;
        case 5:
            $query = "SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total";
            $query .= " FROM tblTeachers";
            $query .= " JOIN tblSections ON fnkTeacherNetId = pmkNetId";
            $query .= " JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND";
            $query .= " fldCRN = fnkSectionId";
            $query .= " WHERE fldType <> ?";
            $query .= " GROUP BY fldFirstName, fldLastName";
            $query .= " ORDER BY total DESC";
            $data = array("LAB");
            $val = array(1, 2, 0, 2);
            $queryText = "SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total FROM tblTeachers JOIN tblSections ON fnkTeacherNetId = pmkNetId JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND fldCRN = fnkSectionId WHERE fldType &lt;> 'LAB' GROUP BY fldFirstName, fldLastName ORDER BY total DESC";
            break;
        case 6:
            $query = "SELECT fldFirstName, fldPhone, fldSalary";
            $query .= " FROM tblTeachers";
            $query .= " WHERE fldSalary <";
            $query .= " (SELECT AVG(fldSalary) FROM tblTeachers)";
            $query .= " ORDER BY fldSalary DESC";
            $data = array("");
            $val = array(1, 1, 0, 1);
            $queryText = "SELECT fldFirstName, fldPhone, fldSalary FROM tblTeachers WHERE fldSalary &lt; (SELECT AVG(fldSalary) FROM tblTeachers) ORDER BY fldSalary DESC";
            break;
        case 7:
            $query = "SELECT fldFirstName, fldLastName, COUNT(fnkSectionId) AS NumberOfClasses, SUM(fldGrade) / COUNT(fnkSectionId) AS GPA";
            $query .= " FROM tblStudents";
            $query .= " JOIN tblEnrolls ON pmkStudentId = fnkStudentId";
            $query .= " WHERE fldState = ?";
            $query .= " GROUP BY fldFirstName, fldLastName";
            $query .= " HAVING GPA > (SELECT SUM(fldGrade) / COUNT(fnkSectionId)";
            $query .= " FROM tblEnrolls";
            $query .= " JOIN tblStudents ON fnkStudentId = pmkStudentId";
            $query .= " WHERE fldState = ?)";
            $query .= " ORDER BY GPA DESC, fldLastName, fldFirstName";
            $data = array('VT', 'VT');
            $val = array(2, 1, 0, 1);
            $queryText = "SELECT fldFirstName, fldLastName, COUNT(fnkSectionId) AS NumberOfClasses, SUM(fldGrade) / COUNT(fnkSectionId) AS GPA FROM tblStudents JOIN tblEnrolls ON pmkStudentId = fnkStudentId WHERE fldState = 'VT' GROUP BY fldFirstName, fldLastName HAVING GPA > (SELECT SUM(fldGrade) / COUNT(fnkSectionId) FROM tblEnrolls JOIN tblStudents ON fnkStudentId = pmkStudentId WHERE fldState = 'VT') ORDER BY GPA DESC, fldLastName, fldFirstName";
            break;
        case 8:
            $query = "SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total, fldSalary, fldSalary / COUNT(fnkStudentId) AS IBB";
            $query .= " FROM tblTeachers";
            $query .= " JOIN tblSections ON fnkTeacherNetId = pmkNetId";
            $query .= " JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND";
            $query .= " fldCRN = fnkSectionId";
            $query .= " WHERE fldType <> ?";
            $query .= " GROUP BY fldFirstName, fldLastName";
            $query .= " ORDER BY IBB";
            $data = array("LAB");
            $val = array(1, 2, 0, 2);
            $queryText = "SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total, fldSalary, fldSalary / COUNT(fnkStudentId) AS IBB FROM tblTeachers JOIN tblSections ON fnkTeacherNetId = pmkNetId JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND fldCRN = fnkSectionId WHERE fldType &lt;> 'LAB' GROUP BY fldFirstName, fldLastName ORDER BY IBB";
            break;
        default:
            $query = "";
    }
    
    if ($query != "") {
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

