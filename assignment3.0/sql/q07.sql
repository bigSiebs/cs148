SELECT fldFirstName, fldLastName, COUNT(fnkSectionId) AS NumberOfClasses, SUM(fldGrade) / COUNT(fnkSectionId) AS GPA
FROM tblStudents
JOIN tblEnrolls ON pmkStudentId = fnkStudentId
WHERE fldState = 'VT'
GROUP BY fldFirstName, fldLastName
HAVING GPA > (SELECT SUM(fldGrade) / COUNT(fnkSectionId) 
              FROM tblEnrolls
              JOIN tblStudents ON fnkStudentId = pmkStudentId
              WHERE fldState = 'VT')
ORDER BY GPA DESC, fldLastName, fldFirstName;