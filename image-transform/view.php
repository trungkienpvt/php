<?php
/****************************************************************************
* view.php - imageTransform.php v 1.3
*
* v 1.3
*
* This scrit generate online transformations with images.
*
* Online image resize:
*
<img src="view.php?image=car.jpg&amp;mode=resize&amp;size=200x250" alt="My reduced car image" />
*
* Online image crop:
*
<img src="view.php?image=car.jpg&amp;mode=crop&amp;size=200x200" alt="My crop car image" />
*
* Online image rotation:
*
<img src="view.php?image=car.jpg&amp;mode=rotate&amp;degrees=180" alt="My rotated car image" />
*
* Online vertical flip:
*
<img src="view.php?image=car.jpg&amp;mode=flip" alt="My vertical flipped car image" />
*
* Online horizontal flop:
*
<img src="view.php?image=car.jpg&amp;mode=flop" alt="My horizontal flopped car image" />
*
* Online vertical and horizontal flipflop:
*
<img src="view.php?image=car.jpg&amp;mode=flipflop" alt="My flipflop car image" />
*
* Online grayscale image:
*
<img src="view.php?image=car.jpg&amp;mode=gray" alt="My grayscale car image" />
*

Copyright (C) 2008 Lito <lito@eordes.com>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

SEE HERE FOR MORE ==>> http://www.gnu.org/copyleft/gpl.html
*******************************************************************************/

include ('imageTransform.php');

switch ($_GET['mode']) {
	case 'rotate':
		$imageTransform->view($_GET['mode'], $_GET['image'], $_GET['degrees'], true);
		break;
	case 'resize':
	case 'crop':
		$imageTransform->view($_GET['mode'], $_GET['image'], $_GET['size'], true);
		break;
	case 'gray':
	case 'flip':
	case 'flop':
	case 'flipflop':
		$imageTransform->view($_GET['mode'], $_GET['image'], '', true);
		break;
}
?>
