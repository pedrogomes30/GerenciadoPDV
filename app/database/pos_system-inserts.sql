INSERT INTO payment_method (id,method,alias,issue) VALUES (1,'pix','Pix',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (2,'credit card ','Cartão De Credito a Vista',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (4,'debit card','Cartão De Débito',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (5,'store credit','Crédito Loja',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (6,'money','Dinheiro',false); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (7,'mix','Pagamento Misto',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (3,'date credit card ','Cartão De Crédito Prazo',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (8,'wallet digital','Carteira Digital',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (9,'cashback','cashback',true); 

INSERT INTO payment_method_store (id,method,store) VALUES (1,1,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (2,2,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (3,3,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (4,4,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (5,5,1); 

INSERT INTO profession (id,description,is_manager) VALUES (1,'Gerente',true); 

INSERT INTO profession (id,description,is_manager) VALUES (2,'Operador de Caixa',false); 

INSERT INTO profession (id,description,is_manager) VALUES (3,'Estoquista',false); 

INSERT INTO profession (id,description,is_manager) VALUES (4,'Aux. Administrativo',false); 

INSERT INTO profession (id,description,is_manager) VALUES (5,'Administrador',true); 

INSERT INTO store_group (id,name,default_theme) VALUES (1,'Fashion Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (2,'Jade Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (3,'Tj Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (4,'Flor Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (5,'Mimos Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (6,'Divvina Biju',null); 

INSERT INTO user (id,obs,profile_img,origin_store,current_store,profession,system_user) VALUES (1,'','',1,1,1,1); 
