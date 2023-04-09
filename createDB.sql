CREATE TABLE IF NOT EXISTS contractor_table (
  contractor_id int(5) not null AUTO_INCREMENT,
  company_name varchar(100) not null,
  phone_number varchar(20) not null,
  company_description varchar(500),
  company_address varchar(50),
  verified boolean,
  PRIMARY KEY (contractor_id)
);
CREATE TABLE IF NOT EXISTS user_table (
  user_id int(5) not null AUTO_INCREMENT,
  contractor_id int(5),
  first_name varchar(15),
  last_name varchar(30),
  email varchar(30),
  date_of_birth date,
  user_password varchar(250),
  role text(10),
  PRIMARY KEY (user_id),
  FOREIGN KEY (contractor_id) REFERENCES contractor_table(contractor_id)
);
CREATE TABLE IF NOT EXISTS news_table (
  news_id int(4) not null AUTO_INCREMENT,
  user_id int(5) not null,
  Title varchar(100) not null,
  news_date date,
  body varchar(1000),
  image varchar(30),
  PRIMARY KEY (news_id),
  FOREIGN KEY (user_id) REFERENCES user_table(user_id)
);
CREATE TABLE IF NOT EXISTS report_table (
  report_id int(5) not null AUTO_INCREMENT,
  user_id int(5) not null,
  type varchar(15),
  other varchar(15),
  longitude float(30) not null,
  latitude float(30) not null,
  description text(300),
  report_status varchar(10),
  date_reported date,
  favourites int(3),
  PRIMARY KEY (report_id),
  FOREIGN KEY (user_id) REFERENCES user_table(user_id)
);
CREATE TABLE IF NOT EXISTS job_table (
  job_id int(5) not null AUTO_INCREMENT,
  contractor_id int(5),
  report_id int(5) not null,
  job_name varchar(30) not null,
  job_description text(50),
  completed_picture varchar(20),
  date_resolved date,
  PRIMARY KEY (job_id),
  FOREIGN KEY (contractor_id) REFERENCES contractor_table(contractor_id),
  FOREIGN KEY (report_id) REFERENCES report_table(report_id)
);
CREATE TABLE IF NOT EXISTS invoice_table (
  invoice_id int(5) not null AUTO_INCREMENT,
  job_id int(5) not null,
  cost int(6),
  invoice_date date,
  PRIMARY KEY (invoice_id),
  FOREIGN KEY(job_id) REFERENCES job_table(job_id)
);


CREATE TABLE IF NOT EXISTS favourites_table (
  user_id int(4) not null,
  report_id int(4) not null,
  FOREIGN KEY (user_id) REFERENCES user_table(user_id),
  FOREIGN KEY (report_id) REFERENCES report_table(report_id)
);
CREATE TABLE IF NOT EXISTS images_table (
  image_location varchar(20) not null,
  report_id int(5) not null,
  PRIMARY KEY (image_location),
  FOREIGN KEY (report_id) REFERENCES report_table(report_id)
);
CREATE TABLE IF NOT EXISTS comments_table(
  comment_id int(4) not null,
  user_id int(4) not null,
  report_id int(4) not null,
  comment_text varchar(50),
  PRIMARY KEY (comment_id),
  FOREIGN KEY (user_id) REFERENCES user_table(user_id),
  FOREIGN KEY (report_id) REFERENCES report_table(report_id)
)
