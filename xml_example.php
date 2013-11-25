<?php

$xmlString ='<?xml version="1.0"?>

<forum uri="http://myforum.org/index.php">

    <item id="1">
        <title>First Post!!!</title>
        <link>http://myforum.org/index.php/m/1</link>
        <description>hello I\'m fabio</description>
    </item>

    <item id="2">
        <title>Re: Second post!!!</title>
        <link>http://myforum.org/index.php/m/2</link>
        <description>2nd good message.</description>
    </item>
</forum>';
//$forum = simplexml_load_file('text.xml');
$forum = simplexml_load_string($xmlString);
/* some xpath EXAMPLES */   
/* catch all items in forum */
$result = $forum->xpath('/forum/item');
/* catch all links */
$result = $forum->xpath('//link');
/* search for "Re:" in title and returns the item's id */
$result = $forum->xpath('//item[contains(title, "Re:")]/@id');
/* catch > 10 length items and returns the item's title*/
$result = $forum->xpath('//item[string-length(description) > 10]/title');
/*
foreach($result as $item){
	echo "name:" . $item->getName() . '/content:'. $item->__toString() .'<br/>';
}
exit;
*/
$forum->item[1]->title['url']   = "http://goo.gl/";     /* this add a an attribute */
$forum->item[0]->foo            = "newnode";            /* this add content */
$forum->item[0]->foo['attrib']  = 10;                   /* this add a another value */
$forum->addChild('element_name', 'value');              /* this is a new element /*

 /* delete value */
unset($forum->item[0]);

header('Content-Type:text/xml');
// XML rendering
echo $forum->asXML();
?>
