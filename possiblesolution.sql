SELECT * FROM questions WHERE id NOT IN (SELECT question_id FROM gradebook) and test_id=1;