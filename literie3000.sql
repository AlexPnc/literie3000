create database literie3000;

use literie3000;

create table matelas (
    id int primary key auto_increment,
    image varchar(256),
    marque varchar(50),
	name varchar(100) not null,
    dimension varchar(20),
    price smallint,
    promo smallint
);

insert into matelas
(image, marque, name, dimension, price, promo)
values 
("https://www.cdiscount.com/pdt2/5/a/b/1/700x700/mrholu205ab/rw/hotel-grand-confort-matelas-confort-design-160-x.jpg", "EPEDA","Matelas Delhi", "90x190", "759", "230")


