'use strict';

$(function () {
    let mainClass = '.countdown';
    let OffsetLocation = -4;

    let runningClass = '.running'; //optional
    let endedClass = ".ended"; //optional

    //init
    let startDate, endDate, fixTime, index = 0, extraClass, initText, zeroPad;
    $(mainClass).each(function () { //for each countdown instance
        index++;
        startDate = $(this).attr('data-StartDate');  // Use data-StartDate for program start
        endDate = $(this).attr('data-EndDate');      // Use data-EndDate for program end
        fixTime = $(this).attr('data-fixTime');
        zeroPad = $(this).attr('data-zeroPad');
        extraClass = 'd_' + index;

        $(this).addClass(extraClass); //add a class to recognize each counter
        $(this).css('display','block'); //allow to start hiding the class to avoid a bad effect until js is loading

        if (fixTime != undefined) startDate = getFixDate(fixTime);

        //get init text with or without an extra Class
        if ($('.' + extraClass + ' ' + runningClass + ' timer').length) {
            initText = $('.' + extraClass + ' ' + runningClass + ' timer').text();
        } else {
            initText = $(this).text();
        }
        //show and hide classes
        $('.' + extraClass + ' ' + runningClass).css('display', 'flex');
        $('.' + extraClass + ' ' + endedClass).css('display', 'none');

        //call main function
        dateReplace(extraClass, startDate, endDate, fixTime, initText, zeroPad); //prevent delay for the first time
        setInterval(dateReplace, 1000, extraClass, startDate, endDate, fixTime, initText, zeroPad);
    });

    function dateReplace(extraClass, startDate, endDate, fixTime, initText, zeroPad) {
        let startDif = timeDistance(startDate, fixTime);
        let endDif = timeDistance(endDate, fixTime);
        let text = initText;
        let zeroPadArr = [];

        if (startDif[0] < 0 || startDif[1] < 0 || startDif[2] < 0 || startDif[3] < 0) {
            // If program start time has passed, countdown to endDate
            if (endDif[0] < 0 || endDif[1] < 0 || endDif[2] < 0 || endDif[3] < 0) {
                // Program has ended
                let endText = $('.' + extraClass).attr('data-endText');
                if (endText != undefined) { //case data-endText attr
                    $('.' + extraClass).text(endText);
                } else { //case with two blocks
                    $('.' + extraClass + ' ' + runningClass).css('display', 'none');
                    $('.' + extraClass + ' ' + endedClass).css('display', 'flex');
                }
            } else {
                // Zero-pad for end date countdown
                if(zeroPad != undefined) zeroPadArr = JSON.parse(zeroPad);

                if (zeroPadArr['Days'] != "false") endDif[0] = String(endDif[0]).padStart(2, '0');
                if (zeroPadArr['Hours'] != "false") endDif[1] = String(endDif[1]).padStart(2, '0');
                if (zeroPadArr['Minutes'] != "false") endDif[2] = String(endDif[2]).padStart(2, '0');
                if (zeroPadArr['Seconds'] != "false") endDif[3] = String(endDif[3]).padStart(2, '0');

                //replace text with or without extra class
                if ($('.' + extraClass + ' ' + runningClass + ' timer').length) {
                    $('.' + extraClass + ' ' + runningClass + ' timer .days').text(endDif[0]);
                    $('.' + extraClass + ' ' + runningClass + ' timer .hours').text(endDif[1]);
                    $('.' + extraClass + ' ' + runningClass + ' timer .minutes').text(endDif[2]);
                    $('.' + extraClass + ' ' + runningClass + ' timer .seconds').text(endDif[3]);

                } else {
                    //replace parts without extra Class
                    text = text.replace('(days)', endDif[0]);
                    text = text.replace('(hours)', endDif[1]);
                    text = text.replace('(minutes)', endDif[2]);
                    text = text.replace('(seconds)', endDif[3]);
                    $('.' + extraClass).text(text);
                }
                pluralization(extraClass, endDif);
            }

        } else {
            // Program hasn't started yet, countdown to startDate
            if(zeroPad != undefined) zeroPadArr = JSON.parse(zeroPad);

            if (zeroPadArr['Days'] != "false") startDif[0] = String(startDif[0]).padStart(2, '0');
            if (zeroPadArr['Hours'] != "false") startDif[1] = String(startDif[1]).padStart(2, '0');
            if (zeroPadArr['Minutes'] != "false") startDif[2] = String(startDif[2]).padStart(2, '0');
            if (zeroPadArr['Seconds'] != "false") startDif[3] = String(startDif[3]).padStart(2, '0');

            if ($('.' + extraClass + ' ' + runningClass + ' timer').length) {
                $('.' + extraClass + ' ' + runningClass + ' timer .days').text(startDif[0]);
                $('.' + extraClass + ' ' + runningClass + ' timer .hours').text(startDif[1]);
                $('.' + extraClass + ' ' + runningClass + ' timer .minutes').text(startDif[2]);
                $('.' + extraClass + ' ' + runningClass + ' timer .seconds').text(startDif[3]);
            } else {
                //replace parts without extra Class
                text = text.replace('(days)', startDif[0]);
                text = text.replace('(hours)', startDif[1]);
                text = text.replace('(minutes)', startDif[2]);
                text = text.replace('(seconds)', startDif[3]);
                $('.' + extraClass).text(text);
            }
            pluralization(extraClass, startDif);
        }
    }

    function timeDistance(date, fixTime) {
        var date1 = new Date(date);
        let date2, d, utc;

        d = new Date();
        utc = d.getTime() + (d.getTimezoneOffset() * 60000);
        if (fixTime != undefined) date2 = new Date;
        else date2 = new Date(utc + (3600000 * OffsetLocation));

        var diff = date1.getTime() - date2;
        var msec = diff;
        var hh = Math.floor(msec / 1000 / 60 / 60);
        msec -= hh * 1000 * 60 * 60;
        var mm = Math.floor(msec / 1000 / 60);
        msec -= mm * 1000 * 60;
        var ss = Math.floor(msec / 1000);
        msec -= ss * 1000;
        var dd = Math.floor(hh / 24);
        if (dd > 0) {
            hh = hh - (dd * 24);
        }
        return [dd, hh, mm, ss];
    }

    function getFixDate(fixTime) {
        let getFixTimeDate = 0;

        var fixTimeDate = JSON.parse($('.' + extraClass).attr('data-fixTime'));
        if (fixTimeDate['Days'] != undefined) { getFixTimeDate += +fixTimeDate['Days'] * 60 * 24; }
        if (fixTimeDate['Hours'] != undefined) { getFixTimeDate += +fixTimeDate['Hours'] * 60; }
        if (fixTimeDate['Minutes'] != undefined) getFixTimeDate += +fixTimeDate['Minutes'];

        var now = new Date();
        now.setMinutes(now.getMinutes() + getFixTimeDate); // timestamp
        date = new Date(now); // Date object

        return date;
    }

    function replaceText(selector, text, newText, flags) {
        var matcher = new RegExp(text, flags);
        $(selector).each(function () {
            var $this = $(this);
            if (!$this.children().length)
                $this.text($this.text().replace(matcher, newText));
        });
    }

    function pluralization(extraClass, dif) {
        if (dif[0] == 1) replaceText('.' + extraClass, 'p_days', 'Day', 'g');
        else replaceText('.' + extraClass, 'p_days', 'Days', 'g');
        if (dif[1] == 1) replaceText('.' + extraClass, 'p_hours', 'Hour', 'g');
        else replaceText('.' + extraClass, 'p_hours', 'Hours', 'g');
        if (dif[2] == 1) replaceText('.' + extraClass, 'p_minutes', 'Minute', 'g');
        else replaceText('.' + extraClass, 'p_minutes', 'Minutes', 'g');
        if (dif[3] == 1) replaceText('.' + extraClass, 'p_seconds', 'Second', 'g');
        else replaceText('.' + extraClass, 'p_seconds', 'Seconds', 'g');
    }

});
