<?php
require_once('config.php');
require_once('generate.php');

if (empty($_POST) || !isset($_POST['submit']))
{
    die();
}

//TODO Ask some users which characters they need and improve sanitization
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$titles = $_POST['titles'];
$descriptions = $_POST['description'];
$datasets = $_POST['dataset'];
$images = $_FILES['imagefile'];

$columncount = count($titles);
$rowcount = count($datasets);
$imagecount = count($images['tmp_name']);

//Validate Postvars
function validateArrays($array, $count, $type)
{//Validates the given arrays. Checks length and datatype. $array=array to validate; $count=number of expected values; $type=type to check(titles, descriptions or datasets)

    switch($type)
    {
        case 'titles':
            $minlength = TITLE_MINLENGTH;
            $maxlength = TITLE_MAXLENGTH;
            break;
        case 'descriptions':
            $minlength = DESC_MINLENGTH;
            $maxlength = DESC_MAXLENGTH;
            break;
        case 'datasets':
            $minlength = DATASET_MINLENGTH;
            $maxlength = DATASET_MAXLENGTH;
            break;
        default:
            return false;
    }

    //Check if array length is correct
    if(count($array) != $count)
    {
        return false;
    }

    //Check if submitted values are strings
    if(array_sum(array_map('is_string', $array)) != $count)
    {
        return false;
    }
    else
    {
        //Check if the submitted values match the length criteria
        $lengths = array_map('strlen', $array);

        if(max($lengths) > $maxlength || min($lengths) < $minlength)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}

//Validate if amount of datasets within defined range
if($rowcount > DATASET_MAXAMOUNT || $rowcount < DATASET_MINAMOUNT)
{
    die();
}

//Validate given titles
if(validateArrays($titles, $columncount, 'titles') == false)
{
    die();
}

//Validate given descriptions
if(validateArrays($descriptions, $rowcount, 'descriptions') == false)
{
    die();
}

//Validate given datasets
for($i = 0;$i < $rowcount;$i++)
{
    if(validateArrays($datasets[$i], $columncount, 'datasets') == false)
    {
        die();
    }
}

//Validate amount of uploaded images
if($rowcount != $imagecount)
{
    die();
}

function validateImage($path)
{//Checks if given image is valid; $path = Path of image file which should be checked

    if(!extension_loaded('imagick'))
    {
        echo 'Imagick is not installed';
        die();
    }

    try
    {
        $image = new Imagick($path);
        if($image->valid())
        {
            if(!in_array(strtolower($image->getImageFormat()), array('jpeg','jpg'), true))
            {
                return false;
            }
            return true;
        }
    }
    catch (exception $e)
    {
        return false;
    }
}

//Validate given images
for($i = 0;$i < $imagecount;$i++)
{
    if(validateImage($images['tmp_name'][$i]) == false)
    {
        die();
    }
}

$file = tmpfile();
$path = stream_get_meta_data($file)['uri'];

$path = createCards($titles, $descriptions, $datasets, $images, getcwd().'/layouts/layout_cdv.pdf');

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="cards.pdf"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));
readfile($path);