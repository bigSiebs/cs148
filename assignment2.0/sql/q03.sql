SELECT fnkCourseId, fldCRN, fnkTeacherNetId, fldMaxStudents, fldNumStudents, fldSection, fldType, fldStart, fldStop, fldDays, fldBuilding, fldRoom
FROM tblSections
WHERE fldStart = '13:10:00'AND fldBuilding = 'KALKIN';