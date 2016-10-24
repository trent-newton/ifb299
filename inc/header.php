<!DOCTYPE html>
<html>
<head>

  <?php
    // Turn off all error reporting
    error_reporting(1);
  ?>
        <link rel="icon" href="/MusicSchool/favicon.ico" type="image/ico" sizes="32x32" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $pagetitle?></title>
    <!-- Tells phones not to lie about thier width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum scale=1" />

    <!-- Style Sheets -->
    <!-- default(Phone) -->

    <link href="../../css/main.css" rel="stylesheet" />
    <link href="../../css/faq.css" rel="stylesheet" />

    <script type="text/javascript" src="../../js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.tablesorter.js"></script>

    <!-- Latest compiled and minified BOOTSTRAP CSS  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
    <?php
    session_start();
    ?>
