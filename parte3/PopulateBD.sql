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

insert into Produto values('EAN00001','Categoria1','000000001','design');
insert into Produto values('EAN00002','Categoria2','000000001','design');
insert into Produto values('EAN00003','Categoria3','000000001','design');
insert into Produto values('EAN00004','Categoria4','000000001','design');
insert into Produto values('EAN00005','Categoria5','000000001','design');
insert into Produto values('EAN00006','Categoria6','000000001','design');
insert into Produto values('EAN00007','Categoria7','000000001','design');

insert into Produto values('EAN00008','Categoria1','000000002','design');

insert into Fornecedor_Secundario values('000000002','EAN00007');
insert into Fornecedor_Secundario values('000000002','EAN00006');
insert into Fornecedor_Secundario values('000000002','EAN00005');
insert into Fornecedor_Secundario values('000000002','EAN00004');
insert into Fornecedor_Secundario values('000000002','EAN00003');
insert into Fornecedor_Secundario values('000000002','EAN00002');
insert into Fornecedor_Secundario values('000000002','EAN00001');

insert into Corredor values('')

insert into EventoReposicao values('joao','2006-10-27 23:00:00');
insert into EventoReposicao values('silva','2005-01-27 23:00:00');
insert into EventoReposicao values('carlos','2002-01-30 23:00:00');
insert into EventoReposicao values('manuel','2001-09-24 23:00:00');
insert into EventoReposicao values('dias','2011-11-21 23:00:00');

insert into Reposicao values(10,1,'EAN00001','sds','dias','2001-10-27 23:00:00');