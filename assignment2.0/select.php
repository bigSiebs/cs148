<?php

include "top.php";

/* $queryNumber defined in nav.php

  $queryNumber = "";

  if (isset($_GET['queryNumber'])) {
  $queryNumber = (int)$_GET['queryNumber'];
  } */

// Begin output
print '<article>';

if ($queryNumber != "") {

    // Pick query
    switch ($queryNumber) {
        case 1:
            $query = "SELECT pmkNetId";
            $query .= " FROM tblTeachers";
            $data = array("");
            $val = array(0, 0, 0, 0);
            $queryText ="";
            break;
        case 2:
            $query = "SELECT fldDepartment";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldCourseName LIKE ?";
            $data = array('%Introduction%');
            $val = array(1, 0, 0, 0);
            $queryText = "SELECT fldDepartment FROM tblCourses WHERE fldCourseName LIKE '%Introduction%'";
            break;
        case 3:
            $query = "SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom";
            $query .= " FROM tblSections";
            $query .= " WHERE fldStart = ?";
            $data = array('13:10:00');
            $val = array(1, 0, 0, 0);
            $queryText = "SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom FROM tblSections WHERE fldStart = '13:10:00'";
            break;
        case 4:
            $query = "SELECT pmkCourseId, fldCourseNumber, fldCourseName, fldDepartment, fldCredits";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldDepartment = ? AND fldCourseNumber = ?";
            $data = array('CS', 148);
            $val = array(1, 1, 0, 0);
            $queryText = "SELECT pmkCourseId, fldCourseNumber, fldCourseName, fldDepartment, fldCredits FROM tblCourses WHERE fldDepartment = 'CS' AND fldCourseNumber = 148";
            break;
        case 5:
            $query = "SELECT fldFirstName, fldLastName";
            $query .= " FROM tblTeachers";
            $query .= " WHERE pmkNetId LIKE ?";
            $data = array('r%o');
            $val = array(1, 0, 0, 0);
            $queryText = "SELECT fldFirstName, fldLastName FROM tblTeachers WHERE pmkNetId LIKE 'r%o'";
            break;
        case 6:
            $query = "SELECT fldCourseName";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldCourseName LIKE ? AND fldDepartment <> ?";
            $data = array('%data%', 'CS');
            $val = array(1, 1, 0, 2);
            $queryText = "SELECT fldCourseName FROM tblCourses WHERE fldCourseName LIKE '%data%' AND fldDepartment <> 'CS'";
            break;
        case 7:
            $query = "SELECT COUNT(DISTINCT fldDepartment)";
            $query .= " FROM tblCourses";
            $data = array("");
            $val = array(0, 0, 0, 0);
            $queryText ="";
            break;
        case 8:
            $query = "SELECT fldBuilding, COUNT(fldSection)";
            $query .= " FROM tblSections";
            $query .= " GROUP BY fldBuilding";
            $data = array("");
            $val = array(0, 0, 0, 0);
            $queryText ="";
            break;
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
        case 11:
            $query = "SELECT fnkCourseId";
            $query .= " FROM tblSections";
            $query .= " GROUP BY fnkCourseId";
            $query .= " HAVING COUNT(fldSection) >= ?";
            $data = array(50);
            $val = array(0, 0, 0, 1);
            $queryText = "SELECT fnkCourseId FROM tblSections GROUP BY fnkCourseId HAVING COUNT(fldSection) >= 50";
            break;
        case 12:
            $query = "SELECT SUM(fldNumStudents - fldMaxStudents) ";
            $query .= " FROM tblSections";
            $query .= " WHERE fldNumStudents > fldMaxStudents";
            $data = array("");
            $val = array(1, 0, 0, 1);
            $queryText ="";
            break;
    }
    if ($debug) {
        $test = $thisDatabaseReader->testquery($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);
    }
    $info = $thisDatabaseReader->select($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);

    if ($info != "") {
        print '<h2>Total Records: ' . count($info) . '</h2>';
        print '<h3>SQL: ';
        if ($queryText != "") {
            print $queryText;
        } else {
            print $query;
        }
        print '</h3>';

        if ($debug) {
            print "<p>DATA: <pre>";
            print_r($info);
            print "</pre></p>";
        }

        print '<table>';
        print '<tr>';

        // Get headings from first subarray
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
            // Uses field names as keys to pick from arrays
            foreach ($fields as $field) {
                print '<td>' . htmlentities($record[$field]) . '</td>';
            }
            print '</tr>';
        }

        print '</table>';
    }
}
print "</article>";

include "footer.php";
?>