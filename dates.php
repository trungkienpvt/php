1. Time with type format datetime
- add value to database with the following code 
	date("Y-m-d H:i:s");
- get value from database with the following code
	date("d/m/Y", strtotime($time_value));

/#############-function convert string to true encode-##############
public function convert($string)
{
    $detect = mb_detect_encoding($string,"UTF-8, ISO-8859-1, GBK");
    return ($detect == 'UTF-8' ? $string : mb_convert_encoding($string, "HTML-ENTITIES", "ISO-8859-1"));
}   



//format date value in mysql
 DATE_FORMAT(date,format)

//compare datetime
TO_DAYS(expire_date)>To_DAYS(NOW())
//Set default timezone
-function date_default_timezone_set ( string $timezone_identifier )
- Link to get timezone_identifier: http://www.php.net/manual/en/timezones.php

//computed distance between the 2 days by php
$date1 = new DateTime("2012-03-24");
$date2 = new DateTime("2012-03-26");
$interval = $date1->diff($date2);

//computed distance between the 2 days by sql
mysql> SELECT DATEDIFF('2007-12-31 23:59:59','2007-12-30');
        -> 1
