<?php
/**
 * @author Z0NK3X or Ardzz
 * @link https://fb.com/aardzz
 * @package MD5 Decryptor
 *
 * Thanks For Jim Geovedi's wordlist
 */
$green = "\e[1;92m";
$cyan = "\e[1;36m";
$normal = "\e[0m";
$blue = "\e[34m";
$green1 = "\e[0;92m";
$yellow = "\e[93m";
$red = "\e[91m";
 
function val_md5($md5 = '')
{
    if (empty($md5)) return false;
    return preg_match('/^[a-f0-9]{32}$/', $md5);
}
 
function banner()
{
    date_default_timezone_set("Asia/Jakarta");
    $green = "\e[1;92m";
    $cyan = "\e[1;36m";
    $normal = "\e[0m";
    $blue = "\e[1;34m";
    $green1 = "\e[0;92m";
    $yellow = "\e[93m";
    $red = "\e[1;91m";
    $banner = $cyan . "
_____                            ___________
|  ___|                          |_   _|  _  \
| |____  ___ __   ___  ___  ___    | | | | | |
|  __\ \/ / '_ \ / _ \/ __|/ _ \   | | | | | |
| |___>  <| |_) | (_) \__ \  __/  _| |_| |/ /
\____/_/\_\ .__/ \___/|___/\___|  \___/|___/  
          | |                                
          |_|                                
 
              " . $normal . $red . "Z0NK3X" . $normal . "
        [" . date("Y-m-d H:i:s") . "]      
 
     " . $yellow . "███╗   ███╗██████╗ ███████╗" . $normal . "
     " . $yellow . "████╗ ████║██╔══██╗██╔════╝" . $normal . "
     " . $yellow . "██╔████╔██║██║  ██║███████╗" . $normal . $red . " ╔╦╗╔═╗╔═╗╦═╗╦ ╦╔═╗╔╦╗╔═╗╦═╗
     " . $yellow . "██║╚██╔╝██║██║  ██║╚════██║" . $normal . $red . "  ║║║╣ ║  ╠╦╝╚╦╝╠═╝ ║ ║ ║╠╦╝
     " . $yellow . "██║ ╚═╝ ██║██████╔╝███████║" . $normal . $red . " ═╩╝╚═╝╚═╝╩╚═ ╩ ╩   ╩ ╚═╝╩╚═
     " . $yellow . "╚═╝     ╚═╝╚═════╝ ╚══════╝
\n" . $normal;
    echo $banner;
}
 
system("clear");
$wordlist = "list.txt";
banner();
 
if (!file_exists($wordlist)) {
    echo $red . " [!] File $wordlist isn't exist!\n" . $normal;
    exit();
}
 
echo " [*] Total Wordlist       : " . $cyan . count(file($wordlist)) . $normal . "\n";
$hash = readline(" [?] MD5 HASH             : ");
 
if (!val_md5($hash)) {
    echo $red . " [!] String isn't MD5!\n" . $normal;
    exit();
}
 
echo "\n";
echo " ------------------------------------------------------~\n";
echo " [1] MD5 Decrpytor Offline [" . $cyan . "BF METHOD" . $normal . "]\n";
echo " [2] MD5 Decrpytor Online\n";
echo " ------------------------------------------------------~\n\n";
$option = readline(" [?] Choose Your Option   : ");
echo "\n";
 
if ($option == 1) {
    echo " ------------------------------------------------------~\n";
    foreach(explode("\n", file_get_contents("wordlist.txt")) as $pass) {
 
        // echo " [*] Using Word [$pass]\n";
 
        if (md5($pass) == $hash) {
            echo $green1 . " [+] Found! $hash => " . $cyan . "$pass\n" . $normal;
            echo " ------------------------------------------------------~\n";
            exit();
        }
    }
 
    echo $red . " [!] NOT FOUND! $hash\n" . $normal;
    echo " ------------------------------------------------------~\n";
    exit();
}
elseif ($option == 2) {
    $json = json_decode(file_get_contents("https://api.zonkploit.com/md5-decrypt/" . $hash) , 1);
    if ($json["is_found"] == 1) {
        echo " ------------------------------------------------------~\n";
        echo $green1 . " [+] Found! $hash => " . $cyan . $json["result"] . $normal . "\n";
        echo " ------------------------------------------------------~\n";
    }
    else {
        echo " ------------------------------------------------------~\n";
        echo $red . " [-] Not found $hash\n" . $normal;
        echo " ------------------------------------------------------~\n";
    }
}
else {
    echo " ------------------------------------------------------~\n";
    echo $red . " [-] Invalid Option\n" . $normal;
    echo " ------------------------------------------------------~\n";
    exit();
}
 
?>