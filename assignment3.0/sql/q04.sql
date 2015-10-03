SELECT fnkSectionId, fldFirstName, fldLastName
FROM tblEnrolls
JOIN tblStudents ON fnkStudentId = pmkStudentId
JOIN tblCourses ON pmkCourseId = fnkCourseId
WHERE fldDepartment = 'CS' AND
fldCourseNumber = 148
ORDER BY fnkSectionId, fldLastName, fldFirstName;