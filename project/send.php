<?php
$send=mail('sickjesus@gmail.com','Mon XX','SDSD aas','From: example@example.com');

if ($send) :
echo "mail sent";
else:
echo "not sent";
endif;
?>