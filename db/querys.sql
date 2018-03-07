
UPDATE users set name = 'jose', last_name = 'perez' WHERE id = 2, carrer = 'quimico industrial', semester = 5, enrollment = 23121

UPDATE users INNER JOIN students ON users.id = students.id_students SET users.name = 'Jose', users.last_name = 'Perez', students.carrer = 'quimico industrial', students.semester = 5, students.enrollment = 566666 WHERE users.id = 2

SELECT * FROM `users` join (student) on (users.id = student.id)

//un estudiante
SELECT * FROM `users` join (student) on (users.id = student.id) and users.id = 2

SELECT loan_materials.id, loan_materials.id_loan, loan_materials.id_material, loan_materials.amount, loan_materials.deliver_at, loan_materials.return_at, loan_materials.returned_amount, loan_materials.description FROM `loan_materials` LEFT JOIN `loans` ON loans.id = loan_materials.id_loan WHERE loans.status = '2'
