<?php

class Storage
{
	/**
	* Handle file upload
	*
	* @param $file name
	* @param $filename name with extension
	*/
	public static function upload($file, $filename)
	{
		$tmp_name = $_FILES[$file]['tmp_name'];
		$setDestination = self::setDestination($filename);
		$move = move_uploaded_file($tmp_name, $setDestination);
		return $move;
	}

	/**
	* Handle get file upload
	*
	* @param $file name
	* @return random filename with extension
	*/
	public static function get($file)
	{
		$filename = basename($_FILES[$file]['name']);
		$filename = rand() . '.' . self::getExtension($file);
		return $filename;
	}

	/**
	* Handle get file upload
	*
	* @param $file name
	* @return original filename with extension
	*/
	public static function getOriginal($file)
	{
		$filename = basename($_FILES[$file]['name']);
		return $filename;
	}

	/**
	* Set destination
	*
	* @param $filename name with extension
	* @return filename in directory
	*/
	public static function setDestination($filename)
	{
		$destination = BASE_URL . 'app/resources/uploads/' . $filename;
		return $destination;
	}

	/**
	* Handle get file with resolution
	*
	* @param $file name
	* @return all resolution
	*/
	public static function getWidthResolution($file)
	{
		$widthResolution = getimagesize($_FILES[$file]['tmp_name']);
		return $widthResolution[0];
	}

	/**
	* Handle get height resolution
	*
	* @param $file name
	* @return height resolution
	*/
	public static function getHeightResolution($file)
	{
		$heightResolution = getimagesize($_FILES[$file]['tmp_name']);
		return $heightResolution[1];
	}

	/**
	* Handle get size resolution
	*
	* @param $file name
	* @return size resolution
	*/
	public static function getSizeResolution($file)
	{
		$sizeResolution = getimagesize($_FILES[$file]['tmp_name']);
		return $sizeResolution[3];
	}

	/**
	* Handle get mime
	*
	* @param $file name
	* @return mime
	*/
	public static function getMime($file)
	{
		$mime = getimagesize($_FILES[$file]['tmp_name']);
		return $mime['mime'];
	}

	/**
	* Handle get extension
	*
	* @param $file name
	* @return extension
	*/
	public static function getExtension($file)
	{
		$extension = self::getMime($file);
		$extension = explode('/', $extension);
		return $extension[1];
	}

	/**
	* Handle get size
	*
	* @param $file name
	* @return size
	*/
	public static function getSize($file)
	{
		$size = $_FILES[$file]['size'];
		return $size;
	}	
}