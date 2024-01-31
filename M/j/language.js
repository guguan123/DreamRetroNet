function changeLanguage(obj) {
  var url = document.URL;
  var re = re = /[?&]local=[^&]*/;
  url = url.replace(re, "");
  if (url.indexOf("?") > -1) {
    url += "&local=" + obj.value;
  } else {
    url += "?local=" + obj.value;
  }
  location.href = url;
}