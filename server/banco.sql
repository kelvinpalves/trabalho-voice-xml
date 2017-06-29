create database voice;

create table pessoa 
(
	nome text not null,
	bruto decimal(9,2),
	liquido decimal(9,2)
);

insert into pessoa 
(nome)
values 
('kelvin'),
('mano'),
('teste');