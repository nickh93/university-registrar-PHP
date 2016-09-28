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
            $GLOBALS['DB']->exec("INSERT INTO students (name, date) VALUES ('{$this->getStudentName()}', '{$this->getDate()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = [];
            foreach($returned_students as $student)
            {
                $name = $student['name'];
                $date = $student['date'];
                $id = $student['id'];
                $new_student = new Student($name, $date, $id);
                array_push($students, $new_student);
            }
            return $students;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }
        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach ($students as $student)
            {
                $student_id = $student->getId();
                if ($student_id == $search_id)
                {
                    $found_student = $student;
                }
                return $found_student;
            }
        }
    }

?>
