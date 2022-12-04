<?php
require_once('define.php');
session_start();



$view = (isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '';
switch ($view) {
  case 'mybook':
    $title = 'My Book';
    $content = app_root . '/view/myBook.php';
    break;
  case 'info':
    $title = 'My profile';
    $content = app_root . '/view/userInfo.php';
    break;
  case 'book':
    $title = 'Reference Book';
    $content = app_root . '/view/book.php';
    break;
  case 'mycourse':
    $title = 'My Course';
    $content = app_root . '/view/myCourse.php';
    if (isset($_GET['courseID']) && $_GET['courseID'] != '') {
      require_once(app_root . '/model/course.php');
      $course = new Course();
      $result = $course->getById($_GET['courseID']);
      if ($result) {
        while ($data = $result->fetch_assoc()) {
          $title = $data['courseName'];
        }
        $content = app_root . '/view/editCourse.php';
      }
    }
    break;
  case 'course':
    $title = 'Course';
    $content = app_root . '/view/course.php';
    if (isset($_GET['courseID']) && $_GET['courseID'] != '') {
      require_once(app_root . '/model/course.php');
      $course = new Course();
      $result = $course->getById($_GET['courseID']);
      if ($result) {
        while ($data = $result->fetch_assoc()) {
          $title = $data['courseName'];
        }
        $content = app_root . '/view/courseDetail.php';
      }
    }
    break;
  case 'about':
    $title = "About Us";
    $content = app_root . '/view/about.php';
    # code...
    break;
  default:
    $title = "Home";
    $content = app_root . '/view/home.php';
}
require_once(app_root . "/view/theme/templates.php");
