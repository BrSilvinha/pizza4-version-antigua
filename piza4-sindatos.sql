create table if not exists categoría
(
    id     int auto_increment
        primary key,
    nombre varchar(100) not null
)
    collate = utf8_spanish_ci;

create table if not exists personas
(
    id        int auto_increment
        primary key,
    nombre    varchar(100) not null,
    telefono  varchar(15)  null,
    direccion text         null,
    email     varchar(255) null,
    dni       varchar(10)  null
)
    collate = utf8_spanish_ci;

create table if not exists clientes
(
    id         int auto_increment
        primary key,
    persona_id int null,
    constraint clientes_ibfk_1
        foreign key (persona_id) references personas (id)
)
    collate = utf8_spanish_ci;

create index if not exists persona_id
    on clientes (persona_id);

create table if not exists presentación
(
    id          int auto_increment
        primary key,
    nombre      varchar(100) not null,
    descripcion text         null
)
    collate = utf8_spanish_ci;

create table if not exists productos
(
    id              int auto_increment
        primary key,
    nombre          varchar(100)         not null,
    descripcion     text                 null,
    precio          decimal(10, 2)       not null,
    disponible      tinyint(1) default 1 null,
    categoria_id    int                  null,
    presentacion_id int                  null,
    constraint productos_ibfk_1
        foreign key (categoria_id) references categoría (id),
    constraint productos_ibfk_2
        foreign key (presentacion_id) references presentación (id)
)
    collate = utf8_spanish_ci;

create index if not exists categoria_id
    on productos (categoria_id);

create index if not exists presentacion_id
    on productos (presentacion_id);

create table if not exists roles
(
    id     int auto_increment
        primary key,
    nombre varchar(50) not null
)
    collate = utf8_spanish_ci;

create table if not exists sede
(
    id        int auto_increment
        primary key,
    nombre    varchar(100) not null,
    direccion text         null
)
    collate = utf8_spanish_ci;

create table if not exists piso
(
    id      int auto_increment
        primary key,
    sede_id int          null,
    nombre  varchar(100) not null,
    constraint piso_ibfk_1
        foreign key (sede_id) references sede (id)
)
    collate = utf8_spanish_ci;

create table if not exists mesas
(
    id        int auto_increment
        primary key,
    piso_id   int                          null,
    numero    int                          not null,
    capacidad int                          not null,
    estado    varchar(255) default 'libre' null,
    constraint mesas_ibfk_1
        foreign key (piso_id) references piso (id)
)
    collate = utf8_spanish_ci;

create index if not exists piso_id
    on mesas (piso_id);

create index if not exists sede_id
    on piso (sede_id);

create table if not exists usuarios
(
    id         int auto_increment
        primary key,
    persona_id int          null,
    contrasena varchar(255) not null,
    constraint usuarios_ibfk_1
        foreign key (persona_id) references personas (id)
)
    collate = utf8_spanish_ci;

create table if not exists listroles
(
    id           int auto_increment
        primary key,
    usuario_id   int      not null,
    rol_id       int      null,
    fecha_inicio datetime not null,
    fecha_fin    datetime null,
    constraint listroles_ibfk_1
        foreign key (usuario_id) references usuarios (id),
    constraint listroles_ibfk_2
        foreign key (rol_id) references roles (id)
)
    collate = utf8_spanish_ci;

create index if not exists rol_id
    on listroles (rol_id);

create index if not exists usuario_id
    on listroles (usuario_id);

create index if not exists usuario_id_2
    on listroles (usuario_id);

create table if not exists pedidoscomanda
(
    id         int auto_increment
        primary key,
    usuario_id int                                  null,
    cliente_id int                                  null,
    mesa_id    int                                  null,
    fecha      datetime default current_timestamp() null,
    estado     varchar(255)                         not null,
    total      decimal(10, 2)                       not null,
    constraint pedidoscomanda_ibfk_1
        foreign key (usuario_id) references usuarios (id),
    constraint pedidoscomanda_ibfk_2
        foreign key (cliente_id) references clientes (id),
    constraint pedidoscomanda_ibfk_3
        foreign key (mesa_id) references mesas (id)
)
    collate = utf8_spanish_ci;

create table if not exists comprobanteventa
(
    id        int auto_increment
        primary key,
    pedido_id int                                  null,
    tipo      varchar(50)                          not null,
    monto     decimal(10, 2)                       not null,
    fecha     datetime default current_timestamp() null,
    constraint comprobanteventa_ibfk_1
        foreign key (pedido_id) references pedidoscomanda (id)
)
    collate = utf8_spanish_ci;

create index if not exists pedido_id
    on comprobanteventa (pedido_id);

create table if not exists detallespedido
(
    id          int auto_increment
        primary key,
    pedido_id   int            null,
    producto_id int            null,
    cantidad    int            not null,
    precio      decimal(10, 2) not null,
    descripcion text           null,
    constraint detallespedido_ibfk_1
        foreign key (pedido_id) references pedidoscomanda (id),
    constraint detallespedido_ibfk_2
        foreign key (producto_id) references productos (id)
)
    collate = utf8_spanish_ci;

create index if not exists idx_detallespedido_pedido_id
    on detallespedido (pedido_id);

create index if not exists producto_id
    on detallespedido (producto_id);

create index if not exists cliente_id
    on pedidoscomanda (cliente_id);

create index if not exists idx_pedidoscomanda_estado
    on pedidoscomanda (estado);

create index if not exists mesa_id
    on pedidoscomanda (mesa_id);

create index if not exists usuario_id
    on pedidoscomanda (usuario_id);

create index if not exists persona_id
    on usuarios (persona_id);

