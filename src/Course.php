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
            $this->name = (string) $input_course_name;
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

        function update($new_name, $new_number)
         {
             $GLOBALS['DB']->exec("UPDATE courses SET course_name = '{$new_name}', course_number = '{$new_number}' WHERE id = {$this->getId()};");
             $this->setCourseName($new_name);
             $this->setCourseNumber($new_number);
         }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id ={$this->getId()};");
        }

        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
        }

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
            JOIN courses_students ON (courses_students.course_id = courses.id)
            JOIN students ON (students.id = courses_students.student_id)
            WHERE courses.id = {$this->getId()};");

            $students = array();
            foreach ($returned_students as $student)
            {
                $name = $student['name'];
                $enrollment_date = $student['date'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($students, $new_student);
            }
            return $students;
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

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach ($courses as $course)
            {
                $course_id = $course->getId();
                if ($course_id == $search_id)
                {
                    $found_course = $course;
                }
            }
            return $found_course;
        }

    }



?>
