SELECT DISTINCT fldDays, fldStart, fldStop
FROM tblSections
JOIN tblTeachers ON pmkNetId = fnkTeacherNetId
WHERE fldFirstName = 'Robert Raymond' AND
fldLastName = 'Snapp'
ORDER BY fldStart;