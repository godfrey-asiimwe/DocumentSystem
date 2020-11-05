CREATE TABLE docs (
  'id' int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  'Doc_no' varchar(100) NULL,
  'Code' varchar(100) NULL,
  'level' varchar(100) NULL,
  'Holder' varchar(600) NULL,
  'reg.no' varchar(500) NULL,
  'issue_year' varchar(100) NULL,
  'payment' varchar(100) NULL,
  'status' varchar(100) NULL,
  'date_creation' varchar(100) NULL,
  'created_by' varchar(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE issue (
  'id' int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  'doc_id' int(11) NULL,
  'comment' varchar(100) NULL,
  'date_creation' varchar(100) NULL,
  'created_by' varchar(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


