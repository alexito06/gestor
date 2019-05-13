<!DOCTYPE html>
<html>
<head>


        
    <meta charset="utf-8" />
    <title>The most wanted</title>

    <link href="/Content/Site.css" rel="stylesheet" type="text/css" />
    <link href="/Content/jqGridCss/ui.jqgrid.css" rel="stylesheet" type="text/css" media="screen" />


    <!--link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/themes/redmond/jquery-ui.css" rel="Stylesheet" type="text/css" media="screen" /-->
    <link href="/Content/jqGridCss/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" media="screen" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" type="text/javascript"></script>
    <script src="/Scripts/jquery.blockUI.js" type="text/javascript"></script>




    


   




<!-- overflow:hidden in IE is currently breaking mask calcs :( -->
<!--[if IE]>
    <style type="text/css">
        .masked { overflow: visible; }
    </style>
<![endif]-->

<!--[if lt IE 9]>
<style>
    .my_layout_table .tr_td_last
    {
        border: 6px ridge #ccc;
    }

    .my_layout_table .td_first 
    {
        border: 6px ridge #ccc;
    }

    .my_layout_table .td_last {
        border: 6px ridge #ccc;
    }

    .ui-widget-overlay {
        position: fixed;  /* <---------- Fix for jQuery Dialog (avoids appearing of browser's scroll bars) */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
<![endif]-->

<!-- use gif image for IE -->
<!--[if lt IE 7]>
<style>
    .tooltip {
	    background-image:url(../Content/Images/Tools/black_arrow.png);
    }
</style>
<![endif]-->

<script type="text/javascript">
/*
    $(window).resize(function () {
        alert('resize :' + $('body').height().text());
        h = $('body').height() / 1.3;
        h = Math.floor(h) - 20;
        $('.td_first').prop('height', h + 'px');
    });
*/

    window.onresize = function () {
//        if (window.innerWidth && window.innerHeight) {
//            winW = window.innerWidth;
//            winH = window.innerHeight;
//        }


/*
        //alert('onresize :' + $('body').height());
        h = $('body').height() / 1.3;
        h = Math.floor(h) - 20;
        $('.my_layout_table tr:nth-child(1)').css('height', h + 'px');
        //$('.td_first').attr('height', h + 'px');
*/
    }

</script>


<script type="text/javascript">
    window.onload = function () {

        //alert('onload :' + $('wrapper').height());
        //alert('onload :' + $('.wrapper').height() + " / " + $('.my_layout_table').height() + " / " + $('#td_first').height() + " / " + $('#main').height());
        //alert('onload :' + $('#gr').height() + " / " + $('#gr2').height() + " / " + $('#gr3').height() + " / " + $('#myjqGrid').height());

        /*
        //alert('onload :' + $('body').height());
        h = $('body').height() / 1.3;
        h = Math.floor(h) - 20;
        //alert('onload :' + $('.my_layout_table tr').height());
        //$('.my_layout_tabl:nth-child(2)').children().css("border", "1px double red");
        $('.my_layout_table tr:nth-child(1)').css('height', h + 'px');
        */
        /*
        //$('#preload-gif').css('display', 'none');

        //$.unblockUI();

        h = $('body').height() / 1.3;
        //alert($('body').height());
        h = Math.floor(h) - 20;
        //alert(screen.availHeight);
        //alert(screen.height);
        //document.getElementById("td_first").style.height = h + "px";
        $('.td_first').attr('height', h + 'px');
        */
    }
</script>


<script type="text/javascript">

    $(document).ready(function () {
        //$('#preload-gif').css('display', 'none');

        //$.unblockUI();
        //$.blockUI.defaults.message = '<div id="blocking-div"><h2 style="padding-top:10px">Please wait...</h2></div>';
        $.blockUI.defaults.message = '<img src="/Content/Images/ajax-loader.gif"/>';
        $.blockUI.defaults.css.top = '3px';
        $.blockUI.defaults.css.left = '3px';
        $.blockUI.defaults.css.textAlign = 'left';
        $.blockUI.defaults.css.border = 'none';
        $.blockUI.defaults.css.backgroundColor = 'null';
        $.blockUI.defaults.overlayCSS.backgroundColor = '#383838';
        $.blockUI.defaults.centerX = false;
        $.blockUI.defaults.centerY = false;

        /*
        $.blockUI.defaults = {
        message: '<div id="blocking-div"><h2 style="padding-top:10px">Please wait...</h2></div>',
        css: {
        border: 'none',
        backgroundColor: '#e8e8e8'
        },

        overlayCSS: {
        backgroundColor: '#fff',
        opacity: 0.6
        }
        };

        //$.blockUI({ overlayCSS: { 'background-image': 'url(/Content/Images/stripe.png'} });

        //$.blockUI({ css: { "font-size": '.10em;', top: '20%', color: '#0f0', backgroundColor: '#f00'} });
        //$.blockUI({ overlayCSS: { backgroundColor: '#6ca5d1'} }); 
        //$.blockUI.defaults.overlayCSS.backgroundColor = '#f00';
        //$.unblockUI();

        //$.blockUI({ message: '<h1><img src="busy.gif" /> Just a moment...</h1>' });
        //$.blockUI({ css: { backgroundColor: '#f00', color: '#fff'} });
        //$('#myDiv').block({ message: 'Processing...' });

        */

        // Setup the ajax indicator  
        $('body').append('<div id="ajaxBusy"><img src="/Content/Images/ajax-loader.gif"></div>');
        $('#ajaxBusy').css({ display: "none", margin: "0px", paddingLeft: "0px", paddingRight: "0px", paddingTop: "0px", paddingBottom: "0px", position: "absolute", left: "3px", top: "3px", width: "auto" });
/*
        // Ajax activity indicator bound to ajax start/stop document events
        $(document).ajaxStart(function () {
            $('#ajaxBusy').show();
        }).ajaxStop(function () {
            $('#ajaxBusy').hide();
        });
*/
        $('#menu .content a').each(function () {
            if ($(this).attr('href') == "")
                $(this).css('color', '#585858');
        });

        //$('#button_bio').click(function (e) {
        //    $.blockUI();
        //}

        $('.content a, #dialog a, #button_bio').click(function (e) {
            //$('.content a, #dialog a, #button_camera').click(function () {
            //$('#info').text(this.id);
            //if (!$.browser.msie && this.id == 'button_camera')
            //    return;
            //if ($(this).is('button')) {
            //    alert("kuku");
            //    if (e.preventDefault) { e.preventDefault() }
            //}

            if ($(this).attr('href') != "" || $(this).is('button'))
                $.blockUI();
            else
                if (e.preventDefault) { e.preventDefault() }

            /*
            $('.wrapper').loading({
            align: 'top-left',
            img: '/Content/Images/loading.gif',
            text: 'Page Loading...',
            effect: 'update'
            //max: 200,
            //mask: true
            });
            */
        });
        /*
        $('#button_camera').click(function () {
        $('#info').text(this.id);
        if (!$.browser.msie && this.id == 'button_camera')
        return;
        });
        */
        $('.top_bar_menu').click(function (e) {
            if (e.preventDefault) { e.preventDefault() }
            //                else { e.stop() };

            //                e.returnValue = false;
            //                e.stopPropagation();
        });
        /*
        if (!$.browser.msie) {
        //$('#button_camera').prop('disabled', true);
        $('#anchor_camera').click(function (e) {
        if (e.preventDefault) { e.preventDefault() }
        return false;
        //else { e.stop() };

        //e.returnValue = false;
        //e.stopPropagation();
        });
        }
        */
    });
</script>

    <script type="text/javascript">
        var timeoutHnd;
        var isTimeoutExecuted = false;
        //var isEntered = false;
        $(document).ready(function () {
            $('#menu>li>ul').hide();
            $('#menu>li').hover(
                function (event) {
                    // event.type == "mouseenter"

                    //debugger;
                    //$('#info').text(event.type);
                    //$('input:text.items').val(function (index, value) {
                    //    return value + ' ' + this.className;
                    //});


                    //$('#info').text("E: ");

                    //if (isTimeoutExecuted)
                    //    return;

                    $currentTab = $(this);
                    if ($currentTab.find('a').length == 0)
                        return;

                    //aaa = $('this:empty');
                    //aaa = $('#menu>li:empty');

                    //$('#info').text('aa: ' + aaa);

                    //if ($(':empty'))
                    //    return;

                    //$('#info').text('aa2: ' + aaa);

                    //isEntered = true;

                    //$('#info').text("E2: " + isEntered);

                    $currentTab.addClass("activeTab");
                    isTimeoutExecuted = true;
                    timeoutHnd = setTimeout(function () { showMenu($currentTab); }, 300);

                    /*
                    if (event.type == "mouseleave") {
                    //debugger;
                    $currentTab.removeClass("activeTab");
                    if (timeoutHnd) {
                    clearTimeout(timeoutHnd);
                    } else {
                    $siblings = $currentTab.find('ul');
                    //if ($siblings.size() > 0)
                    $siblings.slideUp(250);
                    }
                    } else {  //mouseenter
                    $currentTab.addClass("activeTab");
                    timeoutHnd = setTimeout(function () { showMenu($currentTab); }, 100);
                    }
                    */
                },
                function (event) {
                    // event.type == "mouseleave"


                    //isEntered = false;

                    //$('#info').text("L: " + isEntered);

                    $currentTab = $(this);
                    $currentTab.removeClass("activeTab");
                    if (isTimeoutExecuted) {
                        clearTimeout(timeoutHnd);
                        isTimeoutExecuted = false;
                        //delete timeoutHnd;
                    } else {
                        //$('#info').text("L22: " + timeoutHnd);
                        $siblings = $currentTab.find('ul');
                        //$('#info').text("L2: " + $siblings.size());
                        if ($siblings.size() > 0)
                            $siblings.slideUp(250);
                    }

                }
            );

            function showMenu(currentTab) {
                isTimeoutExecuted = false;
                //$('#info').text("M: " + isEntered);

                //if (!isEntered)
                //    return;

                //$('#info').text("M2: " + isEntered);

                //                timeoutHnd = null;
                $currentTab = currentTab;
                $animated_tab = $('#menu ul:animated');
                var go = true;

                if (go) {
                    $content = $currentTab.find('ul');

                    if ($content.size() > 0 && $content.offset().left == 0) {
                        //var body = $(body).offset();
                        var pos = $currentTab.offset();
                        var height = $currentTab.height();
                        $content.css({ "left": pos.left + "px" });
                        //$content.css({ "left": pos.left + "px", "top": (pos.top - 10) + "px" });
                        //alert(content + ": " + v.left + " " + v.top);
                    }

                    $currentTab.addClass("activeTab");
                    $currentTab.find('ul').slideDown(250);
                }
            }
            /*
            $('#menu>li').mouseleave(function (event) {
            //debugger;

            $currentTab = $(this);
            $currentTab.removeClass("activeTab");

            $siblings = $currentTab.find('ul');
            //if ($siblings.size() > 0)
            $siblings.slideUp(250);
            });
            */
        });
    </script>  

    <style>
        body
        {
            color: #000;
            background-color:#c8c8c8;
            
            
        }

        #menu2
        {
            
        }
    </style>
 
</head>
<body>



        <div class="wrapper">
            
            


            <div>
                <div id="logindisplay" style="height:13px">
                    <div id="info" style="float:left;"></div>
                    
                </div>

                <script type="text/javascript">
                    //alert($('#logindisplay').height());
                </script>

                
                <div>
                    <ul id="menu">
                        <li>Sales BackOffice</li>
                        <li><a href="#" class="top_bar_menu">Sales Document Flow</a>
                            <ul class="content">  
                                <li><a href="/Contracts/Index/ImageHandler.ashx">Contracts / P.O.</a></li>  
                                <li><a href="">Contracts <small>(P.O. Details)</small></a></li>  
                                <li><a href="">Purchase Requisition</a></li>  
                                <li><a href="">Store Receipt Voucher</a></li>  
                                <li><a href="">Delivery Note</a></li>  
                                <li><a href="">Invoice</a></li>  
                                <li><a href="">Invoice Under Conditions</a></li>  
                                <li><a href="">Dummy Invoice</a></li>  
                                <li><a href="">Store Items</a></li>  
                            </ul>                          
                        </li>
                        <li><a href="#" class="top_bar_menu">Statistical Analysis</a>
                            <ul class="content">
                                <li><a href="">Sales Incentive</a></li>  
                                <li><a href="">Cost vs Profit</a></li>  
                                <li><a href="">Sales for Customers</a></li>  
                                <li><a href="">Sales by A/Managers</a></li>  
                                <li><a href="/PendingTransactions/Index/ImageHandler.ashx">Pending Purchase Requisitions</a></li>  
                                <li><a href="">Pending Store Reseipt Vouchers</a></li>  
                                <li><a href="">Pending Delivery Notes</a></li>  
                                <li><a href="">Outstanding Invoices</a></li>  
                                <li><a href="">Outstanding Contracts</a></li>  
                            </ul>                        
                        </li>
                        <li><a href="#" class="top_bar_menu">Reports</a>
                            <ul class="content">  
                                <li><a href="">Sales Incentive</a></li>  
                                <li><a href="">Cost vs Profit</a></li>  
                                <li><a href="">Sales for Customers</a></li>  
                                <li><a href="">Sales by A/Managers</a></li>  
                                <li><a href="">Purchase Requisitions</a></li>  
                                <li><a href="">Pending Purchase Requisitions</a></li>  
                                <li><a href="">Delivery Notes</a></li> 
                                <li><a href="">Invoices</a></li>  
                                <li><a href="">Outstanding Invoices</a></li>  
                                <li><a href="">Store Receipt Vouchers</a></li>  
                                <li><a href="">Closed Business</a></li>  
                                <li><a href="">Financial Report</a></li>  
                                <li><a href="">Supplier List</a></li>  
                                <li><a href="">FollowUp Report</a></li>  
                                <li><a href="">FollowUp (Conditional Invoice)</a></li>  
                                <li><a href="">Delivery Notes List</a></li>  
                                <li><a href="">Store Receipt Voucher List</a></li>  
                                <li><a href="">Contracts</a></li>  
                            </ul>                        
                        </li>
                        <li><a href="/Home/About">About</a></li>
                        <!--li><a href="#" id="_3" class="tab">Pages</a></li-->
                    </ul>
                </div>
            </div>

            <div style="height:85%">
                <div style="height:100%">
                    <table class="my_layout_table" style="table-layout:fixed; border-collapse: separate; height:100%">
                        <tr style="height:97%">
                            <td id="td_first" class="td_first" style="height:inherit; min-width:645px; width:auto; vertical-align:top;">
                                <div id="main" style="height:inherit; padding: 10px;">
                                    


<div id="div_pic" style="display:none">
    <img id="wanted-picture" alt="" height="200" width="200" style="float:left; padding-right:30px"/>
    <div id="animal" style="clear:right"></div>
    
</div>

<div id="div_wsq" style="display:none; margin-top:150px; clear:both">
    <table>
        <tr>
            <td><strong>LL</strong></td><td><strong>LR</strong></td><td><strong>LM</strong></td><td><strong>LI</strong></td>
            <td><strong>RI</strong></td><td><strong>RM</strong></td><td><strong>RR</strong></td><td><strong>RL</strong></td>
            <td><strong>TL</strong></td><td><strong>TR</strong></td>
        </tr>
        <tr>
            <td><img id="ll" class="wsq" title="Left little" alt="Left little" height="90" width="60" /></td>
            <td><img id="lr" class="wsq" title="Left ring" alt="Left ring" height="90" width="60" /></td>
            <td><img id="lm" class="wsq" title="Left middle" alt="Left middle" height="90" width="60" /></td>
            <td><img id="li" class="wsq" title="Left index" alt="Left index" height="90" width="60" /></td>
            <td><img id="ri" class="wsq" title="Right index" alt="Right index" height="90" width="60" /></td>
            <td><img id="rm" class="wsq" title="Right middle" alt="Right middle" height="90" width="60" /></td>
            <td><img id="rr" class="wsq" title="Right ring" alt="Right ring" height="90" width="60" /></td>
            <td><img id="rl" class="wsq" title="Right little" alt="Right little" height="90" width="60" /></td>
            <td><img id="lt" class="wsq" title="Left thumb" alt="Left thumb" height="90" width="60" /></td>
            <td><img id="rt" class="wsq" title="Right thumb" alt="Right thumb" height="90" width="60" /></td>


        </tr>
    </table>

    <div id="wsqDialog">
        <em id="wsqDialogText">click to close</em>
        <img id="wsqDialogImage" title="" alt="" />
    </div>

    <div id="pig" style="display:none">
        <em style="font-weight:bold; font-size:large; text-decoration:underline">PIG:</em>
        <br /><br />
        <span style="font-size:medium; text-decoration:underline">Name:</span><span style="font-weight:bolder; font-size:medium;"> “Napoleon”</span><br /><br />
        <span style="font-size:medium; text-decoration:underline">Title:</span><span style="font-weight:bolder; font-size:medium;"> Leader of operation “Animal Farm” after defeating his cofounder</span><br /><br />
        <span style="font-size:medium; text-decoration:underline">Accused:</span><span style="font-weight:bolder; font-size:medium;"> False statements, misinforming his comrades, abuse of power, murder, oppression of animal rights, sabotaging comrades, association with humans.</span>
    </div>

    <div id="rooster" style="display:none">
        <em style="font-weight:bold; font-size:large; text-decoration:underline">ROOSTER:</em>
        <br /><br />
        <span style="font-size:medium; text-decoration:underline">Name:</span><span style="font-weight:bolder; font-size:medium;"> “Alexandar”</span><br /><br />
        <span style="font-size:medium; text-decoration:underline">Title:</span><span style="font-weight:bolder; font-size:medium;"> Pen watchman</span><br /><br />
        <span style="font-size:medium; text-decoration:underline">Accused:</span><span style="font-weight:bolder; font-size:medium;"> Excessive noise pollution in domestic district, disturbance during after-hours.</span>
    </div>

    <div id="monkey" style="display:none">
        <em style="font-weight:bold; font-size:large; text-decoration:underline">MONKEY:</em>
        <br /><br />
        <span style="font-size:medium; text-decoration:underline">Name:</span><span style="font-weight:bolder; font-size:medium;"> “Bert”</span><br /><br />
        <span style="font-size:medium; text-decoration:underline">Title:</span><span style="font-weight:bolder; font-size:medium;"> Trained pick-pocket, former pet</span><br /><br />
        <span style="font-size:medium; text-decoration:underline">Accused:</span><span style="font-weight:bolder; font-size:medium;"> Small-scale street robbery, multiple attempts to retrieve fruits from street sellers, pick-pocketing.</span>
    </div>
</div>
                                </div>
                            </td>
                            <td class="td_last" style="height:inherit; width:300px; vertical-align:top;">
                                <div id="right_section" style="height:inherit; padding: 10px;">
                                    

<style type="text/css">
    #bio 
    {
        margin-left:auto;
        margin-right:auto;
    }

    #bio img 
    {
        vertical-align:middle;
        padding:8px;
        border:none;
    }
    
    .wsq 
    {
        margin:4px; 
        border:1px solid black;
    }
    
    #div_wsq td { text-align:center }
    
/*    
    #bio img strong
    {
       -moz-user-select: -moz-none; 
       -khtml-user-select: none; 
       -webkit-user-select: none; 
       user-select: none; 
    }  
*/    
</style>

<script type="text/javascript">
    var idImg = '';
    var urlImg = '/ImageHandler.ashx';
    var numImg = 10;

    $(function () {
        $('#wsqDialog').dialog({
            autoOpen: false,
            show: "slide",
            hide: "fadeOut",
            resizable: false,
            height: 'auto',
            width: 'auto',
            //height: 685,
            //width: 456,
            position: ['center','top'],
            //modal: true,
            buttons: {
            }
        });
    });

    $('.wsq').hover(
        function (event) {
            $current = $(this);
            ratio = $current[0].naturalHeight / $current[0].naturalWidth;
            height = Math.floor($current[0].naturalWidth / 1.5 * ratio);
            width = Math.floor($current[0].naturalWidth / 1.5);
            $('#wsqDialogImage').height(height);
            $('#wsqDialogImage').width(width);

            if (jQuery.browser.webkit) {
                $('#wsqDialog').dialog("option", "height", height + 55);
                $('#wsqDialog').dialog("option", "width", width + 35);
            } else {
                $('#wsqDialog').dialog("option", "height", height + 40);
                $('#wsqDialog').dialog("option", "width", width + 30);
            }

            //$('#wsqDialog').dialog("option", "height", height + 40);
            //$('#wsqDialog').dialog("option", "width", width + 30);

            $('#wsqDialogText').text("( " + $current.prop('title') + " )   click to close");
            //$('#wqsDialog').width(Math.floor($current[0].naturalWidth / 2));
            //$('#wqsDialog').height(Math.floor($current[0].naturalWidth / 2 * ratio));
            $('#wsqDialogImage').prop('src', $current.prop('src'));
            $('#wsqDialog').dialog('open');

            //$('#info').text('open');
        }, function (event) { }
    );

    $('#wsqDialog').click(
        function (event) {
            //$('#wsqDialogImage').removeProp('src');
            $('#wsqDialog').dialog("close");
            //$('#info').text('close');
        }
    );
/*
    $('#wsqDialog').hover(
        function (event) {
            //$('#info').text('open');
        },
        function (event) {
            $('#wsqDialogImage').removeProp('src');
            $('#wsqDialog').dialog("close");
            //$('#info').text('close');
        }
    );
*/
    $('.wsq').load(function () {
        if ($('#div_wsq').css('display') == 'none')
            $('#div_wsq').slideDown(500);

        if (--numImg == 0)
            $.unblockUI();
/*
            $.unblockUI(function(){
                $(':visible').each(function(idx, item) {
                        if($(item).css("cursor")) {
                            $(item).css("cursor", $(item).css("cursor"));
                        }
                });
            });
*/
        //$('#bio').css('cursor', 'default');
        //$('#info2').text(numImg.toString());
    })
    .error(function (e) {
        if ($('#div_wsq').css('display') == 'none')
            $('#div_wsq').slideDown(500);

        //$('#info').text(e.type);
        if (--numImg == 0)
            $.unblockUI();
    });

    $wanted_picture = $('#wanted-picture');
    $wanted_picture.load(function () {
        if (idImg == "id=103")
            $('#animal').html($('#pig').html())
        else if (idImg == "id=105")
            $('#animal').html($('#rooster').html())
        else if (idImg == "id=104")
            $('#animal').html($('#monkey').html())

        if ($('#div_pic').css('display') == 'none')
            $('#div_pic').slideDown(500);
        //if ($wanted_picture.parent.css('display') == 'none')
          //      $wanted_picture.parent.slideDown(500);
    });

    $(function () {
        //$('#accordionDiv').height($('#accordionDiv').height() - 125);
        //alert('kuku: ' + $('#accordionDiv').height());
        //$('#bio->li:first-child a img').css('padding-top', '4px');
        //$('#bio li a:hover').css({ 'color': 'blue' });
        $bio = $('#bio');
        $bio.css({ 'box-shadow': '2px 2px 4px #888', '-moz-box-shadow': '2px 2px 4px #888', '-webkit-box-shadow': '2px 2px 4px #888' });
        $bio.height($bio.parent().height());
        $bio.slideDown(500);

        var bio_li_background;
        $('#bio li').hover(
            function (event) {
                $current = $(this);
                bio_li_background = $current.css('background');
                $current.css('background', '#c8c8c8');
            },
            function (event) {
                //$current = $(this);
                $(this).css('background', bio_li_background);
            }
        );

        $('#bio li').click(function () {
            pic_src = $(this).children('img').prop('src');
            id = pic_src.substring(pic_src.lastIndexOf('id='));
            if (id == idImg)
                return;

            idImg = id;
            numImg = 10;

            if (jQuery.browser.mozilla)
                $.blockUI();
            else
                $.blockUI({
                    //timeout: 3000,
                    css: { cursor: 'default' },
                    overlayCSS: { cursor: 'default' }
                });

            //$wanted_picture = $('#wanted-picture');
            pic_src = $wanted_picture.prop('src');
            //alert(pic_src);
            if (pic_src == '') {
                $wanted_picture.prop('src', urlImg + '?' + id);
            } else {
                //str = pic_src.substring(0, pic_src.lastIndexOf('id=')) + id;
                $wanted_picture.prop('src', pic_src.substring(0, pic_src.lastIndexOf('id=')) + id);
                //alert(str);
            }

            $('.wsq').each(function () {
                pic_src = $(this).prop('src');
                if (pic_src == '')
                    $(this).prop('src', urlImg + '?wsq=' + $(this).prop('id') + '&' + id);
                else
                    $(this).prop('src', pic_src.substring(0, pic_src.lastIndexOf('id=')) + id);
            });


            //$('.wsq')[1].complete(function () {
            //    alert("complete 111");
            //});


            return false;
        });

    });

</script>

    <div style="border:0px solid red; height:inherit;">
        <ul id="bio" class="content" style="border:0px solid black; height:inherit; display:none; overflow:auto;">
            <li><img src="/ImageHandler.ashx?id=103" alt="" height="40" width="40" /><strong unselectable="on" class="unselectable">Pig</strong></li>
            <li><img src="/ImageHandler.ashx?id=105" alt="" height="40" width="40" /><strong unselectable="on" class="unselectable">Roost</strong></li>
            <li><img src="/ImageHandler.ashx?id=104" alt="" height="40" width="40" /><strong unselectable="on" class="unselectable">Monkey</strong></li>
        </ul>
        <div id="info2"></div>
    </div>


                                </div>
                            </td>
                        </tr>
                        <tr style="height:10%">
                            <td class="tr_td_last" colspan="2" style="height:48px; padding-left:5px; vertical-align:middle;">
                                <button id="button_home" type="button" title="Home Page" style="float:left;" 
                                    onclick="window.location = '/Home/Index'">
                                    <img alt="Home" src="/Content/Images/HomeHS.png" style="height:30px;"/>
                                </button>

                                <button id="button_camera" type="button" title="Video Camera ActiveX control (IE only)" style="float:left;">
                                    <img alt="Camera" src="/Content/Images/Camera.png" style="border-style:none"/>
                                </button>
                                

                                <button id="button_wizard" type="button" title="Wizard:<br/> - Application overview<br/> - Current application implementation"
                                    style="float:left;">
                                    <img alt="Wizard" src="/Content/Images/Wizard_Sparkle.png"/>
                                </button>

                                <button id="button_bio" type="button" title="Bio Page" style="float:left;"
                                    onclick="window.location = '/Bio/Index/ImageHandler.ashx'">
                                    <img alt="Home" src="/Content/Images/TheMostWanted.png" style="height:30px; width:100px;"/>
                                    <em style="font-weight:bold; font-size:larger">The most wanted!!!</em>
                                </button>
                            </td>
                        </tr>
                    </table>
                    <!--div style="height:10%; margin: 0 11px; box-shadow: 3px 3px 10px #666;"></div-->
                </div>
            </div>
            <!--div class="push"></div-->
        </div>

        <div id="footer">
            Copyright &copy; 2011 Telecom & Information Technology Group (TiTG). All rights reserved.
        </div>

	    <script type="text/javascript">
	        var numberOfWizardPages = 2;
	        var wizardPageNumber = 1;
	        var buttonBack, buttonNext;

	        function setButtonState() {
	            if (wizardPageNumber == 1) {
	                $(buttonBack).prop('disabled', true);
	                $(buttonNext).prop('disabled', false);
	            } else {
	                $(buttonBack).prop('disabled', false);
	                $(buttonNext).prop('disabled', true);
	            }
	        }

	        function navigateWizardPages() {
	            setButtonState();
	            if (wizardPageNumber == 1) {
	                $('#button_wizard').prop('title', 'Wizard - Application overview');
	                $('#wPage2').hide();
	                $('#wPage1').show(600, 'linear');
	                /*$('#wPage1').show(600, 'linear').animate({
	                    opacity: 0.25,
                        width: '+20'
                    }, 500);*/
	            } else if (wizardPageNumber == 2) {
	                $('#button_wizard').prop('title', 'Wizard - Current application implementation');
	                $('#wPage1').hide();
	                $('#wPage2').show(600, 'linear');
	            }
	        }

	        // increase the default animation speed to exaggerate the effect
	        $.fx.speeds._default = 1000;
	        $(function () {
	            //$('#button_wizard').css({ 'display': 'none' });
	            $('#button_camera, #button_wizard').tooltip({
	                //tip:'.tooltip',
                	effect:'fade',
	                fadeOutSpeed: 100,
                    predelay: 200
	                // tweak the position
	                //offset: [10, -30],
	                //effect: 'toggle',
                    //opacity: 0.9,
	                // use the "slide" effect
	                //effect: 'slide'
	                // add dynamic plugin with optional configuration for bottom edge
	            });

	            $('#button_wizard').click(function () {
	                navigateWizardPages();
	                $('#dialog').dialog('open');
	                //$(this).fadeOut(200);
	            });

	            $('#dialog').dialog({
	                autoOpen: false,
	                show: "slide",
	                hide: "fadeOut",
	                resizable: false,
	                height: 380,
	                width: 640,
	                //8position: ['left', 'top'],
	                position: ['center'],
	                modal: true,
	                //title: '<img id="image_wizard" style="float:left; alt="Wizard Dialog" src="/Content/Images/Wizard_Sparkle.png"/><span style="float:left; font-family:\'Trebuchet MS\'; font-style:oblique; font-size: 1.5em; margin-left:20px; margin-top:4px;">Wizard Dialog</span>',
	                buttons: {
	                    "< Back": function () {
	                        wizardPageNumber--;
	                        navigateWizardPages();
	                    },
	                    "Next >": function () {
	                        wizardPageNumber++;
	                        navigateWizardPages();
	                    },
	                    //"Finish": function () {
	                    //    $(this).dialog("close");
	                    //},
	                    Cancel: function () {
	                        $(this).dialog("close");
	                    }
	                },
	                close: function (event, ui) {
	                    //$('#button_wizard').fadeIn(100);
	                }
	            });

	            widget = $('#dialog').dialog("widget");
	            var arr = $(widget).find('.ui-button');
	            buttonBack = arr[0];
	            buttonNext = arr[1];

	            setButtonState();

	        });
        </script>


<!--
		<div class="ui-dialog-buttonset">
            <button aria-disabled="false" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" type="button">
                <span class="ui-button-text">&lt; Back</span>
            </button>
            <button aria-disabled="false" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover ui-state-focus" role="button" type="button">
                <span class="ui-button-text">Next &gt;</span>
            </button>
            <button aria-disabled="false" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" type="button">
                <span class="ui-button-text">Cancel</span>
            </button>
        </div>
-->



	            <script type="text/javascript">
	                $(function () {
	                    wizardPageNumber = 2;
	                    //$('#button_wizard').css({ 'display': 'block' }); 
	                });
                </script>

        <div id="dialog" style="padding:0">
            <div id="wPage1" style="display:none; padding:0 10px">
                <pre style="font-family:'Trebuchet MS'; font-size: 0.95em;">
The purpose of this web application is to complement an existing Windows application
that was created (and still running) 15 years ago for the Sales Department of one of a Kuwaiti company.
Another aim was to prove a concept of using the latest Microsoft and third party tools and technologies
to develop an MVC/jQuery application to serve as a front end for a legacy data. ( * )

The technologies and products involved:
    • Microsoft MVC 3 (Razor View Engine)
    • HTML 5 semantic, CCS 3
    • JQuery, JQuery UI Plugins
    • Microsoft SQL Server, Entity Framework, LINQ to SQL
    • Video streaming, Microsoft C++, DirectX technology
    • TDD, Visual Studio Unit Test Framework
    • Public Key Infrastructure
    • Windows Azure, SQL Azure

(*) The live data are being compromised on a transmission for a conspiracy reason.

Note: Currently Microsoft does not provide any Windows Azure support for the Middle East, so this application
is distributed across the datacenters in West Europe. As a result, it might introduce a slight delay.

Contact information:
(965)66486696 rid50@hotmail.com
Роман Давиденко / Roman Davidenko
                </pre>
            </div>
            <div id="wPage2" style="display:none; padding:10px 0 0 10px; border:0px solid black;">
                <div>
                    <a href='/Contracts/Index/ImageHandler.ashx'> 
                        <img class="image_wizarg_page" style="float:left; margin-right:15px" alt="" src="/Content/Images/Contracts160.png"/>
                    </a> 
                    <div style="border:0px solid red;">
                        <strong>Contract List Master/Detail Page</strong>
                        <hr />
                        The page allows for:
                        <blockquote style="margin-top:0;">
                            <ul style="list-style-type:circle; list-style-position:inside;" >
                                <li><em>Browse, edit and search for the contracts' records</em></li>
                                <li><em>Navigate through the contracts' details items</em></li>
                            </ul>
                        </blockquote>
                        A search option looks for 'Contract Id' and 'Contract Name' only.
                    </div>
                </div>
                <div style="margin-top:20px;">
                    <a href='/PendingTransactions/Index/ImageHandler.ashx'> 
                        <img class="image_wizarg_page" style="float:left; margin-right:15px" alt="" src="/Content/Images/PurchaseRequest160.png"/>
                    </a> 
                    <div style="border:0px solid red;">
                        <strong>Pending Purchase Order Request</strong>
                        <hr />
                        The goal of the page is to:
                        <blockquote style="margin-top:0;">
                            <ul style="list-style-type:circle; list-style-position:inside;" >
                                <li><em>Reviewing Pending Purchase Requisitions</em></li>
                                <li><em>Reporting on Pending and Processed Requisitions</em></li>
                            </ul>
                        </blockquote>
                        Since the data is outdated, the list shows all Purchase Requisitions<br/>
                        received by the Sales Department pending for necessary actions.
                    </div>
                </div><br /><br />
                <strong>(Click an image to open a page)</strong>
            </div>
        </div>

        <script src="/Scripts/cameraObjectScript.js" type="text/javascript"></script>
	    <script type="text/javascript">
	        $(function () {
	            /*
	            function notifyObserver() {
	            if (this.readyState = 'complete') {
	            alert('complete');
	            // object is loaded successfully
	            }
	            }
	            */

	            $('#button_camera').click(function () {
	                //alert(navigator.userAgent);
	                //if (!navigator.userAgent.match(/msie/i))
	                //    return;
	                //alert($.browser.msie);
	                //$('#info').text($.browser.msie);
	                //if (!$.browser.msie)
	                //    return;

	                if (!document.getElementById('myVideo')) {
	                    $('#camera_text').dialog('open');
	                    $('#camera_text').show();
	                } else
	                    OpenCamera();
	            });

	            //$('#button_camera').click(function () {
	            function OpenCamera() {
	                //alert($.browser.msie);
	                //$('#info').text($.browser.msie);
	                //if (!$.browser.msie)
	                //    return;

	                //$('#camera').prop('display', 'block');
	                $('#camera').dialog('open');
	                if (createCameraObject('/')) {

	                    //setTimeout(function () { document.getElementById('myVideo').style.display = 'block'; }, 1000);
	                    //setTimeout(function () { document.getElementById('myVideo').style.visibility = 'visible'; }, 1000);

	                    //document.getElementById('myVideo').style.display = 'block';
	                    //document.getElementById('myVideo').style.visibility = 'visible';
	                    //$('#myVideo').prop('display', 'block');

	                    try {
	                        //setTimeout(function () {
	                        document.getElementById('myVideo').style.visibility = 'visible';
	                        //}, 1000);
	                    } catch (err) { }

	                    try {
	                        //setTimeout(function () {
	                        //myVideo.StartAxVideoControl();
	                        //}, 1000);
	                    } catch (err) { }
	                }
	            }

	            $('#camera').dialog({
	                autoOpen: false,
	                //show: "slide",
	                hide: "fadeOut",
	                resizable: false,
	                height: 490,
	                width: 590,
	                position: ['left', 'top'],
	                //position: ['center'],
	                modal: true,
	                buttons: {
	                    Cancel: function () {
	                        $(this).dialog("close");
	                    }
	                },
	                close: function (event, ui) {
	                    try {
	                        myVideo.StopAxVideoControl();

	                        //if (document.getElementById('myVideo')) {
	                        //    cameraDiv = document.getElementById('camera');
	                        //    while (cameraDiv.firstChild) cameraDiv.removeChild(cameraDiv.firstChild);
	                        //}
	                    }
	                    catch (err) { }
	                    //$('#camera').prop('display', 'none');
	                }
	            });

	            $('#camera_text').dialog({
	                autoOpen: false,
	                //show: "slide",
	                hide: "fadeOut",
	                resizable: false,
	                height: 350,
	                width: 600,
	                position: ['left', 'top'],
	                //position: ['center'],
	                modal: true,
	                buttons: {
	                    Ok: function () {
	                        $(this).dialog("close");
	                        OpenCamera();
	                    },
	                    Cancel: function () {
	                        $(this).dialog("close");
	                    }
	                },
	                close: function (event, ui) {
	                }
	            });

	        });
        </script>

        <div id="camera" style="padding:0;">
        </div>

        <div id="camera_text" style="padding:0; display:none">

    <pre>

  <a href="/psc-com.cer">Download PSC Company, Kuwait Self-Signed Certificate (.cer file)</a><br />

  <b>First:</b>
  Just to experiment with a web camera, download the certificate and 
  install it (if you trust us) in Trusted Root Certification Authority.
  
  <b>Then:</b>
  Press button Ok.

  You can always uninstall the ActiveX Video Control using
  Control Panel > Programs and Features,
  the name of the installer is TiTGActiveXControlInstaller.

    </pre>


        </div>

        <script type="text/javascript">
            $(function () {
                //var height2 = '100px';
                $('#alert').dialog({
                    autoOpen: false,
                    show: "slide",
                    hide: "fadeOut",
                    //width: bodyWidth,
                    resizable: false,
                    //height: 100,
                    //width: 240,
                    //8position: ['left', 'top'],
                    //position: ['center'],
                    modal: true,
                    //title: '<span style="float:left; font-family:\'Trebuchet MS\'; font-style:oblique; font-size: 1.5em; margin-left:20px; margin-top:4px;">Server Error</span>',
                    buttons: {
                        Close: function () {
                            $(this).dialog("close");
                        }
                    },
                    close: function (event, ui) {
                        //$('#button_wizard').fadeIn(100);
                    }
                });

                $('.ui-widget-overlay').live("click", function () {
                    $("#alert").dialog("close");
                });

            });
        </script>

        <div id="alert" style="display:none">
            <div id="alertContent"></div>
        </div>
        
        <style type="text/css" media="screen">
            .ui-dialog { display:block; box-shadow: 2px 2px 4px #888; -moz-box-shadow: 2px 2px 4px #888; -webkit-box-shadow: 2px 2px 4px #888; }
            .ui-dialog { position: absolute; padding: .2em; width: 300px; overflow: hidden; }
            .ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative; display:none;}
            /*
            .ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; }
            .ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
            .ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
            .ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
            .ui-dialog .ui-dialog-content { position: relative; border: 0; padding: .5em 1em; background: none; overflow: auto; zoom: 1; }
            */
            .ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: 0; padding: 0; border: 0;}
            .ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { text-align:center; padding: 0.5em}

            /*.ui-dialog .ui-dialog-buttonpane button { margin: 0; cursor: pointer; text-align:center;width:100%; padding:10px 0px;background: #09F;border-radius: 8px;color: white;border-style: solid;border-color: #CCC;}*/
            /*.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }*/
            /*.ui-draggable .ui-dialog-titlebar { cursor: move;}*/
        </style>
        


        <div id="script_section">

            <script src="/Scripts/my-loader.js" type="text/javascript"></script>
            <script type="text/javascript">myScriptsGridInclude('cdn', '/');</script>

            <!--script src="http://cdn.jquerytools.org/1.2.5/tiny/jquery.tools.min.js" type="text/javascript"></script-->

            
            <script src="/Scripts/jqGridJs/i18n/grid.locale-en.js" type="text/javascript"></script>
            <script src="/Scripts/jqGridJs/jquery.jqGrid.min.js" type="text/javascript"></script>
            <script src="/Scripts/jqGridJs/grid.filtergrid.js" type="text/javascript"></script>




            <script src="/Scripts/jquery.blockUI.js" type="text/javascript"></script>

            <script sr