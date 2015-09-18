SELECT fldBuilding, SUM(fldNumStudents)
FROM tblSections
WHERE fldDays LIKE '%W%'
GROUP BY fldBuilding
ORDER BY SUM(fldNumStudents) DESC;