SELECT * FROM ref_ssh3 INNER JOIN ref_ssh2 ON ref_ssh3.Kd_Ssh2 = ref_ssh2.Kd_Ssh2 
ORDER BY ref_ssh3.Kd_Ssh1 

SELECT * FROM ref_ssh3, ref_ssh2 WHERE ref_ssh3.Kd_Ssh2 = ref_ssh2.Kd_Ssh2 
ORDER BY ref_ssh3.Kd_Ssh1 

SELECT *
FROM   ref_ssh3 a
LEFT JOIN ref_ssh2 b
ON concat(a.Kd_Ssh1,'.', a.Kd_Ssh2) = concat(b.Kd_Ssh1,'.', b.Kd_Ssh2)
LEFT JOIN ref_ssh1 c
ON a.Kd_Ssh1 = c.Kd_Ssh1
ORDER BY a.Kd_Ssh1 


SELECT * 
FROM ref_ssh3 a 
LEFT JOIN ref_ssh2 b ON concat(a.Kd_Ssh1,'.', a.Kd_Ssh2) = concat(b.Kd_Ssh1,'.', b.Kd_Ssh2) 
LEFT JOIN ref_ssh1 c ON a.Kd_Ssh1 = c.Kd_Ssh1 
WHERE a.Nm_Ssh3 like "%alat%" 
ORDER BY a.Kd_Ssh1 
LIMIT 1,5


SELECT a.*
FROM ref_ssh3 a
WHERE id IN (SELECT concat(a.Kd_Ssh1,'.', a.Kd_Ssh2)as id2
FROM ref_ssh2)

SELECT * 
FROM temp_ref_ssh3 
LEFT JOIN temp_ref_ssh2 O
N temp_ref_ssh3.id = temp_ref_ssh2.id 
ORDER BY temp_ref_ssh3.Kd_Ssh1     
				   
CREATE VIEW temp_ref_ssh3 
AS a.*,concat(a.Kd_Ssh1,'.', a.Kd_Ssh2)as id
FROM ref_ssh3