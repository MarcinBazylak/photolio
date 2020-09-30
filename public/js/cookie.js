/*!
 * CookieAlert v1.2
 * http://cookiealert.sruu.pl/
 *
 * Created by PaweĹ Klockiewicz
 * http://klocus.pl/
 */
var CookieAlert = {
   defines: {
      divID: "CookieAlert",
      cookieName: "agreeCookies",
      cookieValue: "yes",
      cookieExpire: 12
   },
   options: {
      style: "dark",
      position: "bottom",
      opacity: 1,
      displayTime: 0,
      text:
         "Serwis photolio.pl wykorzystuje pliki cookies. Korzystanie z witryny oznacza zgodę na ich zapis i/lub odczyt wg ustawień przeglądarki.",
      cookiePolicy: "https://photolio.pl/polityka-prywatnosci"
   },
   setCookie: function(e, o, i) {
      document.cookie =
         e +
         "=" +
         escape(o) +
         (null === i ? "" : "; expires=" + i.toGMTString()) +
         "; path=/";
   },
   checkCookie: function(e) {
      if ("" !== document.cookie) {
         var o = document.cookie.split("; ");
         for (i = 0; i < o.length; i++) {
            var t = o[i].split("=")[0],
               n = o[i].split("=")[1];
            if (t == e) return unescape(n);
         }
      }
   },
   removeDiv: function(e) {
      var o = document.getElementById(e);
      document.body.removeChild(o);
      var i = new Date();
      i.setMonth(i.getMonth() + this.defines.cookieExpire),
         this.setCookie(this.defines.cookieName, this.defines.cookieValue, i);
   },
   fadeOut: function(e, o) {
      (div = document.getElementById(o)),
         (div.style.opacity = e / 100),
         (div.style.filter = "alpha(opacity=" + e + ")"),
         1 == e && ((div.style.display = "none"), (done = !0));
   },
   init: function(e) {
      var o = CookieAlert;
      window.onload = function() {
         for (var i in e) o.options[i] = e[i];
         var t = document.createElement("div");
         t.setAttribute("id", o.defines.divID);
         var n =
            "position:fixed;" +
            o.options.position +
            ":-1px;left:0px;right:0px;width:100%;z-index:1000;padding:10px;font-family:Arial;font-size:14px;opacity:" +
            o.options.opacity +
            ";";
         switch (o.options.style) {
            case "light":
               n +=
                  "background-color:#FFF; color:#373737; text-shadow: 1px 1px 0px rgba(0,0,0,0.1); border-top:3px solid greenyellow; border-bottom:1px solid #ccc; box-shadow:0px 0px 8px rgba(0, 0, 0, 1);";
               break;
            case "dark":
               n +=
                  "background-color:#33333f; color:#fff; text-shadow: 1px 1px 0px rgba(255,255,255,0.1); border-top:3px solid greenyellow; border-bottom:1px solid #444; box-shadow:0px 0px 8px rgba(0, 0, 0, 1);";
         }
         t.setAttribute("style", n);
         var s =
            '<div style="width:52px;display:inline-block;vertical-align:middle;text-align:right;">';
         (s +=
            '<a href="' +
            o.options.cookiePolicy +
            '"><img src="/img/info.png" style="border:0;" title="Informacje o ciasteczkach"/></a>'),
            (s +=
               '<img src="/img/close.png" id="CookieAlertClose" style="border:0;cursor:pointer;margin-left:8px;" title="Zamknij komunikat"/>'),
            (s += "</div>");
         var a =
            '<div style="width:calc(100% - 72px);display:inline-block;vertical-align:middle;text-align:center;">' +
            o.options.text +
            "</div>" +
            s;
         (t.innerHTML = a),
            o.checkCookie(o.defines.cookieName) != o.defines.cookieValue &&
               (document.body.appendChild(t),
               document.getElementById("CookieAlertClose").addEventListener(
                  "click",
                  function() {
                     o.removeDiv(o.defines.divID);
                  },
                  !1
               ),
               o.options.displayTime > 0 &&
                  setTimeout(function() {
                     for (var e = 100; e >= 1; e--)
                        setTimeout(
                           "CookieAlert.fadeOut(" +
                              e +
                              ", CookieAlert.defines.divID)",
                           -1 * (e - 100) * 5
                        );
                  }, o.options.displayTime));
      };
   }
};
