(function($)
{

    $(document).ready(function()
    {
        $.ajaxSetup(
        {
            cache: false
        });
        var $container_patients = $(".patients-activity-content");
        $container_patients.load("rss-patients-activity.php");
        var refreshId_patients = setInterval(function()
        {
            $container_patients.load('rss-patients-activity.php');
        }, 9000);


        var $container_staff = $(".staff-activity-content");
        $container_staff.load("rss-staff-activity.php");
        var refreshId_staff = setInterval(function()
        {
            $container_staff.load('rss-staff-activity.php');
        }, 9000);


        var $container_branches = $(".branches-activity-content");
        $container_branches.load("rss-branches-activity.php");
        var refreshId_branches = setInterval(function()
        {
            $container_branches.load('rss-branches-activity.php');
        }, 9000);

        var $container_consumed = $(".consumed-activity-content");
        $container_consumed.load("rss-medicines-activity.php");
        var refreshId_consumed = setInterval(function()
        {
            $container_consumed.load('rss-medicines-activity.php');
        }, 9000);



    });
})(jQuery);
