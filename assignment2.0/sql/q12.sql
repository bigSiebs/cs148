SELECT SUM(fldNumStudents - fldMaxStudents)
FROM tblSections
WHERE fldNumStudents > fldMaxStudents;