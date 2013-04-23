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
