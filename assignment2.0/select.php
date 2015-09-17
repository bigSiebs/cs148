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
            break;
        case 2:
            $query = "SELECT fldDepartment";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldCourseName LIKE ?";
            $data = array('Introduction%');
            $val = array(1, 0, 0, 0);
            break;
        case 3:
            $query = "SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom";
            $query .= " FROM tblSections";
            $query .= " WHERE fldStart = ?";
            $data = array('13:10:00');
            $val = array(1, 0, 0, 0);
            break;
        case 4:
            $query = "SELECT pmkCourseId, fldCourseNumber, fldCourseName, fldDepartment, fldCredits";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldDepartment = ? AND fldCourseNumber = ?";
            $data = array('CS', 148);
            $val = array(1, 1, 0, 0);
            break;
        case 5:
            $query = "SELECT fldFirstName, fldLastName";
            $query .= " FROM tblTeachers";
            $query .= " WHERE pmkNetId LIKE ?";
            $data = array('r%o');
            $val = array(1, 0, 0, 0);
            break;
        case 6:
            $query = "SELECT fldCourseName";
            $query .= " FROM tblCourses";
            $query .= " WHERE fldCourseName LIKE ? AND fldDepartment <> ?";
            $data = array('%data%', 'CS');
            $val = array(1, 1, 0, 2);
            break;
        case 7:
            $query = "SELECT COUNT(DISTINCT fldDepartment)";
            $query .= " FROM tblCourses";
            $data = array("");
            $val = array(0, 0, 0, 0);
            break;
        case 8:
            $query = "SELECT DISTINCT fldBuilding, COUNT(fldSection)";
            $query .= " FROM tblSections";
            $query .= " GROUP BY fldBuilding";
            $data = array("");
            $val = array(0, 0, 0, 0);
            break;
        case 9:
            break;
        case 10:
            break;
    }
    if ($debug) {
        $test = $thisDatabaseReader->testquery($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);
    }
    $info = $thisDatabaseReader->select($query, $data, $val[0], $val[1], $val[2], $val[3], false, false);

    if ($info != "") {
        print '<h2>Total Records: ' . count($info) . '</h2>';
        print '<h3>SQL: ' . $query . '</h3>';

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