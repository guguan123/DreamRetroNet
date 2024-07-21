function changeLanguage(obj) {
  var url = document.URL;
  var re = re = /[?&]language=[^&]*/;
  url = url.replace(re, "");
  if (url.indexOf("?") > -1) {
    url += "&language=" + obj.value;
  } else {
    url += "?language=" + obj.value;
  }
  location.href = url;
}
