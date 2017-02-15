-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Operator(
	id SERIAL PRIMARY KEY,
	name varchar(15) NOT NULL,
	password varchar(30) NOT NULL
);

CREATE TABLE Poll(
	id SERIAL PRIMARY KEY,
	name varchar(100) NOT NULL,
	description varchar(500),
	start_time TIMESTAMP,
	end_time TIMESTAMP
);

CREATE TABLE PollAndOperator(
	operator_id INTEGER REFERENCES Operator(id),
	poll_id INTEGER REFERENCES Poll(id)
);

CREATE TABLE Option(
	id SERIAL PRIMARY KEY,
	poll_id INTEGER REFERENCES Poll(id) ON DELETE CASCADE NOT NULL,
	name varchar(100) NOT NULL,
	description varchar(200),
	votes_count INTEGER
);

CREATE TABLE Vote(
	id SERIAL PRIMARY KEY,
	poll_id INTEGER REFERENCES Poll(id) ON DELETE CASCADE NOT NULL,
	option_id INTEGER REFERENCES Option(id) ON DELETE CASCADE NOT NULL,
	timegiven TIMESTAMP
);