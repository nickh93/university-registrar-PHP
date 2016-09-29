<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Course.php";

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=registrar";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    $app->get("/", function() use ($app) {
        return $app["twig"]->render("index.html.twig");
    });

    /*----------Courses Logic-----------*/

    $app->get("/courses", function() use ($app) {
        return $app["twig"]->render("courses.html.twig", array("courses" => Course::getAll()));
    });

    $app->post("/courses", function() use ($app) {
        $course_name = $_POST["c_name"];
        $course_number = $_POST["c_number"];
        $new_course = new Course($course_name, $course_number);
        $new_course->save();
        return $app["twig"]->render("courses.html.twig", array("courses" => Course::getAll()));
    });

    $app->post("/delete_courses", function() use ($app) {
        Course::deleteAll();
        return $app["twig"]->render("courses.html.twig", array("courses" => Course::getAll()));
    });

    /*----------Students Logic-----------*/

    $app->get("/students", function() use ($app) {
        return $app["twig"]->render("students.html.twig", array("students" => Student::getAll()));
    });

    $app->post("/students", function() use ($app) {
        $student_name = $_POST["s_name"];
        $student_edate = $_POST["s_date"];
        $new_student = new Student($student_name, $student_edate);
        $new_student->save();
        return $app["twig"]->render("students.html.twig", array("students" => Student::getAll()));
    });

    $app->post("/delete_students", function() use ($app) {
        Student::deleteAll();
        return $app["twig"]->render("students.html.twig", array("students" => Student::getAll()));
    });

    /*----- Individual Student Logic -----*/

    $app->get("/students/{id}", function($id) use ($app) {
        $student = Student::find($id);
        return $app["twig"]->render("student.html.twig", array("student" => $student, "courses" => $student->getCourses(), "all_courses" => Course::getAll()));
    });

    $app->post("/add_courses", function() use ($app) {
        $course = Course::find($_POST["course_id"]);
        $student = Student::find($_POST["student_id"]);
        $student->addCourse($course);
        return $app["twig"]->render("student.html.twig", array("student" => $student, "students" => Student::getAll(), "courses" => $student->getCourses(), "all_courses" => Course::getAll()));
    });

    return $app;
 ?>
