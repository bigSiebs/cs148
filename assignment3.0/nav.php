<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php

        // If a valid query number hasn't been picked, display list.
        $queries = array(
            "SELECT DISTINCT fldCourseName FROM tblCourses JOIN tblEnrolls ON pmkCourseId = fnkCourseId WHERE fldGrade = 100 ORDER BY fldCourseName",
            "SELECT DISTINCT fldDays, fldStart, fldStop FROM tblSections JOIN tblTeachers ON pmkNetId = fnkTeacherNetId WHERE fldFirstName = 'Robert Raymond' AND fldLastName = 'Snapp' ORDER BY fldStart",
            "SELECT DISTINCT fldCourseName, fldDays, fldStart, fldStop FROM tblCourses JOIN tblSections ON fnkCourseId = pmkCourseId JOIN tblTeachers ON pmkNetId = fnkTeacherNetId WHERE fldFirstName = 'Jackie Lynn' AND fldLastName = 'Horton' ORDER BY fldStart",
            "SELECT fnkSectionId, fldFirstName, fldLastName FROM tblEnrolls JOIN tblStudents ON fnkStudentId = pmkStudentId JOIN tblCourses ON pmkCourseId = fnkCourseId WHERE fldDepartment = 'CS' AND fldCourseNumber = 148 ORDER BY fnkSectionId, fldLastName, fldFirstName",
            "SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total FROM tblTeachers JOIN tblSections ON fnkTeacherNetId = pmkNetId JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND fldCRN = fnkSectionId WHERE fldType &lt;> 'LAB' GROUP BY fldFirstName, fldLastName ORDER BY total DESC",
            "SELECT fldFirstName, fldPhone, fldSalary FROM tblTeachers WHERE fldSalary &lt; (SELECT AVG(fldSalary) FROM tblTeachers) ORDER BY fldSalary DESC",
            "SELECT fldFirstName, fldLastName, COUNT(fnkSectionId) AS NumberOfClasses, SUM(fldGrade) / COUNT(fnkSectionId) AS GPA FROM tblStudents JOIN tblEnrolls ON pmkStudentId = fnkStudentId WHERE fldState = 'VT' GROUP BY fldFirstName, fldLastName HAVING GPA > (SELECT SUM(fldGrade) / COUNT(fnkSectionId) FROM tblEnrolls JOIN tblStudents ON fnkStudentId = pmkStudentId WHERE fldState = 'VT') ORDER BY GPA DESC, fldLastName, fldFirstName",
            "SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total, fldSalary, fldSalary / COUNT(fnkStudentId) AS IBB FROM tblTeachers JOIN tblSections ON fnkTeacherNetId = pmkNetId JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND fldCRN = fnkSectionId WHERE fldType &lt;> 'LAB' GROUP BY fldFirstName, fldLastName ORDER BY IBB");
        $numQueries = 8;
        for ($i = 0; $i < $numQueries; $i++) {
            // For linking-making purposes
            $queryNum = $i + 1;
            
            // Create links, print queries
            print '<li>q' . $queryNum . ". ";
            print '<a href="?query=' . $queryNum . '">SQL:' . '</a>';
            print ' ' . $queries[$i] . '</li>';
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

