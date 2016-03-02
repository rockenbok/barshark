<?PHP
require_once("fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('thebarshark.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('devin@iditall.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'mysql.thebarshark.com',
                      /*username*/'thebarsharkcom',
                      /*password*/'Salty2015!',
                      /*database name*/'thebarshark_com',
                      /*table name*/'barsharkusers');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>