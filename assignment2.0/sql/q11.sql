SELECT fnkCourseId
FROM tblSections
GROUP BY fnkCourseId
HAVING COUNT(fldSection) >= 50;