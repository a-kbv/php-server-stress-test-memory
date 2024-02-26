<?php
ini_set('memory_limit', '5G');
$mem_usage = memory_get_usage();
echo 'Memory usage before the loop: ' . round($mem_usage / 1024/ 1024) . 'MB'.PHP_EOL;
/* Get the memory limit in bytes. */
$mem_limit = get_memory_limit();
echo 'Memory limit: ' . round($mem_limit / 1048576) . 'MB'.PHP_EOL;
$array = "";
for ($i = 0; $i < 1000000000; $i++)
{
   $array .= $i;
   
   /* Check the memory usage every 100000 iterations. */
   if (($i % 1000000) == 0)
   {
     $mem_usage = memory_get_usage();
     echo 'Memory usage after iteration ' . $i . ': ' . round($mem_usage / 1024 / 1024, 2) . ' MB' . PHP_EOL;
     if ($mem_usage / $mem_limit > .8) { 
        echo 'Memory usage is over 80%, consider increasing memory limit or optimize the script'; 
        break; 
     }
   }
}
$mem_usage = memory_get_usage();
echo 'Memory usage after the loop: ' . round($mem_usage / 1024 /1024) . 'MB' .PHP_EOL;

/* Parse the memory_limit variable from the php.ini file. */
function get_memory_limit()
{
   $limit_string = ini_get('memory_limit');
   $unit = strtolower(mb_substr($limit_string, -1 ));
   $bytes = intval(mb_substr($limit_string, 0, -1), 10);
   
   switch ($unit)
   {
      case 'k':
         $bytes *= 1024;
         break 1;
      
      case 'm':
         $bytes *= 1048576;
         break 1;
      
      case 'g':
         $bytes *= 1073741824;
         break 1;
      
      default:
         break 1;
   }
   
   return $bytes;
}
