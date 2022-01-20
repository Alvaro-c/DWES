use pedidos;

drop table if exists productospendientes;
create table productospendientes (

    CodPend int primary key auto_increment,
    CodPed int,
    CodProd int,
    UdPend int,

    foreign key (CodPed) references pedidos(CodPed),
    foreign key (CodProd) references productos(CodProd)


);