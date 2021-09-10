const GC_SECTIONS = ['divAboutUs', 'divContactUs', 'divEvents', 'divClubs', 'divSignUp', 'divLinks'];
function route(idx)
{
 
     $("#divContent").hide();
    hideAll();
    switch (idx){
        case 2: // Events
            showEvents();
            return;
            
        case 3: // Clubs
            showClubs();
            return;
           
    }
  
    $("#" + GC_SECTIONS[idx]).show();
  //alert(GC_SECTIONS[idx]);
}

function pageLoad()
{
    hideAll();
}
function hideAll()
{
    GC_SECTIONS.map((s) => {
        $("#" + s).hide();
    })
}
function showClubs()
{
    let c = "<table border><th>Sport</th><th>Team Name</th><th>Website</th><th>Contact</th><th>Email</th></tr>";
    GC_CLUBS.forEach(row => {
        let tr = `<tr><td>${row.sport}</td><td>${row.teamName}</td><td>${row.webSite}</td><td>${row.contact}</td><td>${row.email}</td></tr>`
        c += tr;
    });
    $("#divContent").html(c + "</table>")
    $("#divContent").show();
}
function showEvents()
{

    let c = "<table><tr><th>Date</th><th>More Info</th><th>Event</th><th>Location</th><th>Contact</th></tr>";
    GC_EVENTS.forEach(row => {
        let tr = `<tr><td>${row.startDate}</td><td><a href='${row.website}'>
                    <img src='${row.image}'/></a></td><td>${row.title}</td><td>${row.location1}</td><td>${row.contact}</td></tr>`
        c += tr;
    });
    $("#divContent").html(c + "</table>");
    $("#divContent").show();

}
function showLinks()
{

    let c = "<table><tr><th>Date</th><th>More Info</th><th>Event</th><th>Location</th><th>Contact</th></tr>";
    GC_EVENTS.forEach(row => {
        let tr = `<tr><td>${row.startDate}</td><td><a href='${row.website}'>
                    <img src='${row.image}'/></a></td><td>${row.title}</td><td>${row.location1}</td><td>${row.contact}</td></tr>`
        c += tr;
    });
    $("#divContent").html(c + "</table>");
    $("#divContent").show();

}
function sendMessage()
{
    $.post("sendContact.php",
            {
                fullname: $("#fullName").val(),
                email: $("#email").val(),

                comments: $("#message").val(),

                contactId: 1,
                token: "TeamSF2HK22!"
            },
            function (msg)
            {
                alert(msg);
                hideAll();

            });
}
const quizAnswer = 11;
function signup()
{
    const pg = "saveSignup.php";
    const data = {
        fullname: $("#fullName").val(),
        email: $("#email").val(),
        birthdate: $("#birthdate").val(),

        contactId: 1,
        token: "TeamSF2HK22!"
    };
    //alert(JSON.stringify (data));
    $.post(pg,
            data
            ,
            function (msg)
            {
                alert(msg);
                hideAll();

            });
}