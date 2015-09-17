<?php

include "top.php";

print '<article>';

if ($queryNumber != "") {

    /*
     * This switch statement takes the query number from the URL and uses it
     * to construct the proper query. The variables correspond to the parameters
     * needed to execute the select method in the thisDatabaseReader class.
     * In addition, there is a $queryText variable for display purposes, in
     * situations where the use of the question marks in the $query variable
     * leaves out information.
     */
    switch ($queryNumber) {
        // Display just the NetID of all teachers.
        case 1:
            $query = "SELECT pmkNetId";
            $query .= " FROM tblTeachers";
            $data = array("");
            $val = array(0, 0, 0, 0);
            $queryText = "";
            break;
        // Display just the department for courses named "Introduction"
        case 2:
            $query = "SELECT fldDepartment";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldCourseName LIKE ?";
            $data = array('%Introduction%');
            $val = array(1, 0, 0, 0);
            $queryText = "SELECT fldDepartment FROM tblCourses WHERE fldCourseName LIKE '%Introduction%'";
            break;
        // Display all section data for classes that start at 1:10PM in Kalkin
        case 3:
            $query = "SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom";
            $query .= " FROM tblSections";
            $query .= " WHERE fldStart = ? AND fldBuilding = ?";
            $data = array('13:10:00', 'KALKIN');
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom FROM tblSections WHERE fldStart = '13:10:00'AND fldBuilding = 'KALKIN'";
            break;
        // Display all course data for our class
        case 4:
            $query = "SELECT pmkCourseId, fldCourseNumber, fldCourseName, fldDepartment, fldCredits";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldDepartment = ? AND fldCourseNumber = ?";
            $data = array('CS', 148);
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT pmkCourseId, fldCourseNumber, fldCourseName, fldDepartment, fldCredits FROM tblCourses WHERE fldDepartment = 'CS' AND fldCourseNumber = 148";
            break;
        // Display the first and last name of teachers whose Net ID begins with
        // the letter 'r' and ends in the letter "o"
        case 5:
            $query = "SELECT fldFirstName, fldLastName";
            $query .= " FROM tblTeachers";
            $query .= " WHERE pmkNetId LIKE ?";
            $data = array('r%o');
            $val = array(1, 0, 0, 0);
            $queryText = "SELECT fldFirstName, fldLastName FROM tblTeachers WHERE pmkNetId LIKE 'r%o'";
            break;
        // Display every course name with the word "data" in it that is not in
        // the CS department
        case 6:
            $query = "SELECT fldCourseName";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldCourseName LIKE ? AND fldDepartment <> ?";
            $data = array('%data%', 'CS');
            $val = array(1, 1, 0, 2);
            $queryText = "SELECT fldCourseName FROM tblCourses WHERE fldCourseName LIKE '%data%' AND fldDepartment <> 'CS'";
            break;
        // Display the number of distinct departments
        case 7:
            $query = "SELECT COUNT(DISTINCT fldDepartment)";
            $query .= " FROM tblCourses";
            $data = array("");
            $val = array(0, 0, 0, 0);
            $queryText = "";
            break;
        // Display each building name and the number of sections it has
        case 8:
            $query = "SELECT fldBuilding, COUNT(fldSection)";
            $query .= " FROM tblSections";
            $query .= " GROUP BY fldBuilding";
            $data = array("");
            $val = array(0, 0, 0, 0);
            $queryText = "";
            break;
        // Display each building name and the number of students in it on
        // Wednesday, sorted by the number of students descending
        case 9:
            $query = "SELECT fldBuilding, SUM(fldNumStudents)";
            $query .= " FROM tblSections";
            $query .= " WHERE fldDays LIKE ?";
            $query .= " GROUP BY fldBuilding";
            $query .= " ORDER BY SUM(fldNumStudents) DESC";
            $data = array('%W%');
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT fldBuilding, SUM(fldNumStudents) FROM tblSections WHERE fldDays LIKE '%W%' GROUP BY fldBuilding ORDER BY SUM(fldNumStudents) DESC";
            break;
        // Repeat the above query for Friday
        case 10:
            $query = "SELECT fldBuilding, SUM(fldNumStudents)";
            $query .= " FROM tblSections";
            $query .= " WHERE fldDays LIKE ?";
            $query .= " GROUP BY fldBuilding";
            $query .= " ORDER BY SUM(fldNumStudents) DESC";
            $data = array('%F%');
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT fldBuilding, SUM(fldNumStudents) FROM tblSections WHERE fldDays LIKE '%F%' GROUP BY fldBuilding ORDER BY SUM(fldNumStudents) DESC";
            break;
        // Display all course IDs that have at least 50 sections
        case 11:
            $query = "SELECT fnkCourseId";
            $query .= " FROM tblSections";
            $query .= " GROUP BY fnkCourseId";
            $query .= " HAVING COUNT(fldSection) >= ?";
            $data = array(50);
            $val = array(0, 0, 0, 1);
            $queryText = "SELECT fnkCourseId FROM tblSections GROUP BY fnkCourseId HAVING COUNT(fldSection) >= 50";
            break;
        // Display the total number of students that are over capacity in
        // overfilled sections
        case 12:
            $query = "SELECT SUM(fldNumStudents - fldMaxStudents) ";
            $query .= " FROM tblSections";
            $query .= " WHERE fldNumStudents > fldMaxStudents";
            $data = array("");
            $val = array(1, 0, 0, 1);
            $queryText = "";
            break;
        // If other number is added to URL
        default:
            $query = "";
            break;
    }

    // Execute rest of code only if switch didn't execute default
    if ($query != "") {
        // To test queries
        if ($debug) {
            $test = $thisDatabaseReader->testquery($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);
        }

        // Call select method
        $info = $thisDatabaseReader->select($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);

        // Execute if valid number is in URL
        print '<h2>Total Records: ' . count($info) . '</h2>';
        print '<h3>SQL: ';
        if ($queryText != "") {
            print $queryText;
        } else {
            print $query;
        }
        print '</h3>';

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