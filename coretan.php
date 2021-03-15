SELECT * FROM(
  SELECT
  ept.ept_date as y,
  (
      SELECT MAX(total_score) FROM eptscore as es
      LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
      WHERE ept_1.ept_date = ept.ept_date
      AND total_score IS NOT NULL
      ORDER BY total_score DESC
      limit 1
    ) as a,
  (
      SELECT FLOOR(AVG(total_score)) FROM eptscore as es
      LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
      WHERE ept_1.ept_date = ept.ept_date
      AND total_score IS NOT NULL
      limit 1
    ) as b,
  (
      SELECT MIN(total_score) FROM eptscore as es
      LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
      WHERE ept_1.ept_date = ept.ept_date
      AND total_score IS NOT NULL
      limit 1
    ) as c
  FROM ept
  WHERE id_epttype = 1
  GROUP BY y
  ORDER BY y DESC
  LIMIT 7
) as ept_s1 ORDER BY ept_s1.y ASC
