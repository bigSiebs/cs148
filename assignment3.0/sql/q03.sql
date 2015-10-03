SELECT DISTINCT fldCourseName, fldDays, fldStart, fldStop
FROM tblCourses
JOIN tblSections ON fnkCourseId = pmkCourseId
JOIN tblTeachers ON pmkNetId = fnkTeacherNetId
WHERE fldFirstName = 'Jackie Lynn' AND
fldLastName = 'Horton'
ORDER BY fldStart;