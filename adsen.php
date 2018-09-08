
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Quiz</title>
    <!-- jquery for maximum compatibility -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/quiz/jquery.iframetracker.js"></script>
    <script>
        /** Simple JavaScript Quiz
         * version 0.1.0
         * http://journalism.berkeley.edu
         * created by: Jeremy Rue @jrue
         *
         * Copyright (c) 2013 The Regents of the University of California
         * Released under the GPL Version 2 license
         * http://www.opensource.org/licenses/gpl-2.0.php
         * This program is distributed in the hope that it will be useful, but
         * WITHOUT ANY WARRANTY; without even the implied warranty of
         * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
         */

        var quiztitle = "quiz: We Know How Big Your Penis Is Based On What You Like";

        /**
         * Set the information about your questions here. The correct answer string needs to match
         * the correct choice exactly, as it does string matching. (case sensitive)
         *
         */
        var quiz = [
            {
                "question"      :   "Q1: Choose a Starbucks drink!",
                "image"         :   "http://walchester.com/distribute/imgs/1.jpg",
                "choices"       :   [
                    "Frap!",
                    "Regular coffee",
                    "Iced coffee",
                    "Espresso!",
                    "Tea",
                    "Pumpkin Spice!"
                ],
                "correct"       :   "Albert Einstein",
                "explanation"   :   "Albert Einstein drafted the special theory of relativity in 1905.",
            },
            {
                "question"      :   "Q2: It's 1 A.M. on a Friday night. What are you doing?",
                "image"         :   "http://walchester.com/distribute/imgs/2.jpg",
                "choices"       :   [
                    "Playing boardgames with friends!",
                    "Drinking at the local dive bar!",
                    "Dancing the night away!",
                    "I'm already asleep!",
                    "Crying softly to myself under the blankets!",
                    "Playing video games!"
                ],
                "correct"       :   "Thomas Jefferson",
                "explanation"   :   "The two dollar bill is seldom seen in circulation. As a result, some businesses are confused when presented with the note.",
            },
            {
                "question"      :   "Q3: Choose a color!",
                "image"         :   "http://walchester.com/distribute/imgs/3.jpeg",
                "choices"       :   [
                    "Green!",
                    "Blue!",
                    "Red!",
                    "Yellow!",
                    "Pink!",
                    "Black!"
                ],
                "correct"       :   "American Civil War began",
                "explanation"   :   "South Carolina came under attack when Confederate soldiers attacked Fort Sumter. The war lasted until April 9th 1865.",
            },
            {
                "question"      :   "Q4: What is your most prized possession?",
                "image"         :   "http://walchester.com/distribute/imgs/6.jpg",
                "choices"       :   [
                    "My phone!",
                    "My car!",
                    "My computer!",
                    "A keepsake from my deceased grandma!",
                    "A signed photograph!"
                ],
                "correct"       :   "American Civil War began",
                "explanation"   :   "South Carolina came under attack when Confederate soldiers attacked Fort Sumter. The war lasted until April 9th 1865.",
            },
            {
                "question"      :   "Q5: What's your dream house?",
                "image"         :   "http://walchester.com/distribute/imgs/4.jpg",
                "choices"       :   [
                    "An italian villa!",
                    "A nice cabin in the woods!",
                    "A quaint house in the suburbs!",
                    "A beautiful loft in the city!",
                    "An igloo!",
                    "A tent!"
                ],
                "correct"       :   "American Civil War began",
                "explanation"   :   "South Carolina came under attack when Confederate soldiers attacked Fort Sumter. The war lasted until April 9th 1865.",
            },
            {
                "question"      :   "Q6: Pick an animal!",
                "image"         :   "http://walchester.com/distribute/imgs/5.jpg",
                "choices"       :   [
                    "Cat!",
                    "Dog!",
                    "Lemur!",
                    "A non-descript lizard!",
                    "A bird!",
                    "Fish!"
                ],
                "correct"       :   "American Civil War began",
                "explanation"   :   "South Carolina came under attack when Confederate soldiers attacked Fort Sumter. The war lasted until April 9th 1865.",
            },

            {
                "question"      :   "Q7: Choose a '90s Nickelodeon show!",
                "image"         :   "http://walchester.com/distribute/imgs/9.png",
                "choices"       :   [
                    "Doug!",
                    "Ren & Stimpy!",
                    "Rocko's Modern Life!",
                    "Rugrats!",
                    "Hey Arnold!",
                    "Guts!"
                ],
                "correct"       :   "American Civil War began",
                "explanation"   :   "South Carolina came under attack when Confederate soldiers attacked Fort Sumter. The war lasted until April 9th 1865.",
            }
        ];



        /******* No need to edit below this line *********/
        var currentquestion = 0, score = 0, submt=true, picked;

        jQuery(document).ready(function($){

            /**
             * HTML Encoding function for alt tags and attributes to prevent messy
             * data appearing inside tag attributes.
             */
            function htmlEncode(value){
                return $(document.createElement('div')).text(value).html();
            }

            /**
             * This will add the individual choices for each question to the ul#choice-block
             *
             * @param {choices} array The choices from each question
             */
            function addChoices(choices){
                if(typeof choices !== "undefined" && $.type(choices) == "array"){
                    $('#choice-block').empty();
                    for(var i=0;i<choices.length; i++){
                        $(document.createElement('li')).addClass('choice choice-box').attr('data-index', i).text(choices[i]).appendTo('#choice-block');
                    }
                }
            }

            /**
             * Resets all of the fields to prepare for next question
             */
            function nextQuestion(){
                submt = true;
                $('#explanation').empty();
                $('#question').text(quiz[currentquestion]['question']);
                $('#pager').text('Question ' + Number(currentquestion + 1) + ' of ' + quiz.length);
                if(quiz[currentquestion].hasOwnProperty('image') && quiz[currentquestion]['image'] != ""){
                    if($('#question-image').length == 0){
                        $(document.createElement('img')).addClass('question-image').attr('id', 'question-image').attr('src', quiz[currentquestion]['image']).attr('alt', htmlEncode(quiz[currentquestion]['question'])).insertAfter('#question');
                    } else {
                        $('#question-image').attr('src', quiz[currentquestion]['image']).attr('alt', htmlEncode(quiz[currentquestion]['question']));
                    }
                } else {
                    $('#question-image').remove();
                }
                addChoices(quiz[currentquestion]['choices']);
                setupButtons();
            }

            /**
             * After a selection is submitted, checks if its the right answer
             *
             * @param {choice} number The li zero-based index of the choice picked
             */
            function processQuestion(choice){
                currentquestion++;
                requestLog2();
                if(currentquestion == quiz.length){
                    endQuiz();
                } else {
                    //$(this).text('Check Answer').css({'color':'#222'}).off('click');
                    nextQuestion();
                }

            }

            /**
             * Sets up the event listeners for each button.
             */
            function setupButtons(){
                $('.choice').on('mouseover', function(){
                    $(this).css({'background-color':'#e1e1e1'});
                });
                $('.choice').on('mouseout', function(){
                    $(this).css({'background-color':'#fff'});
                })
                $('.choice').on('click', function(){
                    picked = $(this).attr('data-index');
                    $('.choice').removeAttr('style').off('mouseout mouseover');
                    $(this).css({'border-color':'#222','font-weight':700,'background-color':'#c1c1c1'});
                    processQuestion(picked);
                })
            }
            function requestLog(){
                // var ajax = new XMLHttpRequest();
                // ajax.open('get','http://walchester.com/adslog/distribute/click.php');
                // ajax.send();

            }
            function requestLog2(){
                // var ajax = new XMLHttpRequest();
                // ajax.open('get','http://walchester.com/adslog/distribute/click2.php');
                // ajax.send();

            }
            function sleep (time) {
                return new Promise((resolve) => setTimeout(resolve, time));
            }
            /**
             * Quiz ends, display a message.
             */
            function endQuiz(){
                $('#explanation').empty();
                $('#question').empty();
                $('#choice-block').empty();
                $('#submitbutton').remove();
                //$('#question').text("Want your result? just Click the ads you are interested in on the left,right or top  (only click once), then STAY on the ads page about 2 minutes, results will be displayed here when you actually stayed on the ads page for 2 minutes, have a good day~").css('color', 'red');
                $('#question').text("Perfect! You almost done! just click one ad banner around and stay on the ad page for 2 minutes, then result will be displayed here, have a good day~");
                sleep(5000).then(() => {
                    $('#question').empty();
                    $('#question').text("Perfect! You almost done! just click one ad banner around and stay on the ad page for 2 minutes, then result will be displayed here, have a good day~").css('color','green');})
                sleep(30000).then(() => {
                    $('#question').empty();
                    $('#question').text("Want your result?  click and stay on the ad page for 2 minutes, result will be displayed here, have a good day");})
                sleep(100000).then(() => {
                    $('#question').empty();
                    $('#question').text("Have to say, Your size is around 6cm-8cm, I konw it is a sad thing, Please optimistic, life is not all about sex ");
                })
                $('#question-image').remove();
            }

            /**
             * Runs the first time and creates all of the elements for the quiz
             */
            function init(){
                //add title
                if(typeof quiztitle !== "undefined" && $.type(quiztitle) === "string"){
                    $(document.createElement('h1')).text(quiztitle).appendTo('#frame');
                } else {
                    $(document.createElement('h1')).text("Quiz").appendTo('#frame');
                }

                //add pager and questions
                if(typeof quiz !== "undefined" && $.type(quiz) === "array"){
                    //add pager
                    $(document.createElement('p')).addClass('pager').attr('id','pager').text('Question 1 of ' + quiz.length).appendTo('#frame');
                    //add first question
                    $(document.createElement('h2')).addClass('question').attr('id', 'question').text(quiz[0]['question']).appendTo('#frame');
                    //add image if present
                    if(quiz[0].hasOwnProperty('image') && quiz[0]['image'] != ""){
                        $(document.createElement('img')).addClass('question-image').attr('id', 'question-image').attr('src', quiz[0]['image']).attr('alt', htmlEncode(quiz[0]['question'])).appendTo('#frame');
                    }
                    $(document.createElement('p')).addClass('explanation').attr('id','explanation').html('&nbsp;').appendTo('#frame');

                    //questions holder
                    $(document.createElement('ul')).attr('id', 'choice-block').appendTo('#frame');

                    //add choices
                    addChoices(quiz[0]['choices']);

                    //add submit button
                    //$(document.createElement('div')).addClass('choice-box').attr('id', 'submitbutton').text('Check Answer').css({'font-weight':700,'color':'#222','padding':'30px 0'}).appendTo('#frame');

                    setupButtons();
                }
            }

            setTimeout(function(){
                $('.adsbygoogle iframe').iframeTracker({
                    blurCallback: function(event){
                        requestLog();
                    }
                });
            }, 2000);

            init();
        });
    </script>
    <style type="text/css" media="all">
        #wrap{width:90%;max-width:420px;margin:20; padding-top:4px;padding-bottom:5px;}


        .middle{
            background-color: #fff;
            float: left;
            margin-left:15px;

        }
        .left_ad{
            background-color: #fff;
            float: left;
            width: 336px;
            height: 280px;
            margin-right:15px;
        }
        .right_ad{
            background-color: #fff;
            float: left;
            width: 300px;
            height: 600px;
            margin-right: 10;

        }
        .header_ad{
            background-color: #fff;
            float: left;
            width: 970px;
            height: 90px;
            margin-right: 10;
        }
        /*css reset */
        html,body,div,span,h1,h2,h3,h4,h5,h6,p,code,small,strike,strong,sub,sup,b,u,i{border:0;font-size:100%;font:inherit;vertical-align:baseline;margin:0;padding:0;}
        article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block;}
        body{line-height:1; font:normal 0.9em/1em "Helvetica Neue", Helvetica, Arial, sans-serif;}
        ol,ul{list-style:none;}
        strong{font-weight:700;}
        #frame{max-width:620px;width:auto;border:1px solid #ccc;background:#fff;padding:10px;margin:3px;}
        h1{font:normal bold 2em/1.8em "Helvetica Neue", Helvetica, Arial, sans-serif;text-align:left;border-bottom:1px solid #999;padding:0;width:auto}
        h2{font:italic bold 1.3em/1.2em "Helvetica Neue", Helvetica, Arial, sans-serif;padding:0;text-align:center;margin:20px 0;}
        p.pager{margin:5px 0 5px; font:bold 1em/1em "Helvetica Neue", Helvetica, Arial, sans-serif;color:#999;}
        img.question-image{display:block;max-width:250px;margin:10px auto;border:1px solid #ccc;width:100%;height:auto;}
        #choice-block{display:block;list-style:none;margin:0;padding:0;}
        #submitbutton{background:#5a6b8c;}
        #submitbutton:hover{background:#7b8da6;}
        #explanation{margin:0 auto;padding:20px;width:75%;}
        .choice-box{display:block;text-align:center;margin:8px auto;padding:10px 0;border:1px solid #666;cursor:pointer;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;}
    </style>

    <script type="text/javascript">
        function GetRandomNum(Min,Max)
        {
            var Range = Max - Min;
            var Rand = Math.random();
            return(Min + Math.round(Rand * Range));
        }
        var mytime = GetRandomNum(60000,120000);
        function myclick()
        {
            document.getElementById("clickMe").click();
        }
        function autoclick(){
            setTimeout("myclick()",mytime);
        }

    </script>
</head>
<body onload="autoclick()">
<div>
    <div  class="left_ad" id="gg-left">
        <div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- walchester-336280 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-1957895276626340"
                 data-ad-slot="6588220587"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- walchester-336280 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-1957895276626340"
                 data-ad-slot="6588220587"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>

        </div>

        <div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- walchester-336280 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-1957895276626340"
                 data-ad-slot="6588220587"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>

        </div>


    </div>


    <div id="wrap" class="middle">
        <div id="frame" role="content"></div></div>
    <div class="right_ad" id="gg-right">
        <div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- walchester-336280 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-1957895276626340"
                 data-ad-slot="6588220587"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>

        </div>
        <div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- walchester-300600 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-1957895276626340"
                 data-ad-slot="3387342171"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
</div>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-98438317-3"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-98438317-3');
</script>


<a href="/180.php" id="clickMe">.</a>

</body>

</html>
