<?php

class Storage
{
	public static function upload($file, $filename)
	{
		$tmp_name = $_FILES[$file]['tmp_name'];
		$setDestination = self::setDestination($filename);
		$move = move_uploaded_file($tmp_name, $setDestination);
		return $move;
	}

	public static function get($file)
	{
		$filename = basename($_FILES[$file]['name']);
		$filename = rand() . '.' . self::getExtension($file);
		return $filename;
	}

	public static function getOriginal($file)
	{
		$filename = basename($_FILES[$file]['name']);
		return $filename;
	}

	public static function setDestination($filename)
	{
		$destination = __DIR__ . '/../resource/uploads/' . $filename;
		return $destination;
	}

	public static function getWidthResolution($file)
	{
		$widthResolution = getimagesize($_FILES[$file]['tmp_name']);
		return $widthResolution[0];
	}

	public static function getHeightResolution($file)
	{
		$heightResolution = getimagesize($_FILES[$file]['tmp_name']);
		return $heightResolution[1];
	}

	public static function getSizeResolution($file)
	{
		$sizeResolution = getimagesize($_FILES[$file]['tmp_name']);
		return $sizeResolution[3];
	}

	public static function getMime($file)
	{
		$mime = getimagesize($_FILES[$file]['tmp_name']);
		return $mime['mime'];
	}

	public static function getExtension($file)
	{
		$extension = self::getMime($file);
		$extension = explode('/', $extension);
		return $extension[1];
	}

	public static function getSize($file)
	{
		$size = $_FILES[$file]['size'];
		return $size;
	}	
}