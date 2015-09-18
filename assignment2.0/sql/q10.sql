SELECT fldBuilding, SUM(fldNumStudents)
FROM tblSections
WHERE fldDays LIKE '%F%'
GROUP BY fldBuilding
ORDER BY SUM(fldNumStudents) DESC;