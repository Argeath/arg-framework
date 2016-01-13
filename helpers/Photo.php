<?php
namespace Helpers;

class Photo
{
    public static function createThumbnail( $source, $newPath )
    {
        $system = explode( '.', $source );
        $jpg = false;
        if ( preg_match( '/jpg|jpeg/', $system[1] ) ) {
            $srcImg = imagecreatefromjpeg( $source );
            $jpg = true;
        } elseif ( preg_match( '/png/', $system[1] ) )
            $srcImg = imagecreatefrompng( $source );
        else
            return;

        list( $width, $height ) = getimagesize( $source );
        $newWidth = 200;
        $newHeight = 125;

        $thumb = imagecreatetruecolor( $newWidth, $newHeight );

        imagecopyresampled( $thumb, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height );

        imagejpeg( $thumb, $newPath, 90 );
        imagedestroy( $thumb );
        imagedestroy( $srcImg );
    }

    public static function addWaterMarkText( $source, $newPath, $text )
    {
        $system = explode( '.', $source );
        $jpg = false;
        if ( preg_match( '/jpg|jpeg/', $system[1] ) ) {
            $srcImg = imagecreatefromjpeg( $source );
            $jpg = true;
        } elseif ( preg_match( '/png/', $system[1] ) )
            $srcImg = imagecreatefrompng( $source );
        else
            return;

        $black = imagecolorallocatealpha( $srcImg, 0, 0, 0, 30 );

        $x = 50;
        $y = 50;

        $font = 'assets/fonts/Ubuntu-B.ttf';
        $size = 30;
        putenv( 'GDFONTPATH=' . realpath( '.' ) );

        $textSize = imagettfbbox( $size, 0, $font, $text );

        $textWidth = $textSize[2] - $textSize[0];
        $textHeight = $textSize[1] - $textSize[7];

        imagefilledrectangle( $srcImg, $x - 15, $y - ($textHeight + 10), $x + $textWidth + 15, $y + 10, $black );
        imagettftext( $srcImg, $size, 0, $x, $y, 0xFFFFFF, $font, $text );

        imagejpeg( $srcImg, $newPath, 90 );

        imagedestroy( $srcImg );
    }
}