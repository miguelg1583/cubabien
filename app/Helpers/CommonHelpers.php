<?php
/**
 * Created by PhpStorm.
 * User: meARC
 * Date: 4/11/2018
 * Time: 10:19 PM
 */

///**
// * Obtiene un arreglo de datos en el formato de las acciones del sistema
// * @param      $action      string Acción
// * @param      $datetime    string Fecha y Hora de ocurrencia
// * @param null $description string Descripción de la acción
// *
// * @return array Retorn aun arreglo de datos listos para insertar en la tabla ACTIONS
// */
//function getActionData($action, $datetime, $description = NULL) {
//    if ($datetime === null) {
//        $datetime = date('Y-m-d H:i:s');
//    }
//    $actionData = ['user_id' => session('id', 0),
//        'action' => $action,
//        'machine' => request()->getClientIp(),
//        'datetime' => $datetime,
//        'description' => $description];
//    return $actionData;
//}
use Spatie\TranslationLoader\LanguageLine;

/**
 * @param string $file
 * @return string
 */
function assets_file($file)
{
    return asset('/' . $file . APP_VERSION);
}

/**
 * @param string $file
 * @return string
 */
function assets_frontend($file)
{
    return asset('/frontend/' . $file . APP_VERSION);
}

/**
 * @param string $file
 * @return string
 */
function assets_backend($file)
{
    return asset('/backend/' . $file . APP_VERSION);
}

function getImageThumbnail($path, $width, $height, $type){
    return app('App\Http\Controllers\ImagenController')->getImageThumbnail($path, $width, $height, $type);
}

function guarda_trad($grupo,$id,$arrText)
{
    //            despues guardo la traduccion
    $arrKey = [];
    $arrVal = [];

    foreach ($arrText as $rtext) {
        $arrKey[] = $rtext['lengua'];
        $arrVal[] = $rtext['text'];
    }

    $ll = new LanguageLine();
    $ll->group = $grupo;
    $ll->key = 'id' . $id;
    $ll->text = array_combine($arrKey, $arrVal);
    $ll->save();
    //termino guardar la traduccion

    return $ll->group.".".$ll->key;
}



//function assets_img($imgfile) {
//    return asset('assets/images/' . $imgfile . JC_VERSION);
//}
//
//function start_width($string, $query) {
//    return 0 === strpos($string, $query);
//}
//
//function getImageThumbnail($image, $size) {
//    if (empty($image)) {
//        return $image;
//    }
//    $fp = fopen($image, 'rb');
//    $meta = stream_get_contents($fp);
//    $src = imagecreatefromstring($meta);
//    $width = imagesx($src);
//    $height = imagesy($src);
//    $aspect_ratio = $height / $width;
//    if ($width <= $size) {
//        $new_w = $width;
//        $new_h = $height;
//    } else {
//        $new_w = $size;
//        $new_h = abs($new_w * $aspect_ratio);
//    }
//    $clone = imagecreatetruecolor($new_w, $new_h);
//    imagecopyresized($clone, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
//    ob_start();
//    imagejpeg($clone, null, 100);
//    $result_image = ob_get_contents();
//
//    ob_end_clean();
//    imagedestroy($clone);
//    imagedestroy($src);
//    fclose($fp);
//    return $result_image;
//}
//
//function getDocument($doc) {
//    if (empty($doc)) {
//        return $doc;
//    }
//    $fp = fopen($doc, 'rb');
//    $result = stream_get_contents($fp);
//    fclose($fp);
//    return $result;
//}
//
//function formatDBDate($date) {
//    $split = mb_split('/', $date);
//    return $split[2] . '-' . $split[1] . '-' . $split[0];
//}
//
//function getElementName($element, $elementid) {
//    switch ($element) {
//        case ELEM_FE:
//            return 'Entidad Financiera';
//        case ELEM_SUB:
//            return DB::table('subsidiaries')->select(['name'])->where('id', $elementid)->first()->name;
//        case ELEM_USER:
//            return DB::selectOne('select CONCAT_WS(" ",names,lastnames) name from users where id=?', [$elementid])->name;
//        case ELEM_CUSTOMER:
//            return DB::selectOne('select CONCAT_WS(" ",names,lastnames) name from customers where id=?', [$elementid])->name;
//        default:
//            return '';
//    }
//}
//
//function bcround($number, $scale = 0) {
//    if ($scale < 0) $scale = 0;
//    $sign = '';
//    if (bccomp('0', $number, 64) === 1) $sign = '-';
//    $increment = $sign . '0.' . str_repeat('0', $scale) . '5';
//    $number = bcadd($number, $increment, $scale + 1);
//    return bcadd($number, '0', $scale);
//}