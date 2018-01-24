DROP TABLE online;

CREATE TABLE `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO online VALUES("14","::1","1512661033");



DROP TABLE shortlink;

CREATE TABLE `shortlink` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `short` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO shortlink VALUES("1","0","0","1");
INSERT INTO shortlink VALUES("2","http://localhost/lab/shortLink/","EOawV","1");
INSERT INTO shortlink VALUES("3","http://localhost/lab/shortLink/","zzCax","1");
INSERT INTO shortlink VALUES("4","http://localhost/lab/shortLink/index.php","EpOxw","1");
INSERT INTO shortlink VALUES("5","http://localhost/lab/shortLink/index.php","EwVwj","1");
INSERT INTO shortlink VALUES("6","http://localhost/lab/shortLink/index.php","VxCaO","1");
INSERT INTO shortlink VALUES("7","http://localhost/lab/shortLink/index.php","OpECC","1");
INSERT INTO shortlink VALUES("8","http://localhost/lab/shortLink/index.php","CEVzx","1");
INSERT INTO shortlink VALUES("9","http://3sk.tv/s/vid/s/19713","CVwjE","1");
INSERT INTO shortlink VALUES("10","http://3sk.tv/s/vid/s/19713","wjCjx","1");
INSERT INTO shortlink VALUES("11","http://3sk.tv/s/vid/s/19713","jCxxC","1");
INSERT INTO shortlink VALUES("12","ff","ff","0");
INSERT INTO shortlink VALUES("13","","","0");
INSERT INTO shortlink VALUES("14","Omar","oe.ma","0");
INSERT INTO shortlink VALUES("15","","","0");
INSERT INTO shortlink VALUES("16","","","0");
INSERT INTO shortlink VALUES("17","","","0");
INSERT INTO shortlink VALUES("18","","","0");
INSERT INTO shortlink VALUES("19","","","0");
INSERT INTO shortlink VALUES("20","","","0");
INSERT INTO shortlink VALUES("21","","","0");
INSERT INTO shortlink VALUES("22","","","0");
INSERT INTO shortlink VALUES("23","","","0");
INSERT INTO shortlink VALUES("24","holas","h.net","0");
INSERT INTO shortlink VALUES("25","\' or 1=1;","gg","0");
INSERT INTO shortlink VALUES("26","<script>alert(\'test\');</script> ","<script>alert(\'test\');</script> ","0");
INSERT INTO shortlink VALUES("27","<script>alert(\'test\');</script> ","<script>alert(\'test\');</script> ","0");



