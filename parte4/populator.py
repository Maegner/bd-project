print("insert into Categoria values('Frutos');")
print("insert into Categoria values('Categoria1');")
print("insert into Categoria_Simples values('Frutos');")
print("insert into Categoria_Simples values('Categoria1');")

for fornec in range(0,400000,1):
        print("Insert Into Fornecedor values(\'"+str(fornec)+"\','nome');")
        if fornec%2==0:
                print("Insert Into Produto values(\'"+str(fornec)+"\','Frutos',\'"+str(fornec)+"\','design','01-01-2012');")
        else:
                print("Insert Into Produto values(\'"+str(fornec)+"\','Categoria1',\'"+str(fornec)+"\','design','01-01-2012');")
        if fornec > 0:
                print("Insert Into Fornecedor_Secundario values(\'"+str(fornec-1)+"\'"",\'"+str(fornec)+"\');")

