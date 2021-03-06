<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Registry
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM . '/joomla/registry/format.php';

/**
 * Test class for JRegistryFormatPHP.
 * Generated by PHPUnit on 2009-10-27 at 15:13:25.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Registry
 * @since       11.1
 */
class JRegistryFormatPHPTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test the JRegistryFormatPHP::objectToString method.
	 *
	 * @return void
	 */
	function testObjectToString()
	{
		$class = JRegistryFormat::getInstance('PHP');
		$options = array('class' => 'myClass');
		$object = new stdClass;
		$object->foo = 'bar';
		$object->quoted = '"stringwithquotes"';
		$object->booleantrue = true;
		$object->booleanfalse = false;
		$object->numericint = 42;
		$object->numericfloat = 3.1415;

		// The PHP registry format does not support nested objects
		$object->section = new stdClass;
		$object->section->key = 'value';
		$object->array = array('nestedarray' => array('test1' => 'value1'));

		$string = "<?php\n" .
			"class myClass {\n" .
			"\tpublic \$foo = 'bar';\n" .
			"\tpublic \$quoted = '\"stringwithquotes\"';\n" .
			"\tpublic \$booleantrue = '1';\n" .
			"\tpublic \$booleanfalse = '';\n" .
			"\tpublic \$numericint = '42';\n" .
			"\tpublic \$numericfloat = '3.1415';\n" .
			"\tpublic \$section = array(\"key\" => \"value\");\n" .
			"\tpublic \$array = array(\"nestedarray\" => array(\"test1\" => \"value1\"));\n" .
			"}\n?>";
		$this->assertThat(
			$class->objectToString($object, $options),
			$this->equalTo($string)
		);
	}

	/**
	 * Test the JRegistryFormatPHP::stringToObject method.
	 *
	 * @return void
	 */
	public function testStringToObject()
	{
		$class = JRegistryFormat::getInstance('PHP');

		// This method is not implemented in the class. The test is to achieve 100% code coverage
		$this->assertTrue($class->stringToObject(''));
	}
}
