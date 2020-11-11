<?php
session_start();
class Config
	{
		protected $host		= 'localhost';
		protected $dbname 	= 'esb_test';
		protected $user	 	= 'root';
		protected $password	= '';

		public function connectionKey()
		{
			$mysqli = mysqli_connect($this->host,$this->user,$this->password);
			$mysqli->select_db($this->dbname);

			return $mysqli;
		}

		public function check()
		{
			$check = "Ea";
			return $check;
		}

		public function closeConnection()
		{
			$mysqli = null;
		}
		
		public function userId($lenght)
		{
			$char= '123456789abcdef';
		    $string = '';
		    for ($i = 0; $i < $lenght; $i++) {
			  $pos = rand(0, strlen($char)-1);
			  $string .= $char{$pos};
		    }
		    return $string;
		}

		public function selInvoice($id = false)
		{
			$callConn = $this->connectionKey();

			if ($id == false) {
				$query = $callConn->query("SELECT a.*,b.name as fromNm,c.name as forNm 
									FROM tblinvoice a 
									JOIN tbldestination b ON a.fromCd = b.destinationCd
									JOIN tbldestination c ON a.forCd = c.destinationCd 
									ORDER BY dueDt DESC");
			} else {
				$query = $callConn->query("SELECT a.*,b.name as fromNm,b.street as fromStreet, b.city as fromCity, b.country as fromCountry, c.name as forNm,c.street as forStreet, c.city as forCity, c.country as forCountry 
									FROM tblinvoice a 
									JOIN tbldestination b ON a.fromCd = b.destinationCd
									JOIN tbldestination c ON a.forCd = c.destinationCd 
									WHERE a.invoiceCd = '$id'
									ORDER BY dueDt DESC");
			}

			

			if ($query) {
				//echo "<script>alert('GET DATA')</script>";
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		public function selInvoiceDtl($id)
		{
			$callConn = $this->connectionKey();

			
			$query = $callConn->query("SELECT b.*, c.type, c.unitPrice
								FROM tblinvoice a 
								JOIN tblinvoiceitem b ON a.invoiceCd = b.invoiceCd
								JOIN tblitem c ON b.itemCd = c.itemCd 
								WHERE a.invoiceCd = '$id'
								ORDER BY dueDt DESC");

			

			if ($query) {
				//echo "<script>alert('GET DATA')</script>";
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		public function invoiceNo()
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT CONCAT('', LPAD(invoiceCd + 1, 4, '0')) cnt FROM tblinvoice 						ORDER BY invoiceCd DESC LIMIT 1");

			$row = mysqli_num_rows($query);

			if ($row  > 0) {
				while($row = $query->fetch_assoc()) {
				   return $row['cnt'];
				}
			} else {
				return $query = "0001";
			}


		}

		public function addInvoice($invoiceNo, $subject, $from_dest, $for_dest, $issue_dt, $due_dt, $status, $date)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("INSERT INTO tblinvoice SET invoiceCd = '$invoiceNo', subject = '$subject', fromCd = '$from_dest', forCd = '$for_dest', issueDt = '$issue_dt', dueDt = '$due_dt', status = '$status', payDt = NULL, createdDt = '$date', updatedDt = '$date'");

			if ($query) {
				//echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function upInvoice($invoiceNo, $subject, $from_dest, $for_dest, $issue_dt, $due_dt, $status, $date)
		{
			$callConn = $this->connectionKey();


			if ($status == "Y") {
				$query = $callConn->query("UPDATE tblinvoice SET subject = '$subject', fromCd = '$from_dest', forCd = '$for_dest', issueDt = '$issue_dt', dueDt = '$due_dt', status = '$status', payDt = '$date', updatedDt = '$date' WHERE invoiceCd = '$invoiceNo'");
			} else {
				$query = $callConn->query("UPDATE tblinvoice SET subject = '$subject', fromCd = '$from_dest', forCd = '$for_dest', issueDt = '$issue_dt', dueDt = '$due_dt', status = '$status', updatedDt = '$date' WHERE invoiceCd = '$invoiceNo'");
			}

			if ($query) {
				//echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function delInvoice($id)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("DELETE FROM tblinvoiceitem WHERE invoiceCd = '$id'");

			$query = $callConn->query("DELETE FROM tblinvoice WHERE invoiceCd = '$id'");

			if ($query) {
				//echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function selDestination()
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT * FROM tbldestination ");

			if ($query) {
				//echo "<script>alert('GET DATA')</script>";
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		public function selItem()
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT * FROM tblitem ");

			if ($query) {
				//echo "<script>alert('GET DATA')</script>";
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		public function amountItem($itemCd)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT unitPrice FROM tblitem WHERE itemCd = '$itemCd'");

			$row = mysqli_num_rows($query);

			if ($row  > 0) {
				while($row = $query->fetch_assoc()) {
				   return $row['unitPrice'];
				}
			} else {
				return $query = "0";
			}


		}

		public function addInvoiceItem($invoiceNo, $seq, $itemCd, $qty, $unitPrice, $amount, $date)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("INSERT INTO tblinvoiceitem SET invoiceCd = '$invoiceNo', seq = '$seq', itemCd = '$itemCd', qty = '$qty', unitPrice = '$unitPrice', amount = '$amount', createdDt = '$date', updatedDt = '$date'");

			if ($query) {
				//echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function upInvoiceItem($invoiceNo,$itemCd, $qty, $unitPrice, $amount, $date)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("UPDATE tblinvoiceitem SET itemCd = '$itemCd', qty = '$qty', unitPrice = '$unitPrice', amount = '$amount', updatedDt = '$date' WHERE invoiceCd = '$invoiceNo'");

			if ($query) {
				//echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function maxSeq()
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT MAX(seq) + 1 maxSeq FROM tblinvoiceitem LIMIT 1");

			$row = mysqli_num_rows($query);

			if ($row  > 0) {
				while($row = $query->fetch_assoc()) {
				   return $row['maxSeq'];
				}
			} else {
				return $query = "1";
			}


		}

	}
	   
?>
