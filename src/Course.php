<?php

    Class Course
    {
        private $name;
        private $course_number;
        private $id;

        function __construct($input_name, $input_course_number, $course_id = null)
        {
            $this->name = $input_name;
            $this->course_number = $input_course_number;
            $this->id = $course_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setCourseName($input_course_name)
        {
            $this->name = (string) $course_name;
        }

        function getCourseName()
        {
            return $this->name;
        }

        function setCourseNumber($input_course_number)
        {
            $this->course_number = (string) strtoupper($input_course_number);
        }

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (course_name, course_number) VALUES ('{$this->getCourseName()}', '{$this->getCourseNumber()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = [];
            foreach($returned_courses as $course)
            {
                $name = $course['course_name'];
                $number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($name, $number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }

    }



?>
