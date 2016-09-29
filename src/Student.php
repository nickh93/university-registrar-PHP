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

        function update($new_name, $new_date) {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}', date = '{$new_date}' WHERE id = {$this->getId()};");

            $this->setStudentName($new_name);
            $this->setDate($new_date);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE student_id = {$this->getId()};");
        }

        function addCourse($course)
        {
           $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$course->getId()}, {$this->getId()});");
        }

        function getCourses()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM students
            JOIN courses_students ON (courses_students.student_id = students.id)
            JOIN courses ON (courses.id = courses_students.course_id)
            WHERE students.id = {$this->getId()};");

            $courses = array();
            foreach ($returned_courses as $course)
            {
                $name = $course['course_name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
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
            }
            return $found_student;
        }

    }

?>
