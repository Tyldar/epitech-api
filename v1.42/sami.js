
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:EpitechAPI" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="EpitechAPI.html">EpitechAPI</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:EpitechAPI_Component" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="EpitechAPI/Component.html">Component</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:EpitechAPI_Component_Activity" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="EpitechAPI/Component/Activity.html">Activity</a>                    </div>                </li>                            <li data-name="class:EpitechAPI_Component_Event" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="EpitechAPI/Component/Event.html">Event</a>                    </div>                </li>                            <li data-name="class:EpitechAPI_Component_Module" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="EpitechAPI/Component/Module.html">Module</a>                    </div>                </li>                            <li data-name="class:EpitechAPI_Component_Netsoul" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="EpitechAPI/Component/Netsoul.html">Netsoul</a>                    </div>                </li>                            <li data-name="class:EpitechAPI_Component_User" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="EpitechAPI/Component/User.html">User</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:EpitechAPI_Tool" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="EpitechAPI/Tool.html">Tool</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:EpitechAPI_Tool_DataExtractor" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="EpitechAPI/Tool/DataExtractor.html">DataExtractor</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:EpitechAPI_Connector" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="EpitechAPI/Connector.html">Connector</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "EpitechAPI.html", "name": "EpitechAPI", "doc": "Namespace EpitechAPI"},{"type": "Namespace", "link": "EpitechAPI/Components.html", "name": "EpitechAPI\\Components", "doc": "Namespace EpitechAPI\\Components"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Components", "fromLink": "EpitechAPI/Components.html", "link": "EpitechAPI/Components/Student.html", "name": "EpitechAPI\\Components\\Student", "doc": "&quot;Class Student represents a student.&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method___construct", "name": "EpitechAPI\\Components\\Student::__construct", "doc": "&quot;Initializes a new instance of this class and retrieves the data of the specified student login.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_isCloseAccount", "name": "EpitechAPI\\Components\\Student::isCloseAccount", "doc": "&quot;Obtains the status of the student close account.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getConnector", "name": "EpitechAPI\\Components\\Student::getConnector", "doc": "&quot;Obtains the connector&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getData", "name": "EpitechAPI\\Components\\Student::getData", "doc": "&quot;Obtains the student data.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getInfo", "name": "EpitechAPI\\Components\\Student::getInfo", "doc": "&quot;Obtains the specified info from the student data.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getLogin", "name": "EpitechAPI\\Components\\Student::getLogin", "doc": "&quot;Obtains the student login.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getFirstName", "name": "EpitechAPI\\Components\\Student::getFirstName", "doc": "&quot;Obtains the student first name.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getLastName", "name": "EpitechAPI\\Components\\Student::getLastName", "doc": "&quot;Obtains the student last name.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getLocation", "name": "EpitechAPI\\Components\\Student::getLocation", "doc": "&quot;Obtains the student location.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getPromotion", "name": "EpitechAPI\\Components\\Student::getPromotion", "doc": "&quot;Obtains the student promotion.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getPictureUrl", "name": "EpitechAPI\\Components\\Student::getPictureUrl", "doc": "&quot;Obtains the student picture URL.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getMiniaturePictureUrl", "name": "EpitechAPI\\Components\\Student::getMiniaturePictureUrl", "doc": "&quot;Obtains the student miniature picture URL.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getGPA", "name": "EpitechAPI\\Components\\Student::getGPA", "doc": "&quot;Obtains the student GPA.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getYear", "name": "EpitechAPI\\Components\\Student::getYear", "doc": "&quot;Obtains the student year.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getSemester", "name": "EpitechAPI\\Components\\Student::getSemester", "doc": "&quot;Obtains the student semester.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getGroups", "name": "EpitechAPI\\Components\\Student::getGroups", "doc": "&quot;Obtains the student groups.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\Student", "fromLink": "EpitechAPI/Components/Student.html", "link": "EpitechAPI/Components/Student.html#method_getNetsoulStats", "name": "EpitechAPI\\Components\\Student::getNetsoulStats", "doc": "&quot;Obtains the Netsoul stats of this student.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Components", "fromLink": "EpitechAPI/Components.html", "link": "EpitechAPI/Components/StudentMark.html", "name": "EpitechAPI\\Components\\StudentMark", "doc": "&quot;Class StudentMark provides information about the student&#039;s marks&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method___construct", "name": "EpitechAPI\\Components\\StudentMark::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method_getConnector", "name": "EpitechAPI\\Components\\StudentMark::getConnector", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method_getData", "name": "EpitechAPI\\Components\\StudentMark::getData", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method_getModules", "name": "EpitechAPI\\Components\\StudentMark::getModules", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method_getMarks", "name": "EpitechAPI\\Components\\StudentMark::getMarks", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method_getModuleMarks", "name": "EpitechAPI\\Components\\StudentMark::getModuleMarks", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentMark", "fromLink": "EpitechAPI/Components/StudentMark.html", "link": "EpitechAPI/Components/StudentMark.html#method_getModuleAverage", "name": "EpitechAPI\\Components\\StudentMark::getModuleAverage", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Components", "fromLink": "EpitechAPI/Components.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html", "name": "EpitechAPI\\Components\\StudentNetsoulStats", "doc": "&quot;Class StudentNetsoulStats provides information about the Netsoul stats from a student.&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method___construct", "name": "EpitechAPI\\Components\\StudentNetsoulStats::__construct", "doc": "&quot;Initializes a new instance of this class and retrieves the netsoul stats of the specified student login.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getData", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getData", "doc": "&quot;Obtains the student netsoul stat data.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getRange", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getRange", "doc": "&quot;Obtains an array of the date range of the netsoul stats.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getStats", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getStats", "doc": "&quot;Obtains the array of the netsoul stats.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getStatsFromTimestamp", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getStatsFromTimestamp", "doc": "&quot;Obtains the netsoul stats from the specified timestamp.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getStatsFromDateTime", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getStatsFromDateTime", "doc": "&quot;Obtains the netsoul stats form the specified DateTime&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getStatsBetweenTimeStamp", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getStatsBetweenTimeStamp", "doc": "&quot;Obtains the stats between the specified start and end timestamps.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Components\\StudentNetsoulStats", "fromLink": "EpitechAPI/Components/StudentNetsoulStats.html", "link": "EpitechAPI/Components/StudentNetsoulStats.html#method_getStatsBetweenDateTime", "name": "EpitechAPI\\Components\\StudentNetsoulStats::getStatsBetweenDateTime", "doc": "&quot;Obtains the stats between the specified start and end DateTime.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI", "fromLink": "EpitechAPI.html", "link": "EpitechAPI/Connector.html", "name": "EpitechAPI\\Connector", "doc": "&quot;Class Connector manages the connection from the intranet.&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method___construct", "name": "EpitechAPI\\Connector::__construct", "doc": "&quot;Initializes a new instance of this class and authenticates from the intranet with the specified login and password.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method___destruct", "name": "EpitechAPI\\Connector::__destruct", "doc": "&quot;Destruct the class by deleting the cookie file for security reasons.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_request", "name": "EpitechAPI\\Connector::request", "doc": "&quot;Makes a cURL request to the specified intranet URL and obtains the response content.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_isSignedIn", "name": "EpitechAPI\\Connector::isSignedIn", "doc": "&quot;Obtains the authentication status.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_getStudent", "name": "EpitechAPI\\Connector::getStudent", "doc": "&quot;Obtains the Student object of the authenticated student.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI", "fromLink": "EpitechAPI.html", "link": "EpitechAPI/Settings.html", "name": "EpitechAPI\\Settings", "doc": "&quot;Class Settings&quot;"},
                    
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


