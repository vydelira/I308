/*Query 1A
Produce a roster for a *specified section* sorted by student’s last name, first name*/
SELECT CONCAT(s.nameL,', ',s.nameF) as Name
FROM tp_student as s, tp_student_takes_class as stc, tp_section as sect
WHERE stc.sectionID = sect.sectionID 
    AND stc.studentID = s.studentID 
    AND sect.sectionNumber = '3605'
ORDER BY s.nameL;


/*Query 5A
Produce a chronological list (transcript-like) of all courses taken by a *specified student*. 
Show grades earned.*/
SELECT c.title as 'class taken', grade
FROM tp_course as c, tp_student_takes_class as stc,tp_section as s, tp_student as student
WHERE c.courseID=s.courseID 
    AND stc.sectionID=s.sectionID 
    AND student.studentID=stc.studentID 
    AND student.studentID='1';


/*Query 7A
Produce an alphabetical list of students with their majors who are advised by a *specified advisor*.*/
SELECT CONCAT(s.nameF,' ',s.nameL) as Name, m.title as Major
FROM tp_student as s, tp_major as m, tp_advisor as a
WHERE s.advisor = 1 
    AND a.advisorID = s.advisor 
    AND m.majorID = s.majorID
ORDER BY s.nameF ASC;


/*Query 3B
Produce a list of faculty who have never taught a *specified course*/
SELECT DISTINCT concat(f.nameF," ", f.nameL) as name 
FROM tp_faculty as f
WHERE NOT EXISTS(
    SELECT * FROM tp_course as c, tp_section as s
    WHERE c.courseID=s.courseID AND c.instructor=f.facultyID AND c.title="DP");


/*Query 4C
Produce a list of all students who took a course that had a prerequisite 
but the student had not taken the prerequisite. Include the semester, the course subject 
and number, and the grade the student received.*/
SELECT DISTINCT concat(s.nameF, ' ', s.nameL) as Full_Name, sem.title as Semester,
concat(c.courseNumber,' ',c.title) as course, stc.grade as grade
FROM tp_student as s, tp_course as c, tp_section as sec, tp_semester as sem,
tp_student_takes_class as stc
WHERE stc.studentID = s.studentID
    AND sec.sectionID = stc.sectionID
    AND sem.semesterID = sec.semesterID
    AND sec.courseID = c.courseID
    AND c.prereq != "NULL"
    AND s.studentID NOT IN(
        SELECT DISTINCT s2.studentID
        FROM tp_student as s2, tp_course as c2, tp_section as sec2, tp_student_takes_class as stc2
        WHERE s2.studentID = stc2.studentID
            AND sec2.sectionID = stc2.sectionID
            AND sec2.courseID = c2.prereq)
ORDER BY s.studentID;


/*Query 9C
Produce a list of students with hours earned and overall GPA who have met the graduation 
requirements for any major. Sort by major and then by student.*/
SELECT CONCAT(s.nameF,' ',s.nameL) as Name, SUM(c.creditHours) as creditHours,
m.title as Major, ROUND(SUM(((stc.grade/100)*4)*c.creditHours)/SUM(c.creditHours),
2) as GPA
FROM tp_student as s, tp_major as m, tp_student_takes_class as stc, tp_course as c,
tp_section as sect
WHERE s.studentID = stc.studentID 
    AND stc.sectionID = sect.sectionID 
    AND sect.courseID = c.courseID
    AND s.majorID = m.majorID
GROUP BY m.title, Name
HAVING SUM(c.creditHours) >= 15;


/*ADDITIONAL QUERIES*/
/*Select all the names and emails of faculty in a specific department*/
SELECT CONCAT(f.nameF,' ',f.nameL) as Name, fe.email as Email, d.title as Department
FROM tp_department as d, tp_faculty as f, tp_faculty_email as fe
WHERE d.departmentID = f.departmentID 
    AND f.facultyID = fe.facultyID 
    AND d.title = 'business'
GROUP BY Name ASC;


/*Select all the rooms in a specific building with a specific feature*/
SELECT r.roomID as Room, b.name as Building, r.feature as Feature
FROM tp_room as r, tp_building as b
WHERE r.buildingID = b.buildingID 
    AND b.name = 'Luddy Hall' 
    AND r.feature = 'computer lab';


/*Select parents' name, phone number, and their child's email if their child's
email ends in ".com" */
SELECT distinct concat(spa.nameF," ", spa.nameL) as parent_name, spa.phone as
parent_phone, se.email as student_email
FROM tp_student_email as se, tp_student_parent as spa, tp_student_phone as sp
WHERE spa.parentID=se.studentID and se.email like '%.com';