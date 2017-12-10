-- a)
DROP FUNCTION PrimaryExistsOnSecondary(character varying,character varying);
DROP FUNCTION SecondaryExistsOnPrimary(character varying,character varying);

create or replace function PrimaryExistsOnSecondary(nifIN varchar(9),eanIN varchar(25))
	returns boolean as $$
    declare ans boolean;
begin

select TRUE into ans
from Fornecedor_secundario as F
where nif = nifIN and ean = eanIN;

if ans is null then ans := FALSE; end if;
return ans;
end; $$ language plpgsql;


create or replace function SecondaryExistsOnPrimary(nifIN varchar(9),eanIN varchar(25))
	returns boolean as $$
    declare ans boolean;
begin

select TRUE into ans
from Produto as F
where forn_primario = nifIN and ean = eanIN;

if ans is null then ans := FALSE; end if;
return ans;
end; $$ language plpgsql;

-- PARA TESTAR:

-- SELECT primeAndSecToSameProduct('sadas','sdfsdf');

ALTER TABLE Produto
   ADD CONSTRAINT cantExist CHECK(PrimaryExistsOnSecondary(forn_primario,ean) != TRUE);

ALTER TABLE Fornecedor_secundario
   ADD CONSTRAINT cantExist CHECK(SecondaryExistsOnPrimary(nif,ean) != TRUE);

-- b)
ALTER TABLE EventoReposicao
   ADD CONSTRAINT RI_EA3 CHECK(instante <= CURRENT_TIMESTAMP);



