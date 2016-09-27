<?php

    Class Student
    {

        private $name;
        private $date;
        private $id;

        function __construct($input_name, $input_enrollment_date, $student_id = null)
        {
            $this->name = $input_name;
            $this->date = $input_enrollment_date;
            $this->id = $student_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setStudentName($student_name)
        {
            $this->name = (string) $student_name;
        }

        function getStudentName()
        {
            return $this->name;
        }

        function setDate($input_enrollment_date)
        {
            $this->date = (string) $input_enrollment_date;
        }

        function getDate()
        {
            return $this->date;
        }

        function save()
        {
            
        }
    }

?>
