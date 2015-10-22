
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
                    
            {"type": "Namespace", "link": "EpitechAPI.html", "name": "EpitechAPI", "doc": "Namespace EpitechAPI"},{"type": "Namespace", "link": "EpitechAPI/Component.html", "name": "EpitechAPI\\Component", "doc": "Namespace EpitechAPI\\Component"},{"type": "Namespace", "link": "EpitechAPI/Tool.html", "name": "EpitechAPI\\Tool", "doc": "Namespace EpitechAPI\\Tool"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Component", "fromLink": "EpitechAPI/Component.html", "link": "EpitechAPI/Component/Activity.html", "name": "EpitechAPI\\Component\\Activity", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method___construct", "name": "EpitechAPI\\Component\\Activity::__construct", "doc": "&quot;Initializes this component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getEvents", "name": "EpitechAPI\\Component\\Activity::getEvents", "doc": "&quot;Obtains the related events.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getModule", "name": "EpitechAPI\\Component\\Activity::getModule", "doc": "&quot;Obtains the related module.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getSchoolYear", "name": "EpitechAPI\\Component\\Activity::getSchoolYear", "doc": "&quot;Obtains the school year.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getModuleCode", "name": "EpitechAPI\\Component\\Activity::getModuleCode", "doc": "&quot;Obtains the module code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getInstanceCode", "name": "EpitechAPI\\Component\\Activity::getInstanceCode", "doc": "&quot;Obtains the instance code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getActivityCode", "name": "EpitechAPI\\Component\\Activity::getActivityCode", "doc": "&quot;Obtains the activity code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getTitle", "name": "EpitechAPI\\Component\\Activity::getTitle", "doc": "&quot;Obtains the title.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Activity", "fromLink": "EpitechAPI/Component/Activity.html", "link": "EpitechAPI/Component/Activity.html#method_getDescription", "name": "EpitechAPI\\Component\\Activity::getDescription", "doc": "&quot;Obtains the description.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Component", "fromLink": "EpitechAPI/Component.html", "link": "EpitechAPI/Component/Event.html", "name": "EpitechAPI\\Component\\Event", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method___construct", "name": "EpitechAPI\\Component\\Event::__construct", "doc": "&quot;Initializes this component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getRegisteredUsers", "name": "EpitechAPI\\Component\\Event::getRegisteredUsers", "doc": "&quot;Obtains the users registered to this event.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getActivity", "name": "EpitechAPI\\Component\\Event::getActivity", "doc": "&quot;Obtains the related activity.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getSchoolYear", "name": "EpitechAPI\\Component\\Event::getSchoolYear", "doc": "&quot;Obtains the school year.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getModuleCode", "name": "EpitechAPI\\Component\\Event::getModuleCode", "doc": "&quot;Obtains the module code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getInstanceCode", "name": "EpitechAPI\\Component\\Event::getInstanceCode", "doc": "&quot;Obtains the instance code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getActivityCode", "name": "EpitechAPI\\Component\\Event::getActivityCode", "doc": "&quot;Obtains the activity code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getEventCode", "name": "EpitechAPI\\Component\\Event::getEventCode", "doc": "&quot;Obtains the event code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getTitle", "name": "EpitechAPI\\Component\\Event::getTitle", "doc": "&quot;Obtains the title.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Event", "fromLink": "EpitechAPI/Component/Event.html", "link": "EpitechAPI/Component/Event.html#method_getDescription", "name": "EpitechAPI\\Component\\Event::getDescription", "doc": "&quot;Obtains the description.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Component", "fromLink": "EpitechAPI/Component.html", "link": "EpitechAPI/Component/Module.html", "name": "EpitechAPI\\Component\\Module", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method___construct", "name": "EpitechAPI\\Component\\Module::__construct", "doc": "&quot;Initializes this component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method_getActivities", "name": "EpitechAPI\\Component\\Module::getActivities", "doc": "&quot;Obtains the activities related to this module.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method_getSchoolYear", "name": "EpitechAPI\\Component\\Module::getSchoolYear", "doc": "&quot;Obtains the school year.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method_getModuleCode", "name": "EpitechAPI\\Component\\Module::getModuleCode", "doc": "&quot;Obtains the module code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method_getInstanceCode", "name": "EpitechAPI\\Component\\Module::getInstanceCode", "doc": "&quot;Obtains the instance code.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method_getTitle", "name": "EpitechAPI\\Component\\Module::getTitle", "doc": "&quot;Obtains the title.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Module", "fromLink": "EpitechAPI/Component/Module.html", "link": "EpitechAPI/Component/Module.html#method_getDescription", "name": "EpitechAPI\\Component\\Module::getDescription", "doc": "&quot;Obtains the description.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Component", "fromLink": "EpitechAPI/Component.html", "link": "EpitechAPI/Component/Netsoul.html", "name": "EpitechAPI\\Component\\Netsoul", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Component\\Netsoul", "fromLink": "EpitechAPI/Component/Netsoul.html", "link": "EpitechAPI/Component/Netsoul.html#method___construct", "name": "EpitechAPI\\Component\\Netsoul::__construct", "doc": "&quot;Initializes this component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\Netsoul", "fromLink": "EpitechAPI/Component/Netsoul.html", "link": "EpitechAPI/Component/Netsoul.html#method_getLogs", "name": "EpitechAPI\\Component\\Netsoul::getLogs", "doc": "&quot;Obtains the logs from the specified datetime to the specified datetime.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Component", "fromLink": "EpitechAPI/Component.html", "link": "EpitechAPI/Component/User.html", "name": "EpitechAPI\\Component\\User", "doc": "&quot;Class User represent an Epitech user.&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method___construct", "name": "EpitechAPI\\Component\\User::__construct", "doc": "&quot;Initializes this component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getData", "name": "EpitechAPI\\Component\\User::getData", "doc": "&quot;Obtains the intranet data&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getNetsoul", "name": "EpitechAPI\\Component\\User::getNetsoul", "doc": "&quot;Obtains the \u00ab Netsoul \u00bb component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getPicture", "name": "EpitechAPI\\Component\\User::getPicture", "doc": "&quot;Obtains the picture Url.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getLogin", "name": "EpitechAPI\\Component\\User::getLogin", "doc": "&quot;Obtains the login.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getFirstName", "name": "EpitechAPI\\Component\\User::getFirstName", "doc": "&quot;Obtains the first name.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getLastName", "name": "EpitechAPI\\Component\\User::getLastName", "doc": "&quot;Obtains the last name.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getFullName", "name": "EpitechAPI\\Component\\User::getFullName", "doc": "&quot;Obtains the full name&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getIsClosed", "name": "EpitechAPI\\Component\\User::getIsClosed", "doc": "&quot;Obtains whether is closed account.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getIsAdmin", "name": "EpitechAPI\\Component\\User::getIsAdmin", "doc": "&quot;Obtains whether is an admin.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getGroups", "name": "EpitechAPI\\Component\\User::getGroups", "doc": "&quot;Obtains the groups.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getGroupsName", "name": "EpitechAPI\\Component\\User::getGroupsName", "doc": "&quot;Obtains the groups name.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getGroupsTitle", "name": "EpitechAPI\\Component\\User::getGroupsTitle", "doc": "&quot;Obtains the groups title.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getLocation", "name": "EpitechAPI\\Component\\User::getLocation", "doc": "&quot;Obtains the city code (eg. FR\/LIL).&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Component\\User", "fromLink": "EpitechAPI/Component/User.html", "link": "EpitechAPI/Component/User.html#method_getPromotion", "name": "EpitechAPI\\Component\\User::getPromotion", "doc": "&quot;Obtains the promotion&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI", "fromLink": "EpitechAPI.html", "link": "EpitechAPI/Connector.html", "name": "EpitechAPI\\Connector", "doc": "&quot;Class Connector is the main class of the API. It allows request from intranet and authenticate an user.&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method___construct", "name": "EpitechAPI\\Connector::__construct", "doc": "&quot;Initializes the connector.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method___destruct", "name": "EpitechAPI\\Connector::__destruct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_request", "name": "EpitechAPI\\Connector::request", "doc": "&quot;Makes a cURL request to the specified intranet URL and obtains the response content.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_authenticate", "name": "EpitechAPI\\Connector::authenticate", "doc": "&quot;Sign in the student to the intranet.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_isSignedIn", "name": "EpitechAPI\\Connector::isSignedIn", "doc": "&quot;Whether the student is signed in.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_checkSignedIn", "name": "EpitechAPI\\Connector::checkSignedIn", "doc": "&quot;Checks if this Connector is signed in. It will throw an exception if not signed in.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_getPHPSESSID", "name": "EpitechAPI\\Connector::getPHPSESSID", "doc": "&quot;Obtains the PHPSESSID cookie&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_getUser", "name": "EpitechAPI\\Connector::getUser", "doc": "&quot;Obtains the signed in User component.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_getLanguage", "name": "EpitechAPI\\Connector::getLanguage", "doc": "&quot;Obtains the language.&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Connector", "fromLink": "EpitechAPI/Connector.html", "link": "EpitechAPI/Connector.html#method_setLanguage", "name": "EpitechAPI\\Connector::setLanguage", "doc": "&quot;Sets the language.&quot;"},
            
            {"type": "Class", "fromName": "EpitechAPI\\Tool", "fromLink": "EpitechAPI/Tool.html", "link": "EpitechAPI/Tool/DataExtractor.html", "name": "EpitechAPI\\Tool\\DataExtractor", "doc": "&quot;Class DataExtractor is a tool to extract data.&quot;"},
                                                        {"type": "Method", "fromName": "EpitechAPI\\Tool\\DataExtractor", "fromLink": "EpitechAPI/Tool/DataExtractor.html", "link": "EpitechAPI/Tool/DataExtractor.html#method_retrieve", "name": "EpitechAPI\\Tool\\DataExtractor::retrieve", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "EpitechAPI\\Tool\\DataExtractor", "fromLink": "EpitechAPI/Tool/DataExtractor.html", "link": "EpitechAPI/Tool/DataExtractor.html#method_extract", "name": "EpitechAPI\\Tool\\DataExtractor::extract", "doc": "&quot;Extract the specified keys from the specified json.&quot;"},
            
            
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


