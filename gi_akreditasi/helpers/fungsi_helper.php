<?php 

date_default_timezone_set('Asia/Jakarta');

function singkatan($string)
{
    $array = explode(" ", $string);
    $singkatan = "";
    foreach ($array as $value) {
        $singkatan .= substr($value, 0, 1);
    }
    return $singkatan;
}

function pilih_kata($string, $nomor)
{
    $value = explode(" ", $string);
    $value = $value[$nomor];
    return $value;
}

function batasi_kata($kalimat_lengkap, $jumlah_kata)
{
	$arr_str = explode(' ', $kalimat_lengkap);
	$arr_str = array_slice($arr_str, 0, $jumlah_kata);
	return implode(' ', $arr_str);
}

function sanitize($dirty){
	return htmlentities($dirty, ENT_QUOTES,"UTF-8");
}

function waktu_berlalu($datetime, $penuh = false) {
    date_default_timezone_set('Asia/Jakarta');
    $sekarang = new DateTime;
    $yangLalu = new DateTime($datetime);
    $diff = $sekarang->diff($yangLalu);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$penuh) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
}

function tanggal_indo($date)
{
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    $atur = strftime("%A, %d %B %Y", strtotime($date));
    return $atur;
}

function hanya_jam($date)
{
   setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
   // setlocale(LC_ALL, 'id-ID', 'id_ID');
   $atur = strftime("%H:%M", strtotime($date));
   return $atur;
}

function hanya_tanggal($date)
{
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    $atur = strftime("%d", strtotime($date));
    return $atur;
}

function bulan_indo($bulan)
{
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    $atur = strftime("%B", strtotime($bulan));
    return $atur;
}

function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function getThumbnailYt($url, $quality = '')
{
    $link       = $url;
    $video_id   = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID      = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id       = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];

    switch ($quality) {
        case 'LOW':
        $imageUrl = 'http://img.youtube.com/vi/'.$youtubeVideoID.'/sddefault.jpg';
        break;

        case 'MEDIUM':
        $imageUrl = 'http://img.youtube.com/vi/'.$youtubeVideoID.'/mqdefault.jpg';
        break;

        case 'HIGH':
        $imageUrl = 'http://img.youtube.com/vi/'.$youtubeVideoID.'/hqdefault.jpg';
        break;

        case 'MAXIMUM':
        $imageUrl = 'http://img.youtube.com/vi/'.$youtubeVideoID.'/maxresdefault.jpg';
        break;

        default:
        $imageUrl = 'http://img.youtube.com/vi/'.$youtubeVideoID.'/sddefault.jpg';
        break;
    }

    return $imageUrl;
}


function getYouTubeVideoId($pageVideUrl) {
    $link       = $pageVideUrl;
    $video_id   = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}

function getYoutubeEmbedUrl($url)
{
    $urlParts   = explode('/', $url);
    $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );

    return 'https://www.youtube.com/embed/' . $vidid[0] ;
}


?>