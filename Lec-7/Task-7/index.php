<?php

// get avg sallary for every department_id in employee table
$q  =  'SELECT department_id, AVG(salary) FROM employees GROUP BY department_id';

//  get how many employees in every job_id in employee table
$q =  'SELECT job_id, COUNT(*) FROM employees GROUP BY job_id';

// calc your birthdate by years only 
$q = 'SELECT YEAR(birth_date)';

// job_id of department_id that have commission_pct <> Null
$q = 'SELECT job_id FROM employees WHERE commission_pct IS NOT Null';

// all employees that work under  	Steven as first name
$q = "SELECT first_name FROM employees WHERE first_name = 'Steven'";
