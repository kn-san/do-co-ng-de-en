<?php
// set time zone
date_default_timezone_set("Asia/Tokyo");

// set default encoding
if (extension_loaded('mbstring')) {
  mb_internal_encoding('UTF-8');
}

//----------
// 関数定義
//----------

// HTMLエスケープ
function e($html) {
  return htmlspecialchars($html, ENT_QUOTES);
}

// cookieの中身を表示用の文字列に変換して返す
function showCookies($hash) {
  $html = '';
  foreach($hash as $key => $val) {
    if ($html != '') $html .= ', ';
    $html .= $key . '=' . $val;
  }
  return $html;
}

/**
 * User-Agent文字列からOSを判定してOS名を返す
 * ref. http://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
 */
function getOS($user_agent) { 
  $os_platform = "Unknown OS Platform";
  $os_array = array(
    '/windows nt 10/i'     =>  'Windows 10',
    '/windows nt 6.3/i'     =>  'Windows 8.1',
    '/windows nt 6.2/i'     =>  'Windows 8',
    '/windows nt 6.1/i'     =>  'Windows 7',
    '/windows nt 6.0/i'     =>  'Windows Vista',
    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
    '/windows nt 5.1/i'     =>  'Windows XP',
    '/windows xp/i'         =>  'Windows XP',
    '/windows nt 5.0/i'     =>  'Windows 2000',
    '/windows me/i'         =>  'Windows ME',
    '/win98/i'              =>  'Windows 98',
    '/win95/i'              =>  'Windows 95',
    '/win16/i'              =>  'Windows 3.11',
    '/macintosh|mac os x/i' =>  'Mac OS X',
    '/mac_powerpc/i'        =>  'Mac OS 9',
    '/linux/i'              =>  'Linux',
    '/ubuntu/i'             =>  'Ubuntu',
    '/iphone/i'             =>  'iPhone',
    '/ipod/i'               =>  'iPod',
    '/ipad/i'               =>  'iPad',
    '/android/i'            =>  'Android',
    '/blackberry/i'         =>  'BlackBerry',
    '/webos/i'              =>  'Mobile'
  );
  foreach ($os_array as $regex => $value) { 
    if (preg_match($regex, $user_agent)) {
      $os_platform    =   $value;
    }
  }   
  return $os_platform;
}
/**
 * User-Agent文字列からブラウザを判定してブラウザ名を返す
 * ref. http://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
 */
function getBrowser($user_agent) {
  $browser = "Unknown Browser";
  $browser_array  =   array(
    '/msie/i'       =>  'Internet Explorer',
    '/firefox/i'    =>  'Firefox',
    '/safari/i'     =>  'Safari',
    '/chrome/i'     =>  'Chrome',
    '/edge/i'       =>  'Edge',
    '/opera/i'      =>  'Opera',
    '/netscape/i'   =>  'Netscape',
    '/maxthon/i'    =>  'Maxthon',
    '/konqueror/i'  =>  'Konqueror',
    '/mobile/i'     =>  'Handheld Browser'
  );
  foreach ($browser_array as $regex => $value) { 
    if (preg_match($regex, $user_agent)) {
      $browser    =   $value;
    }
  }
  return $browser;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Info.</title>
  <style type="text/css">
th {
  border: 1px solid green; padding: 4px; width: 300px;
}
td {
  border: 1px solid green; padding: 4px;
}
  </style>
</head>
<body>
<img src="NGINX-Plus-horiz-black-type-xxx01.png" width="150px"><br>

  Your Info.

  <table>
    <tboby>
    <tr>
      <th>リクエスト時刻</th>
      <td><?php echo e(date("Y年m月d日 H時i分s秒", $_SERVER['REQUEST_TIME'])); ?></td>
    </tr>
    <tr>
      <th>Webサーバーのホスト名</th>
      <td><?php echo e($_SERVER['SERVER_NAME']); ?></td>
    </tr>
    <tr>
      <th>リモートのIPアドレス</th>
      <td>
        <?php echo e($_SERVER['REMOTE_ADDR']); ?><br>
      </td>
    </tr>
    <tr>
      <th>リモートのホスト名<br></th>
      <td>
        <?php echo e(gethostbyaddr($_SERVER['REMOTE_ADDR'])); ?><br>
      </td>
    </tr>
    </tboby>
  </table>

  HTTP Request Header

  <table>
    <tboby>
    <tr>
      <th>Method</th>
      <td><?php echo e($_SERVER['REQUEST_METHOD']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">Request-URI</th>
      <td>
        <?php echo e($_SERVER['REQUEST_URI']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">HTTP-Version</th>
      <td>
        <?php echo e($_SERVER['SERVER_PROTOCOL']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">Host</th>
      <td>
        <?php echo e($_SERVER['HTTP_HOST']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">User-Agent</th>
      <td>
        <?php echo e($_SERVER['HTTP_USER_AGENT']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">Accept-Language</th>
      <td>
        <?php echo e($_SERVER['HTTP_ACCEPT_LANGUAGE']); ?><br>
      </td>
    </tr>
    <tr>

    <tr>
      <th style="width: 300px;">Accept</th>
      <td>
        <?php echo e($_SERVER['HTTP_ACCEPT']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">Accept-Encoding</th>
      <td>
        <?php echo e($_SERVER['HTTP_ACCEPT_ENCODING']); ?><br>
      </td>
    </tr>
    <tr>
      <th style="width: 300px;">Cookie</th>
      <td><?php echo e(showCookies($_COOKIE)); ?></td>
    </tr>
    </tboby>
  </table>
  </div>

</body>
</html>

