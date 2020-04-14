<?php
session_start();

header('content-type: image/png');

$image = imagecreatetruecolor( 100, 30 );

$bgcolor = imagecolorallocate( $image, 255, 255, 255 );
imagefill( $image, 0, 0, $bgcolor );

// 生成随机验证码 （数字）
/*
for ( $i = 0; $i < 3; $i++ ) {
	$fontsize = 6;
	$textcolor = imagecolorallocate( $image, rand(0, 120), rand(0, 120), rand(0, 120) );

	$x = ( $i * 100 / 4 ) + rand( 5, 10 );
	$y = rand( 1, 10 );
	$content = rand( 0, 9 );

	imagestring( $image, $fontsize, $x, $y, $content, $textcolor );
}
*/

$captcha_code = '';

// 生成随机验证码 （数字与字母混合）
for ( $i = 0; $i < 4; $i++ ) {
	$fontsize = 10;
	$textcolor = imagecolorallocate( $image, rand(0, 120), rand(0, 120), rand(0, 120) );

	$x = ( $i * 100 / 4 ) + rand( 5, 10 );
	$y = rand( 1, 10 );

	$data = 'abcdefghjkmnprstuvwxy345678';
	$content = substr($data, rand(0, strlen($data)-1), 1);
	// 拼接验证码
	$captcha_code .= $content;

	imagestring( $image, $fontsize, $x, $y, $content, $textcolor );
}

$_SESSION['authcode'] = $captcha_code;

// 生成 干扰点
for ( $i = 0; $i < 200; $i++ ) {
	$pointcolor = imagecolorallocate( $image, rand(60, 250), rand(60, 250), rand(60, 250) );

	imagesetpixel( $image, rand(1, 99), rand(1, 29), $pointcolor );
}
// 生成 干扰线
for ( $i = 0; $i < 3; $i++ ) {
	$linecolor = imagecolorallocate( $image, rand(80, 220), rand(80, 220), rand(80, 220) );

	imageline( $image, rand(1, 99), rand(1, 29), rand(1, 99), rand(1, 29), $linecolor );
}
// 图片格式
imagepng( $image );
// 销毁资源
imagedestroy( $image );
