<?php
	function connectDB() {
		$HOST = "10.7.1.102";
		$PORT = "8732";
		$USER = "mli";
		$DBNAME = "testdb";
		$PASSWORD = "mli";
		$con = pg_connect("host=$HOST port=$PORT user=$USER dbname=$DBNAME password=$PASSWORD");
		if (!$con) {
			echo("DB connect error.");
			return;
		}
		return $con;
	}

	function login($con, $username, $password) {
		$username = trim($username);
		$password = trim($password);

		$SQL = "SELECT * FROM users WHERE username = '{$username}' AND status = 0";
		$res = pg_query($con, $SQL);
		$num = pg_num_rows($res);

		if ($num > 0) {
			$row = pg_fetch_assoc($res);
			if ($password == $row["password"]) {
				//ログイン成功
				return 0;
			}
			else {
				//パスワードが違うとき
				return 1;
			}
		}
		else {
			//ユーザー名が違うとき
			return 2;
		}
	}
?>
