$(document).ready(function () {
    
    //SideBar area
    $(".side-bar-button").click(function () {
        $(".admin-panel-side-bar").toggleClass("toggle-side-bar");
        $(".side-bar-button").toggleClass("bar-color");
    });
    
    $(".admin-panel-main").click(function () {
        $(".admin-panel-side-bar").removeClass("toggle-side-bar");
        $(".side-bar-button").removeClass("bar-color");
    });
    
    
    
    //Attendance button area
    $(".side-attendance-button").click(function () {
        $(".sub-attendance-button").slideToggle();
        $(".side-attendance-button").toggleClass("side-bar-open");
    });
    
});
