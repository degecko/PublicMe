<?php

require_once 'includes/class.userinfo.php';

$data = new UserInfo();

?><!DOCTYPE html>
<html>
<head>
    <title>Public Me</title>

    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/flags.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<div id="header" class="block">
    <h1><i class="fa fa-eye"></i> Public Me</h1>
    <p>The point of this web page is to show you what pieces of information are available to each and every one of the websites you visit.<br />You don't need to do a thing, if this information can be shown here, than so it can be on other websites that have the same privileges as this website does.</p>
</div>

<div id="content" class="block">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading"><i class="fa fa-info-circle"></i> &nbsp; All public information about your device and your request to this web page</div>
        
        <table class="table">
            <tr>
                <td colspan="2" class="separator"><i class="fa fa-angle-down"></i> &nbsp; Server side <em>&mdash; this information comes bundled with every visit you make</em></td>
            </tr>

            <!--tr>
                <td class="active">IP address</td>
                <td class="value table-inception">
                    <table class="table">
                        <tr class="active faded"></tr>
                        <tr></tr>
                    </table>
                </td>
            </tr-->

            <tr>
                <td class="active">IP address</td>
                <td class="value"><?php echo $data->ip; ?></td>
            </tr>

            <tr>
                <td class="active">Proxy?</td>
                <td class="value"><?php echo $data->proxy; ?></td>
            </tr>

            <tr>
                <td class="active">Browser</td>
                <td class="value"><?php echo $data->browser; ?></td>
            </tr>

            <tr>
                <td class="active">Operating System</td>
                <td class="value"><?php echo $data->os; ?></td>
            </tr>

            <tr>
                <td class="active">Referer</td>
                <td class="value"><?php echo $data->referer; ?></td>
            </tr>

            <tr>
                <td class="active">Page Request Type</td>
                <td class="value"><?php echo $data->page_req_type; ?></td>
            </tr>

            <tr>
                <td class="active">Accept Language(s)</td>
                <td class="value"><?php echo $data->accept_lang; ?></td>
            </tr>

            <tr>
                <td class="active">Page Request Time</td>
                <td class="value"><?php echo $data->page_req_time; ?></td>
            </tr>

            <tr>
                <td class="active">Query String</td>
                <td class="value"><?php echo $data->query_string; ?></td>
            </tr>

            <tr>
                <td class="active">User Agent</td>
                <td class="value"><?php echo $data->user_agent; ?></td>
            </tr>

            <tr>
                <td class="active">Remote Port</td>
                <td class="value"><?php echo $data->remote_port; ?></td>
            </tr>

            <tr>
                <td class="active">Request URI</td>
                <td class="value"><?php echo $data->request_uri; ?></td>
            </tr>

            <tr>
                <td class="active">Cookies</td>
                <td class="value"><?php echo $data->cookies; ?></td>
            </tr>

            <tr>
                <td colspan="2" class="separator"><i class="fa fa-angle-down"></i> &nbsp; Meta data <em>&mdash; this information is deduced from the one above, using 3rd party tools</em></td>
            </tr>

            <tr>
                <td class="active">City, Region</td>
                <td class="value"><?php echo ($data->city == null ? 'Unknown' : $data->city) .', '. ($data->region == null ? 'Unknown' : $data->region); ?></td>
            </tr>

            <tr>
                <td class="active">Country</td>
                <td class="value"><span class="flag<?php echo $data->countryCode == 'A1' ? 'NOT' : ''; ?> flag-<?php echo $data->countryCode == null ? 'unk' : strtolower($data->countryCode); ?>"></span> <?php echo $data->country == null ? 'Unknown' : $data->country; ?></td>
            </tr>

            <tr>
                <td class="active">ISP</td>
                <td class="value"><?php echo $data->provider == null ? 'Unknown' : $data->provider; ?></td>
            </tr>

            <tr>
                <td class="active">Location Coordinates</td>
                <td class="value"><?php echo $data->latlng == null ? 'Unknown' : $data->latlng; ?></td>
            </tr>

            <tr>
                <td class="active">Timezone</td>
                <td class="value"><?php echo $data->timezone == null ? 'Unknown' : $data->timezone; ?></td>
            </tr>

            <tr>
                <td colspan="2" class="separator"><i class="fa fa-angle-down"></i> &nbsp; Client side <em>&mdash; this information can only be determined if you have JavaScript enabled</em></td>
            </tr>

            <tr>
                <td class="active">JavaScript</td>
                <td id="javascript" class="value">Disabled</td>
            </tr>
        </table>
    </div>
</div>

<div id="footer" class="block">
    <p>Development and maintenance by <a href="http://www.g3x0.com/" target="_blank">Gecko</a></p>
</div>

<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/client.js"></script>

</body>
</html>