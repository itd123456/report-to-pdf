<?php

class Database
{

    private $user = 'saprog';
    private $pass = 'SQL@2012!';
    private $db = 'GLOBAL_SOFIADB';
    private $host = '192.168.0.26';
    private $conn;


    public function __construct()
    {
        $this->conn = new PDO("sqlsrv:server=".$this->host.";Database=".$this->db, $this->user, $this->pass);
    }

    public function nonPdc($data)
    {
        $pn = $data;

        $sql = "SELECT DISTINCT a.MPDC_SEQUENCE, FORMAT(a.MPDC_MATURITY, 'MM/dd/yyyy') AS maturity, a.MPDC_AMOUNT, a.MPDC_STATUS, 
                b.LOAN_PN_NUMBER, FORMAT(b.LOAN_RELEASED_DATE, 'MM/dd/yyyy') AS released_date, c.BORR_ADDRESS, c.BORR_FIRST_NAME, 
                c.BORR_MIDDLE_NAME, c.BORR_LAST_NAME, c.BORR_SUFFIX, d.BRAN_NAME, d.BRAN_ADDRESS, e.PROD_NAME 
                FROM FI_AMORTSCHED_MASTER a
                LEFT JOIN LM_LOAN b  
                ON a.MPDC_PN_NUMBER = b.LOAN_PN_NUMBER 
                LEFT JOIN PR_BORROWERS c 
                ON b.LOAN_BORROWER_CODE = c.BORR_CODE
                LEFT JOIN PR_BRANCH d 
                ON b.LOAN_BR = d.BRAN_CODE
                LEFT JOIN PR_PRODUCT e 
                ON b.LOAN_PRODUCT_CODE = e.PROD_CODE 
        	    WHERE a.MPDC_PN_NUMBER = '$pn'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array());
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
?>