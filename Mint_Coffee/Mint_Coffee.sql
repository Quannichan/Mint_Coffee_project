/* Author : Trần Minh Quân 22NS056,
			Thái Thị Hồng Phúc 22NS048*/
create database Mint_Coffee;
use Mint_Coffee;
/*Tạo bảng tin nhắn phản hồi*/ 
create table Mint_Coffee.submit_mes(
	first_name NVARCHAR(30),
    last_name nvarchar(30),
    phone_num nvarchar(15),
    title NVARCHAR(50),
    mes nvarchar(150)
);
/*Thêm dữ liệu đầu tiên test bảng*/
insert into Mint_Coffee.submit_mes values('Trần', 'Minh Quân','0886523224','Đánh giá quán','Cà phe đẹp, nước uống ngon, giá cả vừa phải.');
/*Tạo bảng tài khoản*/
create table Mint_Coffee.Acc(
	ID int auto_increment primary key,
	User_Name NVARCHAR(225),
    Phone_Number nvarchar(225),
    Pass NVARCHAR(225)
);
/*Truy suất dữ liệu , thêm dữ liệu và cập nhật*/
Select ID, User_Name, Phone_Number, Pass as showpass from  Mint_Coffee.Acc ;
insert into Mint_Coffee.Acc(User_Name,Phone_Number,Pass) values('Admin','100100',md5('AdminPage'));
Update Mint_Coffee.Acc set User_Name = 'Trần Minh Quân' where ID = 2;
/*Tạo bảng sản phẩm*/
create table Mint_Coffee.product(
	ID_product int auto_increment primary key,
    Name_Product nvarchar(225),
    price nvarchar(225),
    Price_Product int ,
    Image_Product nvarchar(225),
    categories nvarchar(225),
    file_path longtext,
    product_status nvarchar(100)
 );
 /* UPDATE dữ liệu bảng product */
Update Mint_Coffee.product SET product_status ='In Stock' WHERE ID_product BETWEEN 43 AND 77 ;
Update Mint_Coffee.product SET product_status ='Out Of Stock' WHERE ID_product = 43;
 /*Thêm dữ liệu vào bảng sản phẩm*/
 insert into Mint_Coffee.product(Name_Product,price,Price_Product,Image_Product,categories,file_path)
 values('Black Coffee','12.000đ',12000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê đen phin.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê đen phin.jpg'),
('Milk Coffee','12.000đ',12000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/caphesua.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/caphesua.jpg'),
('SaiGon Black Coffee','14.000đ',14000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê đen sài gòn.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê đen sài gòn.jpg'),
('SaiGon Milk Coffee','14.000đ',14000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê sữa sài gòn.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê sữa sài gòn.jpg'),
('White Coffee','14.000đ',14000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Bạc xĩu.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Bạc xĩu.jpg'),
('Salt Coffee','18.000đ',18000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê muối.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê muối.jpg'),
('Coconut Coffee','28.000đ',28000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê dừa.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Cà phê dừa.jpg'),
('Latte Art','30.000đ',30000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Latte art.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Latte art.jpg'),
('Latte Macchiato','35.000đ',35000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Latte macchiato.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Latte macchiato.jpg'),
('Matcha Latte','35.000đ',35000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Matcha latte.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Matcha latte.jpg'),
('Ice Blended Matcha','30.000đ',30000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/matcha da xay.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/matcha da xay.jpg'),
('Ice Blended Chocolate','30.000đ',30000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/socola-da-xay.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/socola-da-xay.jpg'),
('Orange Juice','20.000đ',20000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Nước cam.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Nước cam.jpg'),
('Pineapple Juice','20.000đ',20000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Nước ép thơm.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Nước ép thơm.jpg'),
('Lemongrass Chia Seeds','24.000đ',24000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Chanh xả hạt chia.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Chanh xả hạt chia.jpg'),
('Strawberry Smoothie','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Sinh tố dâu.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Sinh tố dâu.jpg'),
('Blueberry Yogurt','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Sữa chua việt quốc.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Sữa chua việt quốc.jpg'),
('Peach Tea','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Trà đào.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Trà đào.jpg'),
('Ginger Tea','20.000đ',20000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/TRà gừng.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/TRà gừng.jpg'),
('Fruit Tea','20.000đ',20000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Đồ uống/Trà trái cây.jpg','Drinks','../../../Images/Đồ-án-cơ-sở-1/Đồ uống/Trà trái cây.jpg');
 /*Thêm dữ liệu vào bảng sản phẩm*/
 insert into Mint_Coffee.product(Name_Product,price,Price_Product,Image_Product,categories,file_path)
 values('Cheesy Dinner Rolls ','30.000đ',30000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh mì phô mai tan chảy.png','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh mì phô mai tan chảy.png'),
 ('Breadstick ','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh mì que.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh mì que.jpg'),
 ('Bologna and Meat Bread ','35.000đ',35000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh mì thịt chả.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh mì thịt chả.jpg'),
 ('Roll Bread ','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/bánh mỳ cuộn.png','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/bánh mỳ cuộn.png'),
 ('Egg Tart ','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh tart trứng.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh tart trứng.jpg'),
 ('Dumplings','20.000đ',20000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh_bao.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Bánh_bao.jpg'),
 ('Donut ','20.000đ',20000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/bánh_donut.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/bánh_donut.jpg'),
 ('Cookies ','5.000đ',5000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Cookies.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Cookies.jpg'),
 ('BeefBurger ','35.000đ',35000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Hamburger bò.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Hamburger bò.jpg'),
 ('Brioche ','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Hoa-Cúc-3.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Hoa-Cúc-3.jpg'),
 ('Cheese Hotdog ','30.000đ',30000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/hotdog_phomai.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/hotdog_phomai.jpg'),
 ('Passion Fruit Mousse','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Mousse chanh dây.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Mousse chanh dây.jpg'),
 ('Panna Cotta Kiwi  ','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Panna cotta kiwi.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Panna cotta kiwi.jpg'),
 ('Sandwich ','30.000đ',30000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Sandwich.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Sandwich.jpg'),
 ('Tiramisu','25.000đ',25000,'/Mint_Coffee/Images/Đồ-án-cơ-sở-1/Bánh mì/Tiramisu.jpg','Foods','../../../Images/Đồ-án-cơ-sở-1/Bánh mì/Tiramisu.jpg');

CREATE TABLE Mint_Coffee.product_sell(
	ID_cart int,
    product_name nvarchar(225),
    product_quantity long,
    product_price long,
    date_product nvarchar(100)
); 
/*Tạo giỏ hàng*/  
CREATE table Mint_Coffee.Cuscart(
ID_Cart int auto_increment primary key,
Product_ID int,
User_ID int,  
Name_pro NVARCHAR(225),
Price_pro int,
Price LONGTEXT,
Image_Pro nvarchar(225),
quantity int,
STA nvarchar(225)
);
ALTER table Mint_Coffee.Cuscart 
ADD column STA nvarchar(225);
Select sum(quantity) as count FROM Mint_Coffee.Cuscart where User_ID = 2;
/*Tạo khóa phụ cho bảng Cuscart*/
Alter table Mint_Coffee.Cuscart 
add foreign key (Product_ID) references Mint_Coffee.product(ID_product),
add foreign key (User_ID) references Mint_Coffee.Acc(ID);
/*Tạo bảng đơn hàng*/
 create table Mint_Coffee.Orderr(
 Order_ID int auto_increment primary key,
 User_ID int,
 US_phone longtext,
 US_Name longtext,
 Address longtext,
 Note longtext,
 Name_order LONGTEXT,
 Price_order long,
 Statuss NVARCHAR(225),
 Time_Order nvarchar(15),
 Time_Acpt NVARCHAR(15)
 );
 /*Tạo khỏa phục cho bảng Orderr*/
 ALTER TABLE Mint_Coffee.Orderr 
 add FOREIGN KEY (User_ID) REFERENCES Mint_Coffee.Acc(ID);
 /*Tạo bảng OrderHis*/
CREATE table Mint_Coffee.OrderHis(
ID_His int auto_increment primary key,
Or_id int,
User_id int,
Name_Order longtext,
Note longtext,
Statuss Text,
Price long,
Time_All longtext
);
/*Tạo bảng OrderCancel*/
CREATE table Mint_Coffee.OrderCancel(
ID_Or_cancel int auto_increment primary key,
Or_id int,
User_id int,
Name_Order longtext,
Note longtext,
Statuss Text,
Price long,
Time_cancel longtext
);
/*Tạo khóa phụ cho bảng OrderHis*/
ALTER TABLE Mint_Coffee.OrderHis
add FOREIGN KEY (User_id) REFERENCES Mint_Coffee.Acc(ID);
/*Tạo khóa phụ cho bảng OrderCancel*/
ALTER TABLE Mint_Coffee.OrderCancel
add FOREIGN KEY (User_id) REFERENCES Mint_Coffee.Acc(ID);

/*Các lệnh truy suất dữ liệu*/
select Mint_Coffee.OrderHis.Or_id , Mint_Coffee.Orderr.Name_Order 
from Mint_Coffee.OrderHis
inner join Mint_Coffee.Orderr on  Mint_Coffee.OrderHis.Name_Order  = Mint_Coffee.Orderr.Name_order;

select Mint_Coffee.Acc.ID ,Mint_Coffee.Acc.User_Name ,  Mint_Coffee.Acc.Phone_Number , sum(Mint_Coffee.OrderHis.Price) as total
from Mint_Coffee.OrderHis
RIGHT join Mint_Coffee.Acc  on  Mint_Coffee.Acc.ID = Mint_Coffee.OrderHis.User_id Group by Mint_Coffee.Acc.ID  ;

select Mint_Coffee.Acc.ID ,Mint_Coffee.Acc.User_Name ,  Mint_Coffee.Acc.Phone_Number , sum(Mint_Coffee.OrderHis.Price) as total
from Mint_Coffee.OrderHis
RIGHT join Mint_Coffee.Acc  on  Mint_Coffee.Acc.ID = Mint_Coffee.OrderHis.User_id Where Mint_Coffee.OrderHis.Time_All LIKE '%/04/%' Group by Mint_Coffee.Acc.ID  ;


SELECT Mint_Coffee.Acc.ID ,Mint_Coffee.Acc.User_Name ,  Mint_Coffee.Acc.Phone_Number , SUM(Mint_Coffee.OrderHis.Price) as Total
FROM Mint_Coffee.Acc LEFT JOIN Mint_Coffee.OrderHis ON Mint_Coffee.Acc.ID = Mint_Coffee.OrderHis.User_id WHERE Time_All = NULL  GROUP BY Mint_Coffee.Acc.ID;

DELETE FROM Mint_Coffee.OrderHis;
DELETE FROM Mint_Coffee.OrderCancel;
DELETE FROM Mint_Coffee.Cuscart;
DELETE FROM Mint_Coffee.Orderr;












/* Author : Trần Minh Quân 22NS056,
			Thái Thị Hồng Phúc 22NS048*/