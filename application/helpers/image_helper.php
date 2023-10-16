<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getImageExtension'))
{
    function getImageExtension($content = '')
    {
		if(empty($content)) {
			return '.jpg';
		}
		
		try {
			if ( base64_encode(base64_decode($content, true)) === $content){
				return '.jpg';
			} else if(strpos($content, ';base64') > 0){
				$splited = explode(';base64,', $content);
				if(count($splited) == 2) {
					$mime_splited = explode('/', $splited[0]);
					$ext = $mime_splited[1];
					if($ext == 'png') {
						return '.png';
					}
				}
			} else if(strpos($content, '<svg') > 0){
				return '.svg';
			}
			return '.jpg';
		} catch(Exception $e) {
			return '.jpg';
		}
    }   
}

function GetStringWidth($text, $font) {
    // Create a temporary instance of FPDF
    $pdf = new FPDF();
    $pdf->AddFont($font); // Add the font if not already added
    $pdf->SetFont($font, '', 12); // Set font and font size

    // Calculate and return the width of the text
    return $pdf->GetStringWidth($text);
}