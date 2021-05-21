<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

header("Refresh:10");




    require('db.php');

   


    $sql = " 

    set nocount on

 

SET LANGUAGE BRITISH;


declare @t table(

	
    stockstaus varchar(20),
    casenumber int,
    casetype varchar(20),
    partnum varchar(20), 
    jobnum varchar(30),
    Datemoved datetime,
    duepick datetime,
    qty int, 
    unitPrice decimal(16, 2), 
    totalCost decimal(16, 2),
    location varchar(30),
    PartDesc varchar(MAX)
    )
    
    INSERT INTO @T
    
    SELECT S.StockStatus as [Stock Status], 
    J.CaseNumber,
    c.CaseType,
                    S.PartNum as [Part Number], 
                    s.jobref as [Job Num], 
                    S.EditDate as [Date Moved], 
    case when convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 101) else substring(j.ScheduleDesc, 1, 10) end) end), 105) like '%/19%' or 
                convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 101) else substring(j.ScheduleDesc, 1, 10) end) end), 105) like '%/18%' then convert(datetime, convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 3) else substring(j.ScheduleDesc, 1, 10) end) end), 3) , 3) else 
                convert(datetime, convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 101) else substring(j.ScheduleDesc, 1, 10) end) end), 105), 105)  end as duepick,
                    --s.DueDate,
                    S.Qty as [Qty], 
                    UnitPrice [Unit Price], 
                    S.Qty * S.UnitPrice as [Total Cost], 
                    Case when S.LocationType = '' then 'No Location' else isnull(S.LocationType, 'No Location') End  As [Location], 
                    cast(P.PartDescription as varchar(max)) as [Part Desc] 
    FROM Stock as S with (nolock) 
                    JOIN Parts as P with (nolock) ON 
                                    P.partnum = S.partnum 
                                            join [case] as c with(nolock) on 
                                    c.casenumber = s.casenumber
                                    join job as j with(nolock) on
                                    j.JobNumber = s.JobRef
    
    WHERE StockStatus in ('Picked', 'Bagged') and (j.JobStatus not in('closed','cancelled') )
    
    
    union all


    
    
    SELECT S.StockStatus as [Stock Status], 
    J.CaseNumber,
    c.CaseType,
                    S.PartNum as [Part Number], 
                    s.jobref as [Job Num], 
                    S.EditDate as [Date Moved], 
                 case when convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 101) else substring(j.ScheduleDesc, 1, 10) end) end), 105) like '%/19%' or 
                convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 101) else substring(j.ScheduleDesc, 1, 10) end) end), 105) like '%/18%' then convert(datetime, convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 3) else substring(j.ScheduleDesc, 1, 10) end) end), 3) , 3) else 
                convert(datetime, convert(varchar(10),(case when casetype = 'parts only' then convert(varchar(10),shipdate, 101) else  (case when substring(j.ScheduleDesc, 1, 10) like '%19 %' or  substring(j.ScheduleDesc, 1, 10) like '%18 %'  then substring(j.ScheduleDesc, 1, 9) when CaseType = 'Repair Centre' then  convert(varchar(10), DATEADD(DAY, 1, getdate()), 101) else substring(j.ScheduleDesc, 1, 10) end) end), 105), 105)  end as duepick,
                    --s.DueDate,
                    S.Qty as [Qty], 
                    UnitPrice [Unit Price], 
                    S.Qty * S.UnitPrice as [Total Cost], 
                    Case when S.LocationType = '' then 'No Location' else isnull(S.LocationType, 'No Location') End  As [Location], 
                    cast(P.PartDescription as varchar(max)) as [Part Desc] 
    FROM Stock as S with (nolock) 
                    LEFT JOIN Parts as P with (nolock) ON 
                                    P.partnum = S.partnum 
                                            join job as j with(nolock) on
                                    j.JobNumber = s.JobRef
                                    LEFT join [case] as c with(nolock) on 
                                    c.casenumber = J.casenumber
    WHERE StockStatus in('Reserved') 
    and j.JobStatus not in('closed','cancelled') 
    ORDER BY S.StockStatus, S.Partnum, duepick
    
    
    
    select 
    stockstaus ,
    casenumber ,
    casetype ,
    partnum , 
    jobnum ,
    datemoved,
	duepick,
--    CASE WHEN 
--	convert(varchar(20), duepick, 111) IN (SELECT convert(varchar(20), [Date], 111)
-- FROM [LEGION2\VANTAGE].[MfgSys803].[dbo].[zzWorkDates]
--WHERE [stone year] = '2019' and [bank holiday] = 'Y')
--THEN dateadd(day, 1, convert(varchar(20), duepick, 111)) ELSE convert(varchar(20), duepick, 111) END  as duepick,
    qty , 
    unitPrice , 
    totalCost ,
    location ,
    PartDesc
    
    
     from @t
    where duepick >= getdate()
    order by stockstaus desc 
     ";

    
 


    $stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}



$stmt->execute();
$data = $stmt->fetchall(PDO::FETCH_ASSOC);








echo "       
 <table class='table table-striped'>
 <thead>
<tr>
    
<th>stockStatus </th>

<th>casenumber </th>

<th>casetype </th>

<th> partnum </th>

<th> jobnum </th>

<th> datemoved </th>

<th> duepick </th>

<th> qty </th>

<th> unitprice </th>

<th> totalCost </th>

<th> location </th>

<th> PartDesc </th>

</tr>

</thead>
<tbody>";

foreach($data as $row){


echo "

    <tr>
    <td> ".$row['stockstaus']." </td>
    <td> ".$row['casenumber']." </td>
    <td> ".$row['casetype']." </td>
    <td> ".$row['partnum']." </td>
    <td> ".$row['jobnum']." </td>
    <td> ".$row['datemoved']." </td>
    <td> ".$row['duepick']." </td>
    <td> ".$row['qty']." </td>
    <td> ".$row['unitPrice']." </td>
    <td> ".$row['totalCost']." </td>
    <td> ".$row['location']." </td>
    <td> <teaxtarea>".$row['PartDesc']." </textarea></td>


    </tr>
   






";

}

echo "      </tbody>  </table>"

    ?>
</body>
</html>