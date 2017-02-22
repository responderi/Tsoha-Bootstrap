-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Operator (name, password) VALUES ('tekija', 'tekija123x');
INSERT INTO Operator (name, password) VALUES ('toinen', 'toinen123x');
INSERT INTO Poll (name, description, creator, start_time, end_time) VALUES ('Trump vai Clinton?', 'Trump vai Clinton, kumman käsin luotat maailman tulevaisuuden?', 1, '25.01.2017', '21.02.2017');
INSERT INTO Option (poll_id, name, description) VALUES (1, 'Trump', 'Tupee-keisari');
INSERT INTO Option (poll_id, name, description) VALUES (1, 'Clinton', 'Konservatiivien kauhu');
