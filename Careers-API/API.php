<?php

$db = mysqli_connect('localhost', 'root', '', 'hawx');

$ch = curl_init(); //creates cURL resources here
$url = "https://app.clearcompany.com/api/v2/jobs/hawxpestcontrol/json/";

curl_setopt($ch, CURLOPT_URL, $url); //sets the cURL options and request API
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //allows to store the fetched data in a variable

$output = curl_exec($ch); //excecutes the cURL

if ($e = curl_error($ch)) { // throws if there is any error in api request
} else {
    $resp = json_decode($output, true);

    $truncate = "TRUNCATE TABLE `hawx`.`career`";
    $del = mysqli_query($db, $truncate);

    foreach ($resp as $response) {

        $job_id = $response['Id'];
        $Company_name = $response['CompanyName'];
        $Position_title = $response['PositionTitle'];
        $Office_name = $response['OfficeName'];
        $Address = $response['OfficeAddress'];
        $Address2 = $response['OfficeAddress2'];
        $Dept_name = $response['DepartmentName'];
        $Open_date = $response['OpenDate'];
        $Ref_number = $response['ReferenceNumber'];
        $Careers_url = $response['ApplyUrl'];
        $Apply_url = $response['LegacyCareersUrl'];
        $Company = $response['Company'];
        $Country_sub_name = $response['CountrySubdivisionName'];
        $City = $response['City'];
        $Postal_code = $response['PostalCode'];
        $Country_code = $response['CountryCode'];
        $Description = $response['Description'];
        $Descr = htmlspecialchars($Description);   //encodes the html tags of decsription here
        $created= date('Y-m-d H:i:s');
    
        $sql = "INSERT INTO `career`(`Job_Id`,`Company_name`, `Position_title`, `Office_name`, `office_address`,`office_address2`,`Dept_name`, `Open_date`, `Ref_number`, `Apply_url`, `Careers_url`,`Company`,`City`,`Country_sub_name`,`Postal_code`, `Country_code`,`Description`,`Created_at`)
                VALUES ('$job_id','$Company_name','$Position_title','$Office_name','$Address','$Address2','$Dept_name','$Open_date','$Ref_number','$Careers_url','$Apply_url','$Company','$City','$Country_sub_name','$Postal_code','$Country_code','$Descr','$created')";
        $sq = mysqli_query($db, $sql);
        
    }
    
    
}

curl_close($ch); //closes the cURL resource 

