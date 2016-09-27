<?php

// function __construct($input_name, $input_course_number, $course_id = null)

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

        // function testGetId()
        // {
        //     //Arrange
        //
        //
        //     //Act
        //
        //
        //     //Assert
        //
        //
        // }

        // function testDeleteAll()
        // {
        //     //Arrange
        //
        //
        //     //Act
        //
        //
        //     //Assert
        //
        //
        // }

    }

?>
