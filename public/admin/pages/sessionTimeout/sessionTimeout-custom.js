'use strict';
! function(e) { "use strict";
    e.sessionTimeout = function(t) {
        function o() { f || (e.ajax({ type: d.ajaxType, url: d.keepAliveUrl, data: d.ajaxData }), f = !0, setTimeout(function() { f = !1 }, d.keepAliveInterval)) }

        function i() { clearTimeout(a), (d.countdownMessage || d.countdownBar) && s("session", !0), "function" == typeof d.onStart && d.onStart(d), d.keepAlive && o(), a = setTimeout(function() { "function" != typeof d.onWarn ? e("#session-timeout-dialog").modal("show") : d.onWarn(d), n() }, d.warnAfter) }

        function n() { clearTimeout(a), e("#session-timeout-dialog").hasClass("in") || !d.countdownMessage && !d.countdownBar || s("dialog", !0), a = setTimeout(function() { "function" != typeof d.onRedir ? window.location = d.redirUrl : d.onRedir(d) }, d.redirAfter - d.warnAfter) }

        function s(t, o) { clearTimeout(l.timer), "dialog" === t && o ? l.timeLeft = Math.floor((d.redirAfter - d.warnAfter) / 1e3) : "session" === t && o && (l.timeLeft = Math.floor(d.redirAfter / 1e3)), d.countdownBar && "dialog" === t ? l.percentLeft = Math.floor(l.timeLeft / ((d.redirAfter - d.warnAfter) / 1e3) * 100) : d.countdownBar && "session" === t && (l.percentLeft = Math.floor(l.timeLeft / (d.redirAfter / 1e3) * 100));
            var i = e(".countdown-holder"),
                n = l.timeLeft >= 0 ? l.timeLeft : 0;
            if (d.countdownSmart) {
                var a = Math.floor(n / 60),
                    r = n % 60,
                    u = a > 0 ? a + "m" : "";
                u.length > 0 && (u += " "), u += r + "s", i.text(u) } else i.text(n + "s");
            d.countdownBar && e(".countdown-bar").css("width", l.percentLeft + "%"), l.timeLeft = l.timeLeft - 1, l.timer = setTimeout(function() { s(t) }, 1e3) }
        var a, r = { title: "Your Session is About to Expire!", message: "Your session is about to expire.", logoutButton: "Logout", keepAliveButton: "Stay Connected", keepAliveUrl: "/new-able/default/session-timeout.html", ajaxType: "POST", ajaxData: "", redirUrl: "/timed-out", logoutUrl: "/log-out", warnAfter: 9e5, redirAfter: 12e5, keepAliveInterval: 5e3, keepAlive: !0, ignoreUserActivity: !1, onStart: !1, onWarn: !1, onRedir: !1, countdownMessage: !1, countdownBar: !1, countdownSmart: !1 },
            d = r,
            l = {};
        if (t && (d = e.extend(r, t)), d.warnAfter >= d.redirAfter) return console.error('Bootstrap-session-timeout plugin is miss-configured. Option "redirAfter" must be equal or greater than "warnAfter".'), !1;
        if ("function" != typeof d.onWarn) {
            var u = d.countdownMessage ? "<p>" + d.countdownMessage.replace(/{timer}/g, '<span class="countdown-holder"></span>') + "</p>" : "",
                c = d.countdownBar ? '<div class="progress progress-lg">                   <div class="progress-bar progress-bar-success countdown-bar active" role="progressbar" style="min-width: 15px; width: 100%;">                     <span class="countdown-holder"></span>                   </div>                 </div>' : "";
            e("body").append('<div class="modal fade" id="session-timeout-dialog">               <div class="modal-dialog">                 <div class="modal-content">                   <div class="modal-header">                                        <h4 class="modal-title">' + d.title + '</h4>        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>             </div>                   <div class="modal-body">                     <p>' + d.message + "</p>                     " + u + "                     " + c + '                   </div>                   <div class="modal-footer">                     <button id="session-timeout-dialog-logout" type="button" class="btn btn-default">' + d.logoutButton + '</button>                     <button id="session-timeout-dialog-keepalive" type="button" class="btn btn-primary" data-dismiss="modal">' + d.keepAliveButton + "</button>                   </div>                 </div>               </div>              </div>"), e("#session-timeout-dialog-logout").on("click", function() { window.location = d.logoutUrl }), e("#session-timeout-dialog").on("hide.bs.modal", function() { i() }) }
        if (!d.ignoreUserActivity) {
            var m = [-1, -1];
            e(document).on("keyup mouseup mousemove touchend touchmove", function(t) {
                if ("mousemove" === t.type) {
                    if (t.clientX === m[0] && t.clientY === m[1]) return;
                    m[0] = t.clientX, m[1] = t.clientY }
                i(), e("#session-timeout-dialog").length > 0 && e("#session-timeout-dialog").data("bs.modal") && e("#session-timeout-dialog").data("bs.modal").isShown && (e("#session-timeout-dialog").modal("hide"), e("body").removeClass("modal-open"), e("div.modal-backdrop").remove()) }) }
        var f = !1;
        i() } }(jQuery);

$(document).ready(function() {
    $.sessionTimeout({
        warnAfter: 3000,
        redirAfter: 300000,
        message: 'Your session is expiring soon.',
        logoutUrl: 'session-timeout.html'
    });
});
