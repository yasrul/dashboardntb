

$sql = 'SELECT u.userid, u.name, IF( COUNT( c.checktime ) >0, MIN( c.checktime ) , "Nihil" ) AS Datang, IF( COUNT( c.checktime ) >1, MAX( c.checktime ) , "Nihil" ) AS Pulang
		FROM userinfo u	
		LEFT JOIN checkinout c ON u.userid = c.userid AND DATE( c.checktime ) = '2016-7-15'
		WHERE u.defaultdeptid =2
		GROUP BY u.userid, DATE( c.checktime )
		ORDER BY u.userid ASC';

$result=dbExecute($dbdriver='mysqli', $hostname='172.16.150.125', $username='root',	$password='mautauaja',
	$dbname='adms_db', $sql,
	$trx=false
);

//old
$result=dbExecute(
	$dbdriver='mysqli',
	$hostname='172.16.150.125',
	$username='root',
	$password='mautauaja',
	$dbname='adms_db',
	$sql='SELECT * FROM checkinout WHERE YEAR(checktime)=2017 LIMIT 100',
	$trx=false
);
