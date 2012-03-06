<?php
# USAGE:
# php makepdf.php NICK LINE2 QR PIC PDF
# EXAMPLE:
# php makepdf.php rami rami@jabber.ccc.de http://www.raphaelmichel.de file:///home/raphael/Bilder/facesquare.jpg output.pdf

function pdf_make($nick, $line2, $qr, $pic, $output){
	$svg = file_get_contents('../templates/template.svg');
	$svg = str_replace("_NICK_", $nick, $svg);
	$svg = str_replace("_LINE2_", $line2, $svg);
	$svg = str_replace("_QR_", urlencode($qr), $svg);
	$svg = str_replace("_PIC_", $pic, $svg);
	$tmp = tempnam('/tmp', 'SVG');
	$tmpfile = fopen($tmp, 'w');
	fwrite($tmpfile, $svg);
	fclose($tmpfile);
	shell_exec('rsvg-convert -f pdf -o '.escapeshellarg($output).' '.$tmp);
}       
pdf_make($argv[1], $argv[2], $argv[3], $argv[4], $argv[5]);

