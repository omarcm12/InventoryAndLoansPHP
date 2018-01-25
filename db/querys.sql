
UPDATE users set name = 'jose', last_name = 'perez' WHERE id = 2, carrer = 'quimico industrial', semester = 5, enrollment = 23121

UPDATE users INNER JOIN students ON users.id = students.id_students SET users.name = 'Jose', users.last_name = 'Perez', students.carrer = 'quimico industrial', students.semester = 5, students.enrollment = 566666 WHERE users.id = 2

SELECT * FROM `users` join (student) on (users.id = student.id)

//un estudiante
SELECT * FROM `users` join (student) on (users.id = student.id) and users.id = 2