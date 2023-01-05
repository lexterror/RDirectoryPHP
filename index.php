<meta charset="UTF-8">
<html>
	<script src="jquery-3.5.1.min.js"></script>
<script src="js/sorttable.js"></script>
<?php
//Report all errors except warnings. https://www.kryogenix.org/code/browser/sorttable/
// https://www.the-art-of-web.com/php/directory-list/ 
error_reporting(E_ALL ^ E_WARNING); 
$allitems = array();



 function get_all_directory_and_files($dir){
 
     global $allitems;
     $dh = new DirectoryIterator($dir);  
      $master = array();
     $currenitem = "";
  
     // Dirctary object 
     foreach ($dh as $item) {
         if (!$item->isDot()) {
            if ($item->isDir()) {
                get_all_directory_and_files("$dir/$item");
            } else {
            	$filesize = $item->getSize(); // bytes
							$filesize = round($filesize / 1024 / 1024, 1); // megabytes with 1 digit
                $ext = pathinfo($item, PATHINFO_EXTENSION);
                $mytype = getFileType($ext);
               
               $currenitem = "<tr>
               <td><a title='" . $item->getFilename() . "' target='blank' href='" . $dir . "/" . $item->getFilename() . "'>" . "<span class='nameit' style='color:deeppink;'>" . $item->getFilename() . "</span></a></td>
               <td><span style='color:black' title='" . $dir ."'> . $dir . </span></td>
               <td><span style='color:#999;'>" . date ('j-m-y H:i:s',$item->getMTime()) . "</span></td>
               <td><span style='color:dodgerblue;'>" . $mytype . "</span></td>
               <td><span style='color:orange;'>" . $filesize . " MB</span></td></tr>"; 
            //    echo "<br>"
            
                
                array_push($allitems, $currenitem);
      
                
            }
            
            
             
         }
         
      }
  
/*
echo '<ul id="spice">';
$arrlength = count($allitems);

for($x = 0; $x < $arrlength; $x++) {
  echo $allitems[$x];
}
echo '</ul>';*/
 
//  $master = array_merge($master, $allitems);

  
   } 
  # Call function 
  
 

    // finish table and return it
get_all_directory_and_files(".");
packard($allitems);



 function packard($array) {
    sort($array);
    echo "<table id='myTable' class='sortable' style='border-collapse:collapse;padding: 0 !important; margin: 0  auto !important;border-spacing: 0 !important;top: 50px;left: 0 !important; right: 0 !important;position: absolute;'>
    <caption>TiniShakes Website</caption>
    <thead>
    <tr>
    <th style='background:deeppink;'><span>File</span></th>
    <th style='background:#000;'><span>Directory</span></th>
    <th style='background:#888;'><span>Date</span></th>
    <th style='background:dodgerblue;'><span>Type</span></th>
    <th style='background:orange;'><span>Size</span></th></tr></thead><tbody>";
    foreach ($array as $key)
    echo $key;
    echo "</tbody></table>";
    
  
    
  }

function getFileType(string $url):string{
    $filename=explode('.',$url);
    $extension=end($filename);

    switch($extension){
        case 'pdf':
            $type=$extension;
            break;
        case 'docx':
        case 'odt':
        case 'doc':
        case 'rtf':
            $type='word';
            break;
        case 'txt':
            $type="text";
            break;
        case 'xls':
        case 'xlsx':
            $type='excel';
            break;
        case 'mp3':
        case 'ogg':
        case 'wav':
            $type='audio';
            break;
        case 'mp4':
        case 'mov':
            $type='video';
            break;
        case 'zip':
        case '7z':
        case 'rar':
        case 'tar':
        case 'bz2':
            $type='archive';
            break;
        case 'php':
            $type='php';
            break;
        case 'xml':
            $type='xml';
            break;
        case 'jpg':
        case 'jpeg':
        case 'svg':
        case 'png':
        case 'svgz':
        case 'gif':
        case 'ico':
        case 'hdr':
            $type='image';
            break;
        case 'gltf':
            $type='3D Object';
            break;
        case 'md':
        	  $type='markdown';
        	  break;
        case 'js':
        	  $type='javascript';
        	  break;
        case 'css':
        	  $type="stylesheet";
        	  break;
        case 'html':
        		$type="html";
        		break;
        case 'woff':
        case 'woff2':
        case 'eot':
        case 'ttf':
        case 'TTF':
        case 'otf':
        		$type="font";
        		break;
        case 'json':
        	  $type="json";
        	  break;
        case 'sha512':
        		$type="hash";
            break;
        default:
            $type='alt';
    }

    return $type;
}
 
 
 
 
 
 
 
 
 
  ?>

  <body onload="">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="live search" style="top:10px;background:#fff;color:#000;right:0px;left:0;height:32px;margin-bottom:10px;position:fixed;margin:0 auto;border:5px solid dodgerblue;border-radius:10px;text-align:center;width:100%;height:32px;"></input>

</body>
</html>
<style>
* {
  padding: 0 !important;
  margin: 0 !important;
}
  @font-face {
  font-family: 'pragm';
  src: url('fonts/ArchivoSemiCondensed-Medium.eot'); /* IE9 Compat Modes */
  src: url('fonts/ArchivoSemiCondensed-Medium.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('fonts/ArchivoSemiCondensed-Medium.woff2') format('woff2'), /* Super Modern Browsers */
  url('fonts/ArchivoSemiCondensed-Medium.woff') format('woff'), /* Pretty Modern Browsers */
  url('fonts/ArchivoSemiCondensed-Medium.ttf')  format('truetype'); /* Safari, Android, iOS */
  font-size: 100%;
  }
  
table {
  table-layout: fixed;
  width: 1036px; 
}

table th {
	color: #fff;
  max-width: 200px !important;
  width: 200px !important;
  min-width: 200px !important;

}

.mycurs {
	
	cursor: pointer;
	
}

tbody:before {
    content:"@";
    display:block;
    line-height:10px;
    text-indent:-99999px;
}
body, html {

}

table td, th {
    min-width: 200px !important;
    width: 200px !important;
    max-width: 200px !important;
    border-left: solid 1px black;
    white-space: nowrap;
    overflow: hidden;
    padding: 5px !important;
    text-overflow: ellipsis;
    font-family: pragm;
}



table td:last-child, th:last-child {
  border-right: solid 1px black;  
}



tr:hover {
  background: #ddd;
}
/*
li:nth-child(even) {background: #fff;}
li:nth-child(odd) {background: #fff;}

https://www.kryogenix.org/code/browser/sorttable
*/



</style>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];

    if (td) {

      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "inherit";
        tr[i].style.textAlign = "left";
        tr[i].style.paddingLeft = "0";
        tr[i].style.marginLeft = "0";
       
        
      } else {
        tr[i].style.display = "none";

        
      }
    }       
  }
}
</script>
<!--
<tr width='100%'>
    <th  width='20%' class='mycurs' style='background:deeppink;'><span class='first'>File</span></th>
    <th  width='20%' class='mycurs' style='background:#000;color:#fff;'><span class='directory'>Directory</span></th>
    <th  width='20%' class='mycurs' style='background:#888;'><span class='second'>Date</span></th>
    <th  width='20%' class='mycurs' style='background:dodgerblue;'><span class='third'>Type</span></th>
    <th  width='20%' class='mycurs' style='background:orange;'><span class='fourth'>Size</span></th></tr>

-->