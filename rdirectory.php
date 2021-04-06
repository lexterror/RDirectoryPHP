<meta charset="UTF-8">
<html>
	<script src="jquery-3.5.1.min.js"></script>
<script src="sorttable.js"></script>
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
            	$filesize = filesize($item); // bytes
							$filesize = round($filesize / 1024 / 1024, 1); // megabytes with 1 digit
                $ext = pathinfo($item, PATHINFO_EXTENSION);
                $mytype = getFileType($ext);
               $currenitem = "<tr><td><li class='random'><a target='blank' href='" . $dir . "/" . $item->getFilename() . "'>" . "<span class='first'><span style='color:#888'>" . $dir . "</span>" . "/" . "<span class='nameit' style='color:deeppink;'>" . $item->getFilename() . "</a></span></span></td><td><span class='second'>" . "<span style='color:#999;'>" . date ('F d Y H:i:s.',filemtime($item)) . "</span></span></td><td><span class='third'><span style='color:dodgerblue;'>" . $mytype . "</span></span></td><td><span class='fourth'>" . "<span style='color:orange;'>" . $filesize . "MB</style></span></span></li></td></tr>"; 
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
    echo "<table id='myTable' class='sortable'><tr style='background:deeppink;color:#fff;'><td class='mycurs' style='width:600px;'><span class='first'>Path | File</span></td><td  class='mycurs' style='width:200px'><span class='second'>Date</span></td><td  class='mycurs' style='100px'><span class='third'>Type</span></td><td  class='mycurs' style='50px;'><span class='fourth'>Size</span></td></tr>";
    foreach ($array as $key)
    echo $key;
    echo "</table>";
    
  
    
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
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="live search" style="top:10px;background:#fff;color:#000;right:0px;left:0;height:32px;margin-bottom:10px;position:fixed;margin:0 auto;border:5px solid dodgerblue;border-radius:10px;text-align:center;width:300px;height:32px;"></input>
<ul>

</ul>

</body>
</html>
<style>
  @font-face {
  font-family: 'pragm';
  src: url('ArchivoSemiCondensed-Medium.eot'); /* IE9 Compat Modes */
  src: url('ArchivoSemiCondensed-Medium.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('ArchivoSemiCondensed-Medium.woff2') format('woff2'), /* Super Modern Browsers */
  url('ArchivoSemiCondensed-Medium.woff') format('woff'), /* Pretty Modern Browsers */
  url('ArchivoSemiCondensed-Medium.ttf')  format('truetype'); /* Safari, Android, iOS */
  font-size: 100%;
  }
  
  #spice {
  
  }
tr:nth-child(even) {background: #fff}
tr:nth-child(odd) {background: #FFF}
* {
  
}
.mycurs {
	
	cursor: pointer;
	
}
body {
	min-width:1000px;
	padding:0px;
	margin:0 auto;
	left:0;
	right:0;
	display:block;
	width:1000px;
	font-family:pragm;
}
span {
		font-size: 16px;
	line-height:24px;
	font-family:pragm;
}
table {

}
.over {
	white-space: nowrap;
	text-overflow:ellipsis;
	overflow:hidden;
	width:64px;
}
ul {
	width: 1000px;
	white-space: nowrap;
	margin:0;
	padding:0;
	background: #fff;
	margin-top:48px;
}

li {
	display: block;
	list-style-type: none;
	text-decoration: none;
}

tr:hover {
  background: #ddd;
}
/*
li:nth-child(even) {background: #fff;}
li:nth-child(odd) {background: #fff;}

https://www.kryogenix.org/code/browser/sorttable
*/
table {
  table-layout: fixed ;
  width: 100%;
  background:#fff;
}
td {
  padding:5px;
}
.first {
	display:inline-block;
	width: 600px !important;
white-space: nowrap;
	text-overflow:ellipsis;
	overflow:hidden;
}
.second {
  display:inline-block;
	width: 180px !important;	
white-space: nowrap;
	text-overflow:ellipsis;
	overflow:hidden;	
}
.third {
	display:inline-block;
	width: 120px !important;
	white-space: nowrap;
	text-overflow:ellipsis;
	overflow:hidden;
}
.fourth {
  	display:inline-block;
white-space: nowrap;
	text-overflow:ellipsis;
	overflow:hidden;
	width: 45px !important;
}

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
        tr[i].style.display = "inline-block";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>