//manipulating string
//remove tags html
$a = strip_tags($input);
$b = strip_tags($input, "<strong><em>");
//deny sql injection 
mysql_escape_string($value);
//convert special char to html char
htmlspecialchars()
