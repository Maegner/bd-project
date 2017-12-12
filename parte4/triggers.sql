-- a)

DROP FUNCTION SecondaryExistsOnPrimary(character varying,character varying);

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

-- SELECT SecondaryExistsOnPrimary('sadas','sdfsdf');


ALTER TABLE Fornecedor_secundario
   ADD CONSTRAINT cantExist CHECK(SecondaryExistsOnPrimary(nif,ean) != TRUE);

-- b)
ALTER TABLE EventoReposicao
   ADD CONSTRAINT RI_EA3 CHECK(instante <= CURRENT_TIMESTAMP);



