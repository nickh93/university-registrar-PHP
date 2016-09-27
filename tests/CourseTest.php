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


            //Act


            //Assert


        }

        // function tesGetCourseNumber()
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
