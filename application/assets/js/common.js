function setCookie(cName, cValue, cDay){
    var expire = new Date();
    expire.setDate(expire.getDate() + cDay);
    cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
    if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
    document.cookie = cookies;
}

// 쿠키 가져오기
function getCookie(cName) {
    cName = cName + '=';
    var cookieData = document.cookie;
    var start = cookieData.indexOf(cName);
    var cValue = '';
    if(start != -1){
        start += cName.length;
        var end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cValue = cookieData.substring(start, end);
    }
    return unescape(cValue);
}
function refreshWithCountry()
{
    if(location.href.indexOf("?") == -1)
        location.href = location.href + "?country="+getCookie("country");
    else
        location.href = location.href + "&country="+getCookie("country");
}
function getRequestData(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function changeURL(URL)
{
    if(URL.indexOf("?") == -1)
        location.href = URL + "?country="+getRequestData("country");
    else
        location.href = URL + "&country="+getRequestData("country");
}
if(getRequestData("country") == "")
{
    if(getCookie("country") == "")
    {
        $.ajax( { 
          url: '//freegeoip.net/json/', 
          type: 'POST', 
          dataType: 'jsonp',
          async : false,
          success: function(location) {
            setCookie("country",location.country_code,30);
          }
        });
    }
    refreshWithCountry();
}


 $(document).ready(function(){
    $(".img-over").hover(function(){
    $(this).find("img").attr("src",$(this).find("img").attr("over"));
    }, function(){
    $(this).find("img").attr("src",$(this).find("img").attr("normal"));
    });    
 });
