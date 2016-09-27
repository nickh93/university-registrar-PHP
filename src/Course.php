<?php

    Class Course
    {
        private $name;
        private $course_number;
        private $id;

        function __construct($input_name, $input_course_number, $course_id = null)
        {
            $this->name = $input_name;
            $this->number = $input_course_number;
            $this->id = $course_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setCourseName($course_name)
        {
            $this->name = (string) strtoupper($course_name); //try this method
        }

        function getCourseName()
        {
            return $this->name;
        }

        function setCourseNumber($input_course_number)
        {
            $this->course_number = (string) $input_course_number;
        }


    }



?>
