-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Sun Oct  2 20:33:29 2022 
-- * LUN file: E:\Applications\UwAmp\www\shop-i150\db_shop_150.lun 
-- * Schema: mld/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database db_shop;
use db_shop;


-- Tables Section
-- _____________ 

create table t_category (
     idCategory bigint not null auto_increment,
     catName varchar(30) not null,
     constraint ID_t_category_ID primary key (idCategory));
     --
-- Contenu de la table `t_category`
--
INSERT INTO `t_category` (`idCategory`, `catName`)
VALUES (1, 'Vêtement'),
     (2, 'Sport'),
     (3, 'Informatique');

create table t_concern (
     fkOrder bigint not null,
     fkProduct bigint not null,
     conQuantity char(1) not null,
     constraint ID_t_concern_ID primary key (fkOrder, fkProduct));

create table t_order (
     idOrder bigint not null auto_increment,
     ordPaid char not null,
     ordTitle varchar(50) not null,
     ordFirstName varchar(50) not null,
     ordLastName varchar(50) not null,
     ordStreet varchar(100) not null,
     ordStreetNumber varchar(4) not null,
     ordLocality varchar(50) not null,
     ordMail varchar(255) not null,
     ordPhoneNumber varchar(20) not null,
     fkOrderStatus bigint,
     constraint ID_t_order_ID primary key (idOrder));

create table t_orderStatus (
     idOrderStatus bigint not null auto_increment,
     ordName varchar(50) not null,
     constraint ID_t_orderStatus_ID primary key (idOrderStatus));

create table t_product (
     idProduct bigint not null auto_increment,
     proName varchar(50) not null,
     proDescription varchar(255) not null,
     proPrice float(1) not null,
     proQuantity int not null,
     proImage varchar(255) not null,
     proLike bigint not null,
     fkCategory bigint not null,
     constraint ID_t_product_ID primary key (idProduct));

     --
-- Contenu de la table `t_product`
--
INSERT INTO `t_product` (
          `idProduct`,
          `proName`,
          `proDescription`,
          `proPrice`,
          `proQuantity`,
          `proImage`,
          `proLike`,
          `fkCategory`
     )
VALUES (
          1,
          'Pullover',
          'Pullover synthétique',
          20.9,
          10,
          'pull.png',
          0,
          1
     ),
     (
          2,
          'Pantalon',
          'Pantalon en Jean\'s véritable',
          49.9,
          25,
          'pants.png',
          0,
          1
     ),
     (
          3,
          'Clé Usb ',
          'Clé Usb de 4 Go offrant une fiabilité inégalée.',
          4.95,
          4,
          'usb.png',
          10,
          3
     ),
     (
          4,
          'Disque dur externe',
          'Disque dur externe de 1 To, idéal pour stocker et sauvegarder vos données de manière sécurisée.',
          79.95,
          2,
          'harddisk.png',
          0,
          3
     ),
     (
          5,
          'T-Shirt Fox',
          NULL,
          14.9,
          50,
          'shirt1.png',
          0,
          2
     ),
     (
          6,
          'T-Shirt Mignon',
          NULL,
          14.9,
          20,
          'shirt2.png',
          0,
          2
     );

create table t_user (
     idUser bigint not null auto_increment,
     useLogin varchar(20) not null,
     usePassword varchar(255) not null,
     useRight varchar(10) not null,
     constraint ID_t_user_ID primary key (idUser));
--
-- Contenu de la table `t_user`
--
INSERT INTO `t_user` (`idUser`, `useLogin`, `usePassword`, `useRight`)
VALUES (
          1,
          'admin',
          '$2y$10$UZ6NOFmrq5QY.XDdicl8EO0vxy.D/d4H48GrbRdTcKYQ0Kwqoo.ie',
          'admin'
     ),
     (
          2,
          'customer',
          '$2y$10$.8sXz4/qH5sngNgdEnn8HesHO3qoDvUcYmslZyGIpCUz1He0OmOAS',
          'customer'
     );

-- Constraints Section
-- ___________________ 

alter table t_concern add constraint FKt_c_t_p_FK
     foreign key (fkProduct)
     references t_product (idProduct);

alter table t_concern add constraint FKt_c_t_o
     foreign key (fkOrder)
     references t_order (idOrder);

alter table t_order add constraint FKt_be_FK
     foreign key (fkOrderStatus)
     references t_orderStatus (idOrderStatus);

alter table t_product add constraint FKt_have_FK
     foreign key (fkCategory)
     references t_category (idCategory);


-- Index Section
-- _____________ 

create unique index ID_t_category_IND
     on t_category (idCategory);

create unique index ID_t_concern_IND
     on t_concern (fkOrder, fkProduct);

create index FKt_c_t_p_IND
     on t_concern (fkProduct);

create unique index ID_t_order_IND
     on t_order (idOrder);

create index FKt_be_IND
     on t_order (fkOrderStatus);

create unique index ID_t_orderStatus_IND
     on t_orderStatus (idOrderStatus);

create unique index ID_t_product_IND
     on t_product (idProduct);

create index FKt_have_IND
     on t_product (fkCategory);

create unique index ID_t_user_IND
     on t_user (idUser);

