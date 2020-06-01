<?php
/**
 * Fields - Slideshare plugin for Joomla
 *
 * @author Joomill (info@joomill-extensions.com)
 * @copyright Copyright (c) 2017 Joomill
 * @license GNU Public License
 * @link https://www.joomill-extensions.com/
 */

defined('_JEXEC') or die;

//add stylesheet for responsive container
$document = JFactory::getDocument();
$document->addStylesheet('plugins/fields/slideshare/tmpl/style.css');

//get parameters
$value = $field->value;
$width = $fieldParams->get('width','100%');
$height = $fieldParams->get('height','300px');

//116 Extra replace to ensure embed urls transformed to valid xhtml (&amp;) in WISIWYG editor will be handled correctly
$tidiedoriginal = str_replace("&amp;","&", $value);

//Explode embedded code into parts to be able to identify id of various lengths
$embedParts = explode("&", $tidiedoriginal);

//Make sure trailing ] is to be removed from new type embed url without &w=425, and still keep backward compatibility of older embeds
if(isset($embedParts[1])){
$embedtidyup = explode("]", $embedParts[1]);
}
//Isolate unique id by removing [slideshare id= and store in $cleaned_id
$cleaned_id = explode("=", $embedParts[0]);

//Unique id is same as isolated cleaned
if(isset($cleaned_id[1])){
$cleaned_id2 = $cleaned_id[1];
}
else {
$cleaned_id2 = $cleaned_id;
}

if ($value == '')
{
	return;
}
echo '<div align="left" class="responsive-container" id="ss_'. $cleaned_id2.'">
<iframe  style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" src="//www.slideshare.net/slideshow/embed_code/'. $cleaned_id2.'?width="'.$width.'" height="'.$height.'"  frameborder="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
</div>';