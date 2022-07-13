INSERT INTO brand (id,name,provider) VALUES (1,'MARCA EXEMPLO',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (2,'ADORNOS/PRESENTES','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (3,'PELUCIAS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (4,'MAQUIAGEM','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (6,'ACESSORIOS DE MAQUIAGEM','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (5,'ACESSORIOS DE CABELO','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (7,'ANEIS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (8,'BRINCOS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (9,'CHAPEU','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (10,'CINTOS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (11,'CARTEIRAS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (12,'BOLSAS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (13,'UNHAS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (14,'NECESSAIR','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (15,'PRODUTOS PARA CABELO','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (16,'CUIDADOS COM A PELE','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (17,'BIJUTERIAS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (18,'OCULOS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (19,'CADASTRO ANTIGO','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (20,'RELOGIOS','#FD03BE',1,'',1); 

INSERT INTO category (id,name,color,multiply,icon_category,cest_ncm_default) VALUES (21,'INVERNO','#FD03BE',1,'',1); 

INSERT INTO cupom (id,with_client,code,value,description,all_products,acumulate,percent,quantity,default) VALUES (1,'','#AVAR',10,'aplica 10% em um produto avariado',false,true,true,0,true); 

INSERT INTO cupom (id,with_client,code,value,description,all_products,acumulate,percent,quantity,default) VALUES (2,'funcionario','#FUNC',15,'aplica 15% na compra de um funcionário',true,false,true,0,true); 

INSERT INTO cupom (id,with_client,code,value,description,all_products,acumulate,percent,quantity,default) VALUES (3,'funcionarioParceiro','#PARC',5,'aplica 5% na compra de um funcionário de loja parceira.',true,true,true,0,true); 

INSERT INTO price_list (id,name,store) VALUES (1,'TABELA PADRAO',null); 

INSERT INTO product_status (id,status) VALUES (1,'ATIVO'); 

INSERT INTO product_status (id,status) VALUES (2,'INATIVO'); 

INSERT INTO product_status (id,status) VALUES (3,'ERRO'); 

INSERT INTO product_type (id,description) VALUES (1,'NOVO'); 

INSERT INTO product_type (id,description) VALUES (2,'ECOMMERCE'); 

INSERT INTO product_type (id,description) VALUES (3,'ANTIGO'); 

INSERT INTO product_type (id,description) VALUES (4,'VIP'); 

INSERT INTO provider (id,social_name,cnpj,fantasy_name) VALUES (1,'FORNECEDOR EXEMPLO','0000000000000','EXEMPLO DE FORNECEDOR'); 
