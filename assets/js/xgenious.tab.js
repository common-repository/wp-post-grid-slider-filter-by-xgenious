;(function ($) {
    "use strict";

    document.addEventListener("DOMContentLoaded", function(event) {
        // Your code to run since DOM is loaded and ready

        var xgtabnav = document.getElementsByClassName('xgnav-tabs');

        for (var i = 0; i < xgtabnav.length; i++) {
            var tabNav = xgtabnav[i].children;
            for (var j = 0; j < tabNav.length; j++) {

                var Nav = tabNav[j];

                Nav.onclick = function (e) {
                    var sibling = this.parentNode.children;
                    for (var s = 0; s < sibling.length; s++) {
                        sibling[s].classList.remove('active');
                    }
                    this.classList.add('active');
                    var contentID = this.attributes['data-target'].value.substr(1);
                    var tabPaneId = this.parentNode.nextElementSibling.children;
                    for (var t = 0; t < tabPaneId.length; t++) {
                        tabPaneId[t].classList.remove('active');
                        tabPaneId[t].classList = 'xgtab-pane fade';
                    }
                    document.getElementById(contentID).classList.add('active');
                    document.getElementById(contentID).classList.add('show');
                };

            };

        }

    });

})(jQuery);