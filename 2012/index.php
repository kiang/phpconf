<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <script language="Javascript" type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
    <script language="Javascript" type="text/javascript" src="js/jquery.countdown.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PHPConf 2012</title>
    <style type="text/css">
        body {
            background: url(img/layout_120802.jpg) no-repeat;
        }
        br { clear: both; }
        .cntSeparator {
            font-size: 54px;
            margin: 10px 7px;
            color: #000;
            width: 64px;
        }
        #counterContainer {
            padding-top: 593px;
            padding-left: 624px;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            var now = new Date();
            var startTime = new Date(2012,10,3,9,0,0);
            var diff = Math.ceil((startTime.getTime() - now.getTime()) / 1000);
            var seconds = diff % 60;
            var leftMinutes = (diff-seconds)/60;
            var minutes = leftMinutes % 60;
            var leftHours = (leftMinutes-minutes)/60;
            var hours = leftHours % 24;
            var days = (leftHours-hours)/24;

            if (0 == seconds) seconds = '00';
            else {
                seconds = seconds.toString();
                if (1 == seconds.length) seconds = '0' + seconds;
            }
            if (0 == minutes) minutes = '00';
            else {
                minutes = minutes.toString();
                if (1 == minutes.length) minutes = '0' + minutes;
            }
            if (0 == hours) hours = '00';
            else {
                hours = hours.toString();
                if (1 == hours.length) hours = '0' + hours;
            }
            if (0 == days) days = '00';
            else {
                days = days.toString();
                if (1 == days.length) days = '0' + days;
            }

            var countDownStartTime = days + ' ' + hours.toString() + ' ' + minutes.toString() + ' ' + seconds.toString();

            console.log(diff);
            console.log(countDownStartTime);
            $('#counter').countdown( {
                image: 'img/digits.png',
                startTime: countDownStartTime,
                timerEnd: function () { alert('end!'); },
                format: 'dd:hh:mm:ss'
            });
        });
    </script>
</head>

<body>

<div id="counterContainer">
    <div id="counter"></div>
</div>

</body>

</html>
<!-- <?php echo date('Y-m-d H:i:s'); ?> -->