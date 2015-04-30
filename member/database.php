<html>
<head><title>K-Town Car Share Database</title></head>
<body>

<?php
/* Program: database.php
 * Desc:    Creates and loads the company database tables with 
 *          sample data.
 */
 
 $host = "localhost";
 $user = "jenny1994";
 $password = "815815";
 $database = "KTCS"; 

 $cxn = mysqli_connect($host,$user,$password, $database);
 // Check connection
 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
  }
   
   mysqli_query($cxn,"drop table Location;");
   mysqli_query($cxn,"drop table Car;");
   mysqli_query($cxn,"drop table Member;");
   mysqli_query($cxn,"drop table Reservation;");
   mysqli_query($cxn,"drop table Comments;");
   mysqli_query($cxn,"drop table Fee;");
mysqli_query($cxn,"drop table Admin;");


   mysqli_query($cxn,"CREATE TABLE Location(
                  locationID			int(9)   NOT NULL   auto_increment,
                  locationName      VARCHAR(20)     NOT NULL,
                  address               VARCHAR(100)     NOT NULL,
                  number_of_space		INTEGER      NOT NULL,
                  PRIMARY KEY(locationID));");


   mysqli_query($cxn,"CREATE TABLE Car(
                  VIN			CHAR(17)	NOT NULL,
                  make          VARCHAR(20) NOT NULL,
                  model         VARCHAR(20) NOT NULL,   
                  year          INT(4)  NOT NULL,
                  locationID    INT(5)     NOT NULL,
                  current_status    VARCHAR(20) NOT NULL,
                  last_odometer_reading     INTEGER NOT NULL,
                  last_gas_tank_reading		DECIMAL(4,2)    NOT NULL,
                  date_of_last_maintenance_check		DATE  NOT NULL,
                  odometer_reading_of_last_maintenance_check    INTEGER NOT NULL,
                  PRIMARY KEY(VIN));");

   mysqli_query($cxn,"CREATE TABLE Admin(
                  adminID			int(9)    NOT NULL	     auto_increment,
                  Name              VARCHAR(20)      NOT NULL,
                  address			VARCHAR(40) NOT NULL,
                  phone_number      BIGINT(10)  NOT NULL,
                  email             VARCHAR(40)     NOT NULL,
                  password      VARCHAR(20) NOT NULL    default 'xxxx',
                  PRIMARY KEY (adminID));"); 
   mysqli_query($cxn, "ALTER TABLE Admin AUTO_INCREMENT=10001;");
   
   mysqli_query($cxn,"CREATE TABLE Member(
                  member_ID			int(9)        NOT NULL     auto_increment,
                  Name              VARCHAR(20)      NOT NULL,
                  address			VARCHAR(40) NOT NULL,
                  phone_number      BIGINT(10)  NOT NULL,
                  email             VARCHAR(40)     NOT NULL,
                  driver_license_number     CHAR(15)    NOT NULL,
                  credit_card_number    BIGINT(16)     NOT NULL,
                  expiring_date     CHAR(4)        NOT NULL,
                  registration_anniversary_date date NOT NULL,
                  password      VARCHAR(20)     NOT NULL,
                  PRIMARY KEY (member_ID));");
    mysqli_query($cxn, "ALTER TABLE Member AUTO_INCREMENT=100000001;");

   mysqli_query($cxn,"CREATE TABLE Reservation(
                  reservation_number    VARCHAR(64)    NOT NULL,
                  member_ID			INT(9)		NOT NULL,
                  VIN               CHAR(17)    NOT NULL,
                  date              DATE        NOT NULL,
                  locationID		INT(5)   NOT NULL,
                  pick_up_time      TIMESTAMP		NULL DEFAULT NULL,
                  odometer_reading_at_pickup    INTEGER   NULL,
                  status            VARCHAR(20)      NOT NULL,
                  return_time   TIMESTAMP    NULL DEFAULT NULL,
                  odometer_reading_at_return    INTEGER   NULL,
                  PRIMARY KEY(reservation_number));");

   mysqli_query($cxn,"CREATE TABLE Comments(
                  commentID		INT(9)    NOT NULL,
                  member_ID     INT(9)	NOT NULL,
                  PostTime      datetime NOT NULL,
                  VIN			CHAR(17)    NULL,
                  commentString     VARCHAR(300)   NOT NULL,
                  response  VARCHAR(300) NULL
                  );");
  

   mysqli_query($cxn,"CREATE TABLE Fee(
                  member_ID     INT(9)	NOT NULL,
                  annual_membership_fee     DECIMAL(19,2)	NOT NULL,
                  usage_fee     DECIMAL(19,2)	NOT NULL,
                  PRIMARY KEY(member_ID));");

     mysqli_query($cxn,"insert into Location (locationName, address, number_of_space) values
         ('Kingston Center','1000 Princess St, Kingston, ON','4'),
         ('Queen\'s Campus','18 Bader Lane, Kingston, ON','1')");
     

    mysqli_query($cxn,"insert into Car values
         ('2H4TB2H26AC000000','Honda','Accord Crosstour','2010','00001','in_use','234657','50.2','2015-01-24','234009'),
         ('2HGBH41JX9N109186','Honda',' Accord coupe','2009','00002','available','123578','60.5','2014-12-03','121678'), 
         ('2BEDT162261200000','BMW','E90','2006','00001','available','578932','89.3','2014-01-22','123145'),
         ('2NVHT82H485113456','Nissan','350Z','2008','00001','available','675329','67.8','2014-08-15','200000')");
  
     mysqli_query($cxn,"insert into Member values
         ('','Frank Jiang','475 Princess St, Kingston, ON','6477778888','franksb@queensu.ca','D61014070660905','4520993387598400','0116','2014-12-30','123456'),
         ('','Jenny Zhang','11260 Union St, Kingston, ON','6044445555','12jnz@queensu.ca','D34283839281043','4520394729057892','0817','2012-12-24','123456')");

 mysqli_query($cxn,"insert into Admin values    
         ('','Annie Xu','475 Princess St, Kingston, ON','6477778888','franksb@queensu.ca','123456'),
         ('','Renee Lee','11260 Union St, Kingston, ON','6044445555','12jnz@queensu.ca',DEFAULT)");


     mysqli_query($cxn,"insert into Reservation values
        (UUID_SHORT(),'100000001','2H4TB2H26AC000000','2015-01-01','00001','2015-01-04 07:00:00','233272','return','2015-01-09 12:00:00','23390'),
         (UUID_SHORT(),'100000002','2H4TB2H26AC000000','2015-02-02','00001','2015-02-04 08:00:00','234457','return','2015-02-09 10:00:00','23550'),
         (UUID_SHORT(),'100000001','2NVHT82H485113456','2015-01-28','00001','2015-03-15 13:00:00','675330', 'return','2015-3-20 16:00:00','675680'),
         (UUID_SHORT(),'100000002','2BEDT162261200000','2015-03-31','00001','2015-05-05 17:00:00','', 'return','2015-5-12 18:00:00',''),
         (UUID_SHORT(),'100000001','2NVHT82H485113456','2015-03-31','00001','2015-03-15 13:00:00','675680', 'in_use','2015-4-1 19:00:00','')");




     mysqli_query($cxn,"insert into Fee values
         ('100000001','300.00','15'),
         ('100000002','240.00','13')");

     mysqli_query($cxn,"insert into Comments values
         ('1','100000001',NOW(),'','Hello World!',''),
         ('2','100000001',NOW(),'2H4TB2H26AC000000','I like this carx',''),
         ('1','100000002',NOW(),'','I like the service.','hihi')");


   mysqli_close($cxn); 



echo "K-Town Car Share database created.";

?>
</body></html>
