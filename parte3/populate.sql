insert into Fornecedor values('000000001','fornecedor1');
insert into Fornecedor values('000000002','fornecedor2');
insert into Fornecedor values('000000003','fornecedor3');
insert into Fornecedor values('000000004','fornecedor4');
insert into Fornecedor values('000000005','fornecedor5');

insert into Categoria values('Categoria1');
insert into Categoria values('Categoria2');
insert into Categoria values('Categoria3');
insert into Categoria values('Categoria4');
insert into Categoria values('Categoria5');
insert into Categoria values('Categoria6');
insert into Categoria values('Categoria7');

insert into Categoria_Simples values('Categoria1');
insert into Categoria_Simples values('Categoria2');
insert into Categoria_Simples values('Categoria3');

insert into Super_Categoria values('Categoria4');
insert into Super_Categoria values('Categoria5');
insert into Super_Categoria values('Categoria6');
insert into Super_Categoria values('Categoria7');

insert into Constituida values('Categoria4','Categoria1');
insert into Constituida values('Categoria5','Categoria2');
insert into Constituida values('Categoria6','Categoria3');
insert into Constituida values('Categoria7','Categoria4');

insert into Produto values('EAN00001','Categoria1','000000001','design','01-01-2012');
insert into Produto values('EAN00002','Categoria2','000000001','design','01-01-2012');
insert into Produto values('EAN00003','Categoria3','000000001','design','01-01-2012');
insert into Produto values('EAN00004','Categoria4','000000001','design','01-01-2012');
insert into Produto values('EAN00005','Categoria5','000000001','design','01-01-2012');
insert into Produto values('EAN00006','Categoria6','000000001','design','01-01-2012');
insert into Produto values('EAN00007','Categoria7','000000001','design','01-01-2012');
insert into Produto values('EAN00008','Categoria1','000000002','design','01-01-2012');

insert into Fornecedor_Secundario values('000000002','EAN00007');
insert into Fornecedor_Secundario values('000000002','EAN00006');
insert into Fornecedor_Secundario values('000000002','EAN00005');
insert into Fornecedor_Secundario values('000000002','EAN00004');
insert into Fornecedor_Secundario values('000000002','EAN00003');
insert into Fornecedor_Secundario values('000000002','EAN00002');
insert into Fornecedor_Secundario values('000000002','EAN00001');
insert into Fornecedor_Secundario values('000000002','EAN00001');



-- useful for d)

insert into Fornecedor values('000000006','fornecedor6');
insert into Fornecedor values('000000007','fornecedor7');
insert into Fornecedor values('000000008','fornecedor8');
insert into Fornecedor values('000000009','fornecedor9');
insert into Fornecedor values('000000010','fornecedor10');
insert into Fornecedor values('000000011','fornecedor11');
insert into Fornecedor values('000000012','fornecedor12');
insert into Fornecedor values('000000013','fornecedor13');
insert into Fornecedor values('000000014','fornecedor14');
insert into Fornecedor values('000000015','fornecedor15');

insert into Fornecedor_Secundario values('000000001','EAN00001');
insert into Fornecedor_Secundario values('000000002','EAN00001');
insert into Fornecedor_Secundario values('000000003','EAN00001');
insert into Fornecedor_Secundario values('000000004','EAN00001');
insert into Fornecedor_Secundario values('000000005','EAN00001');
insert into Fornecedor_Secundario values('000000006','EAN00001');
insert into Fornecedor_Secundario values('000000008','EAN00001');
insert into Fornecedor_Secundario values('000000009','EAN00001');
insert into Fornecedor_Secundario values('000000010','EAN00001');
insert into Fornecedor_Secundario values('000000011','EAN00001');

-- useful for c) and e)

insert into Corredor values(1,5);
insert into Corredor values(2,6);
insert into Corredor values(3,7);

insert into Corredor values(4,7123);
insert into Corredor values(5,73);
insert into Corredor values(6,47);


insert into Prateleira values('esquerdo',10,1);
insert into Prateleira values('direito',10,1);
insert into Prateleira values('esquerdo',5,2);
insert into Prateleira values('direito',5,3);

insert into EventoReposicao values('nome1','2006-10-27 23:00:00');
insert into EventoReposicao values('nome2','2005-01-27 23:00:00');

insert into EventoReposicao values('nome3','2002-01-30 23:00:00');
insert into EventoReposicao values('nome3','2002-01-30 23:00:01');
insert into EventoReposicao values('nome3','2002-01-30 23:00:02');

insert into EventoReposicao values('nome4','2001-09-24 23:00:00');
insert into EventoReposicao values('nome5','2005-01-28 23:00:00');
insert into EventoReposicao values('nome5','2005-01-28 23:00:01');

insert into Reposicao values(10,'EAN00001',1,10,'esquerdo','nome4','2001-09-24 23:00:00');
insert into Reposicao values(10,'EAN00001',1,10,'esquerdo','nome5','2005-01-28 23:00:00');
insert into Reposicao values(10,'EAN00001',1,10,'esquerdo','nome5','2005-01-28 23:00:01');

insert into Reposicao values(10,'EAN00002',1,10,'esquerdo','nome1','2006-10-27 23:00:00');

insert into Reposicao values(10,'EAN00004',1,10,'esquerdo','nome3','2002-01-30 23:00:01');
insert into Reposicao values(10,'EAN00004',1,10,'esquerdo','nome3','2002-01-30 23:00:02');



-- general

insert into Prateleira values('esquerdo',100,1);
insert into Prateleira values('esquerdo',100,2);
insert into Prateleira values('esquerdo',100,3);







