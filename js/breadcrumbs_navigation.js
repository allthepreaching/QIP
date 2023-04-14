var BcrumbsNavUtil = {
  bcrumbsNav: function () {
    var bcrumbsNavElementReference =
      document.getElementById("bcrumbsNavElement");
    var bcrumbsNavHtmlString = "<a href='./'>Home</a>";
    if (arguments.length > 0) {
      for (var i = 0; i < arguments.length; i = i + 2) {
        bcrumbsNavHtmlString +=
          " &rarr; <a href='" + arguments[i] + "'>" + arguments[i + 1] + "</a>";
      }
    }
    bcrumbsNavElementReference.innerHTML = bcrumbsNavHtmlString;
  },
};
