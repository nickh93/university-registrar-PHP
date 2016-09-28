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
            $this->assertEquals($test_id, $result);
        }


        function testSave()
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

        function testDeleteAll()
        {
            //Arrange
                    // Create test Student #1
            $test_name_one = "Linda Ronstandt";
            $test_date_one = "2016-12-12";
            $test_id = null;
            $test_student_one = new Student($test_name_one, $test_date_one);
            $test_student_one->save();
                    // Create test Student #1
            $test_name_two = "Pablo Picasso";
            $test_date_two = "2016-11-01";
            $test_id = null;
            $test_student_two = new Student($test_name_two, $test_date_two);
            $test_student_two->save();

            //Act
            Student::deleteAll();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            //Arrange
            $name = "Sam";
            $enrollment_date = "2008-10-23";
            $name2 = "Lisa";
            $enrollment_date2 = "2017-08-23";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();
            //Act
            $result = Student::find($test_student->getId());
            //Assert
            $this->assertEquals($test_student, $result);

        }

    }

?>
