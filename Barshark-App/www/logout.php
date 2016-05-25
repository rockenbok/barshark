<?PHP
require_once("include/membersite_config.php");

$fgmembersite->LogOut();

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit();
}

?>