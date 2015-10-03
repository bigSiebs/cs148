SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total, fldSalary, fldSalary / COUNT(fnkStudentId) AS IBB
FROM tblTeachers
JOIN tblSections ON fnkTeacherNetId = pmkNetId
JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND
fldCRN = fnkSectionId
WHERE fldType <> 'LAB'
GROUP BY fldFirstName, fldLastName
ORDER BY IBB;