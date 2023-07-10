<?php

// ================================================================================================================
// ==== Select employee firstname, departmentname, street_address, country_name, region_name for all employees ====
// ================================================================================================================

/*

SELECT 
	e.first_name, d.department_name, l.street_address, c.country_name, r.region_name
FROM
	employees e
JOIN
	departments d
ON
	d.department_id = e.department_id
JOIN
	locations l
On
	l.location_id = d.location_id
JOIN
	countries c 
ON
	l.country_id = c.country_id
JOIN
	regions r
ON
	r.region_id = c.region_id

*/


// ================================================================================================================
// ==================== give me a full employee and department data even they have null ===========================
// ================================================================================================================

/*

SELECT 
	e.first_name , d.department_name
FROM 
	employees e
RIGHT JOIN 
	departments d
ON 
	d.department_id = e.department_id
UNION 
SELECT 
	e.first_name , d.department_name
FROM 
	employees e
LEFT JOIN 
	departments d
ON 
	d.department_id = e.department_id

*/

// ================================================================================================================
// =========================== i need to know manager employee name for Lex =======================================
// ================================================================================================================

/*

SELECT 
    employees.first_name AS Employee , managers.first_name AS Manager
FROM
    employees
INNER JOIN
    employees managers 
ON 
	employees.manager_id = managers.employee_id
WHERE
    employees.employee_id = 102

*/


// ================================================================================================================
// ==================== insert new employee with hire_date is the current Time ====================================
// ================================================================================================================

/*

INSERT INTO 
    employees
    (first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id)

VALUES
    ('Mohamed', 'Ahmed', 'test@test.com', '', CURRENT_DATE , 'IT_PROG', 10000, NULL, 100, 60)

*/


// ================================================================================================================
// ======================= update any employee sallary with adding 1000 to sallary  ===============================
// ================================================================================================================

/*

UPDATE 
    employees
SET
    salary = salary + 1000
WHERE
    employee_id = 100

*/
