-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Operator (name, password) VALUES ('tekija', 'tekija123');
INSERT INTO Poll (name, description, start_time, end_time) VALUES ('Trump vai Clinton?', 'Trump vai Clinton, kumman käsin luotat maailman tulevaisuuden?', '25.01.2017', '21.02.2017');
INSERT INTO Poll (name, description, start_time, end_time) VALUES ('ELEAGUE Major 2017', 'Kuka semifinalisteista voittaa vuoden 2017 ELEAGUE Majorin?', '25.01.2017', '22.02.2017');
INSERT INTO Option (poll_id, name, description) VALUES (1, 'Trump', 'Tupee-keisari');
INSERT INTO Option (poll_id, name, description) VALUES (1, 'Clinton', 'Konservatiivien kauhu');
INSERT INTO Option (poll_id, name) VALUES (2, 'NAVI');
INSERT INTO Option (poll_id, name) VALUES (2, 'Virtus Pro');
INSERT INTO Option (poll_id, name) VALUES (2, 'Astralis');
INSERT INTO Option (poll_id, name) VALUES (2, 'Faze');
INSERT INTO Vote (poll_id, option_id) VALUES (1, 1);
INSERT INTO Vote (poll_id, option_id) VALUES (2, 1);
INSERT INTO Vote (poll_id, option_id) VALUES (2, 2);