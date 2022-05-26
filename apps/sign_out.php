<?php
session_start();
class DoLogout
{
    static public function justLogout()
    {
        require_once 'model/connection.php';
        require_once 'model/activities/SignOutActivityMDL.php';
        $userIS = $_SESSION['em'];
        $table = "activity_audit_trail";
        $activityDesc = "Sign Out";
        $saveActivity = SignOutActivityMDL::signOutActivities($table, $userIS, $activityDesc);


        session_destroy();
        header('Location: home');

    }
}
$callClass  = DoLogout::justLogout();
?>
