Успеваемост
SELECT us.firstname, us.surname, us.middlename, ls.date, pr.estimate, ls.id_discipline 
FROM journal_progress AS pr 
LEFT JOIN journal_user AS us 
ON us.id_user=pr.id_user 
LEFT JOIN journal_lesson as ls 
ON pr.id_lesson=ls.id_lesson 
WHERE pr.attendance=0;

Посещаемость
SELECT us.firstname, us.surname, us.middlename, ls.date, pr.attendance, ls.id_discipline 
FROM journal_progress AS pr 
LEFT JOIN journal_user AS us 
ON us.id_user=pr.id_user 
LEFT JOIN journal_lesson as ls 
ON pr.id_lesson=ls.id_lesson 
WHERE pr.attendance=1;