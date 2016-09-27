<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";

    $server = 'mysql:host=localhost:8889;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }

        function testGetCourseName()
        {
            //Arrange
            $test_course_name = "Intro to Computer Science";
            $test_course_number = "CSE101";
            $test_course = new Course($test_course_name, $test_course_number);

            //Act
            $result = $test_course->getCourseName();

            //Assert
            $this->assertEquals($test_course_name, $result);

        }

        function tesGetCourseNumber()
        {
            //Arrange
            $test_course_name = "Intro to Computer Science";
            $test_course_number = "CSE101";
            $test_course = new Course($test_course_name, $test_course_number);

            //Act
            $result = $test_course->getCourseName();

            //Assert
            $this->assertEquals($test_course_number, $result);

        }

        function testGetId()
        {
            //Arrange
            $test_course_name = "Intro to Computer Science";
            $test_course_number = "CSE101";
            $test_id = 1;
            $test_course = new Course($test_course_name, $test_course_number, $test_id);

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals($test_id, $result);

        }

        function testDeleteAll()
        {
            //Arrange
                    //Create test Course #1
            $test_course_name = "Intro to Computer Science";
            $test_course_number = "CSE101";
            $test_id = null;
            $test_course = new Course($test_course_name, $test_course_number, $test_id);
            $test_course->save();

                    //Create test Course #2
            $test_course_name2 = "Biology";
            $test_course_number2 = "BIO101";
            $test_id = null;
            $test_course = new Course($test_course_name2, $test_course_number2, $test_id);
            $test_course->save();

            //Act
            Course::deleteAll();
            $result = Course::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

    }

?>
