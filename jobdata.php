<?php

ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");
//error_log( "Hello, errors!" );

require 'vendor/autoload.php';


require 'db.php';
$filename = 'testertemp.php';

$phpWord = new PhpOffice\PhpWord\PhpWord();



$casenum = $_POST['casejob'];



$sql ="select C.CaseNumber AS [1]
,c.OrderId as ord
,case when ChargeableReference = ' ' then 'none' else ChargeableReference end as cr
,c.CaseSkill
,CONVERT(VARCHAR(10), C.CreatedDate, 103) AS cdate
,isnull(job.JobDescription, 'no Job Description') as dd
,C.CaseStatus AS [3]
,C.CaseType AS [4]
,C.SerialNumber AS ser
,C.Brand + ' ' + C.ProductType AS [6]
,C.Flag AS [7]
,C.FirstLevelFault AS iss
,C.SecondFault AS [9]
,C.CallerName AS [10]
,C.ContactName AS con
,C.ContactLandline AS [12]
,case when isnull(C.ContactMobile, 'none') = ' ' then 'none' else isnull(C.ContactMobile, 'none') end AS [13]
,C.ContactEmail AS [14]
,replace(C.LastAddress1  + '' + C.LastAddress2 + '' + C.LastAddress3, '&', 'and') AS addr
,case when C.LastAddrLocation = ' ' then 'none' else C.LastAddrLocation end AS [16]
,C.LastAddress2 AS [17]
,C.LastAddress3 AS [18]
,C.LastCity AS [19]
,C.LastPostCode AS [20]
,case when isnull(C.CustomerRef, 'none') = ' ' then 'none' else isnull(C.CustomerRef, 'none') end AS [21] 
,replace(convert(varchar(max), C.CaseDescription), '&', 'and') AS casedesc
,C.PartCode AS [23]
,C.OrderId AS [24]
,CON.ContractDescription AS [25]
,CONVERT(VARCHAR(10),CON.EndDate, 103) AS [26]
FROM [Stone].[dbo].[Case] AS C WITH (NOLOCK)
left JOIN [Stone].[dbo].[SerialNumbers] AS S WITH (NOLOCK) ON
C.SerialNumber = S.SerialNumber
left JOIN [Stone].[dbo].[Contracts] AS CON WITH (NOLOCK) ON
S.ContractNumber = CON.ContractNum
left join job with(nolock) on
 job.CaseNumber = c.CaseNumber
 and job.AccountCode not like null

WHERE C.CaseNumber = '".$casenum."'


";


$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);


$date = $data['cdate'];

$file = fopen("test.txt","w");
echo fwrite($file,print_r($data, true));
fclose($file);




//$document = $PHPWord->loadTemplate('test.docx');
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("jobsheettemplete.docx");
$templateProcessor->setValue('caseref',$casenum );
$templateProcessor->setValue('reportdate',$date);
$templateProcessor->setValue('po',$data['cr'] );
$templateProcessor->setValue('contact',$data['con'] );
$templateProcessor->setValue('add',$data['addr'] );
$templateProcessor->setValue('issue',$data['casedesc'] );
$templateProcessor->setValue('serial',$data['ser'] );
$templateProcessor->setValue('jobdetail',$data['dd'] );
$templateProcessor->setValue('tech',$data['CaseSkill'] );

//$document->setValue('value1', 'Description');


$filename = $casenum."jobsheet.docx";

header("Content-Disposition: attachment; filename=".$filename);
ob_clean();
 $templateProcessor->saveAs('php://output');
//$templateProcessor->saveAs($filename);








?>