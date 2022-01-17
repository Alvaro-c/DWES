use pedidos;

create table productospendientes (

    CodPend int primary key,
    CodPed int,
    CodProd int,
    UdPend int,

    foreign key (CodPed) references pedidos(CodPed),
    foreign key (CodProd) references productos(CodProd)


);