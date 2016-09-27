<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";

    $server = "mysql:host=localhost:8889;dbname=registrar_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }

        function testGetStudentName()
        {
            //Arrange
            $test_name = "Linda Ronstandt";
            $test_date = "2016-12-12";
            $test_student = new Student($test_name, $test_date);

            //Act
            $result = $test_student->getStudentName();

            //Assert
            $this->assertEquals($test_name, $result);

        }

        function testGetDate()
        {
            //Arrange
            $test_name = "Linda Ronstandt";
            $test_date = "2016-12-12";
            $test_student = new Student($test_name, $test_date);

            //Act
            $result = $test_student->getDate();

            //Assert
            $this->assertEquals($test_date, $result);

        }

        function testGetId()
        {
            //Arrange
            $test_name = "Linda Ronstandt";
            $test_date = "2016-12-12";
            $test_id = 1;
            $test_student = new Student($test_name, $test_date, $test_id);

            //Act
            $result = $test_student->getId();

            //Assert
            $this->assertEquals(1, $result);
        }


        function testsave()
        {
            //Arrange
            $test_name = "Linda Ronstandt";
            $test_date = "2016-12-12";
            $test_id = null;
            $test_student = new Student($test_name, $test_date, $test_id);

            //Act
            $test_student->save();

            //Assert
            $result = Student::getAll();
            $this->assertEquals($test_student, $result[0]);
        }



    }

?>
