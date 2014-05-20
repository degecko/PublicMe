/*!
 * PublicMe client side script
 *
 * @author   Gecko - g3x0.com
 * @version  1.0
 * @licence  GPL
 */
;(function() {

    function $(element) {
        return document.querySelector(element);
    }

    /*!
     * Get flash version if the user has flash installed
     *
     * @since 1.0
     */
    var flash_version = swfobject.getFlashPlayerVersion();
    flash_version = flash_version ? flash_version.major +'.'+ flash_version.minor +'.r'+ flash_version.release : '';

    /*!
     * Capitalize and add spaces to a string
     * e.g. from loremIpsumDolor to Lorem Ipsum Dolor
     *
     * @since 1.0
     */
    function capitalize(str) {
        if (str.length > 0 && typeof str === 'string')
            return (str[0].toUpperCase() + str.substr(1)).replace(/enabled/gi, '').match(/[A-Z][a-z]+/g).join(" ");
        else
            return null;
    }

    /*!
     * Display all the items in the navigator object
     * and other relevant data, like screen,
     * browser resolutions and the flash version
     *
     * @since 1.0
     */
    function add_navigator_rows() {
        var t = $('#content table tbody');
        var init_content = t.innerHTML;
        var new_content = '', elem;
        
        if (flash_version.length > 0)
            new_content += '<tr><td class="active">Flash Version</td><td class="value">'+ flash_version +'</td></tr>';

        new_content += '<tr><td class="active">Monitor Resolution</td><td class="value">'+ window.screen.width +'x'+ window.screen.height +' pixels</td></tr>';
        new_content += '<tr><td class="active">Browser Resolution</td><td class="value">'+ window.outerWidth +'x'+ window.outerHeight +' pixels</td></tr>';

        for (var item in navigator)
        {
            elem = eval('navigator.'+ item);

            if (elem !== null && item != 'userAgent' && (elem.length > 0 || typeof elem === 'boolean') && typeof elem !== 'object' && typeof elem !== 'function')
                new_content += '<tr><td class="active">'+ capitalize(item) +'</td><td class="value">'+ (typeof elem === 'boolean' ? (elem === true ? 'Enabled' : 'Disabled') : elem.toString().replace(/^\s*1\s*$/, 'Enabled').replace(/^\s*0\s*$/, 'Disabled')) +'</td></tr>';
        }

        new_content += '<tr><td class="active">Pages In History</td><td class="value">'+ window.history.length +'</td></tr>';

        if (window.localStorage && window.localStorage.length > 0)
        {
            new_content += '<tr><td class="active">Local Storage Contents</td><td class="value">';

            for (var item in window.localStorage)
                new_content += item +': '+ (window.localStorage[item] === 'undefined' ? window.localStorage[item] : '"'+ window.localStorage[item] +'"') +', ';

            new_content  = new_content.substr(0, new_content.length - 2);
            new_content += '</td></tr>';
        }

        t.innerHTML = init_content + new_content;

        return true;
    }

    /*!
     * Display a special <tr> that acts like
     * a separator in the user info table
     *
     * @since 1.0
     */
    function add_separator(title, desc)
    {
        var t = $('#content table tbody');
        t.innerHTML += '<tr><td colspan="2" class="separator"><i class="fa fa-angle-down"></i> &nbsp; '+ title +''+ (desc ? ' <em>&mdash; '+ desc +'</em>' : '') +'</td></tr>';

        return true;
    }

    /*!
     * Display all the plugins in the navigator object.plugins
     *
     * @since 1.0
     */
    function add_plugin_rows() {
        var t = $('#content table tbody');
        var init_content = t.innerHTML;
        var new_content = '', elem;
        
        for (var i in navigator.plugins)
        {
            if (typeof navigator.plugins[i] === 'object')
                new_content += '<tr><td class="active">'+ navigator.plugins[i].name +'</td><td class="value">'+ navigator.plugins[i].filename + (navigator.plugins[i].description.length > 0 ? ' <em>&mdash; '+ navigator.plugins[i].description +'</em>' : '') +'</td></tr>';
        }

        t.innerHTML = init_content + new_content;

        return true;
    }

    // Call all above functions
    add_navigator_rows();
    add_separator('Browser Plugins', 'this information is also JavaScript related, but also browser related');
    add_plugin_rows();

    // Scify that JS is enabled
    $('#javascript').innerHTML = "Enabled";

})();