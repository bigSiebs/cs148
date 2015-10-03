SELECT fldFirstName, fldLastName, COUNT(fnkStudentId) AS total
FROM tblTeachers
JOIN tblSections ON fnkTeacherNetId = pmkNetId
JOIN tblEnrolls ON tblSections.fnkCourseId = tblEnrolls.fnkCourseId AND
fldCRN = fnkSectionId
WHERE fldType <> 'LAB'
GROUP BY fldFirstName, fldLastName
ORDER BY total DESC;