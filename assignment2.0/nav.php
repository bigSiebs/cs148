<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        $queryList = array("SELECT pmkNetId FROM tblTeachers", "SELECT fldDepartment FROM tblCourses WHERE fldCourseName LIKE 'Introduction%'", "SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom FROM tblSections WHERE fldStart = '13:10:00'AND fldBuilding = 'KALKIN'", "SELECT pmkCourseId, fldCourseNumber, fldCourseName, fldDepartment, fldCredits FROM tblCourses WHERE fldDepartment = 'CS' AND fldCourseNumber = 148", "SELECT fldFirstName, fldLastName FROM tblTeachers WHERE pmkNetId LIKE 'r%o'", "SELECT fldCourseName FROM tblCourses WHERE fldCourseName LIKE '%data%' AND fldDepartment &lt;> 'CS'", "SELECT COUNT(DISTINCT fldDepartment) FROM tblCourses", "SELECT fldBuilding, COUNT(fldSection) FROM tblSections GROUP BY fldBuilding", "SELECT fldBuilding, SUM(fldNumStudents) FROM tblSections WHERE fldDays LIKE '%W%' GROUP BY fldBuilding ORDER BY SUM(fldNumStudents) DESC", "SELECT fldBuilding, SUM(fldNumStudents) FROM tblSections WHERE fldDays LIKE '%F%' GROUP BY fldBuilding ORDER BY SUM(fldNumStudents) DESC", "SELECT fnkCourseId FROM tblSections GROUP BY fnkCourseId HAVING COUNT(fldSection) >= 50", "SELECT SUM(fldNumStudents - fldMaxStudents) FROM tblSections WHERE fldNumStudents > fldMaxStudents");

        // If a valid query number hasn't been picked, display list.
        print '<ol>';

        $count = 1;
        foreach ($queryList as $q) {
            print '<li>q' . $count . ". ";
            print '<a href="?queryNumber=' . $count . '">SQL: ' . '</a>';
            print $q . '</li>';

            ++$count;
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

