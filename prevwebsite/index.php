        <?php 
        $page_title = 'It\'s Timothycated';
        include('../includes_4both/header.php');
        ?>
    <div style="display: flex; align-items: center; justify-content: space-between;">
    >
            <!--style="display: inline-block;" didn't work...?! Seemed to be related to fact it was a H1. H1s
            seem to push whatever is by it to the next row. This way of doing things tells it to NOT do that.
            Chat suggested the flexbox thing...This seems to be the correct way to do things now...-->

            <img src="/includes_4both/logo.jpeg" alt="Site logo." style="height:25%; width: 25%; float: left"> <!--Test what it does without float later and see what happens.!-->
            <div>
                <h1 class="title" id="topOfPage">Hello, and welcome to Timothy's website for CSC 4060!</h1>
                <p style="text-align: center">This is the place where I show off all of my newfound CSS, JS, PHP, and HTML skills, as well as link to the special project I worked
                    on for this class. Enjoy!
                </p>
            </div>
            <img src="/includes_4both/logo.jpeg" alt="Site logo." style="height:25%; width: 25%; float: right"> <!--Test what it does without float later and see what happens.!-->
        </div>
        <br>
        <div>
            <!--The classic way of doing float. It's kinda finniky...Does NOT work with headers!-->
            <p id="almostTopOfPage" style="display: inline-block;" class="styled-boxed-para">Playin' with float, the classic way.</p>
            <img src="/includes_4both/logo.jpeg" alt="Site logo." style="height:25%; width: 25%; float: right">
        </div>
        <br>
        <!--clear: both = no floating things on either side of me!-->
        <p class="p.styled-boxed-para" style="clear:both">This is a website where I'm going to showcase all of the cool things I learn in this class! This section
        is showcasing the p tag.</p>
        <p style="float: right">Before we move on, admire the break between this paragraph and the last one. Cool, right?
        Yup. The br tag. <b><i><u>Any guesses what this section is showcasing?</u></i></b> You got it! The right align and text formatting
        options in HTML.</p>
        <br>
        <h1>H1 is the biggest heading in HTML.</h1>
        <p class="styled-boxed-para">He is styled with the mighty CSS.</p>
        <h2 style="color:darkolivegreen">H2 comes in second. He's styled with plain old HTML.</h2>
        <h3>H3 rounds the corner just in time to grab a respectable 3rd place.</h3>
        <h4>You can probably guess where h4 fits in here.</h4>
        <h5>H5 is small, but boy is he mighty!</h5>
        <h6>H6. Last but not least!</h6>
        <hr WIDTH = 75% align=center> <!--This is a line. Oh, and this this? A comment. !-->    
        <pre>
        Pre
         Lets
          Me
           Format
            Text
             Just
              Like
               I
                Type
                 It
                  In
                   The
                    HTML.
        </pre>
        <br>
        <p class="styled-boxed-para"><font face="courier">Here's some text with a different font!</font></p>
        <h4 align=left>Foods I love</h4>
        <ul type=square>
            <li>Mom's chicken enchiladas.</li>
            <li>Nuts</li>
            <li>Cheeseburgers</li>
        </ul>
        <h4>Sibling names:</h4>
        <ol type=i>
            <li>Me!</li>
            <li>Josiah</li>
            <li>Nathanael</li>
            <li>Catherine</li>
            <li>Gregory</li>
            <li>Isaiah</li>
        </ol>
        <dl>
            <dt style="color:darkgreen">Timothycated</dt>
                <dd>When Timothy is explaining something to you and you had no idea it could possibly
                    be so complicated.</dd>
        </dl>        
                Kool sites:
        <a href="https://techradar.com" target="_blank">TechRadar</a>
        <p class="styled-boxed-para">Note: The above link will open a FANCY SCHMANCY WHOLE NEW TAB! Wowza!</p>
        To email Dr. Wahl:
        <a href="mailto:robert.wahl@cuw.edu">Email Dr. Wahl!</a>
        <br>
        First name: <input type = "text" name ="FirstName" value = "First name" size = "20">
        <br>
        <b>Comments? Feel free to yell into the void.</b>
        <br>
        <textarea name="Comments" rows="3" cols=40 wrap></textarea>
        <br>
        <input type="radio" name="radioButton1" value="daaata">This is an example of a radio button!
        <input type="radio" name="radioButton2" value="daaata">This is an example of another radio button!
        <br>
        <input type="checkbox" name="checkme" >Checking, checking, 1,2,3...
        <br>
        <label for="cars">Choose a car:</label>

        <select name="cars" id="cars">
          <option value="volvo">Ford Econoline 12-passenger van</option>
          <option value="saab">2016 Chevy Equinox</option>
          <option value="mercedes">Minivan</option>
          <option value="audi">Tesla Model 3</option>
        </select>
        <br>
        <input type="submit" value="Submit answer!">
        <input type="reset" value="Reset me.">
        <br>
        
        <table border=5>
            <tr>
                <td>Mike</td>
                <td>Felicia</td>
            </tr>
            <tr>
                <td>Litman</td>
                <td>Conner</td>
            </tr>
        </table>
        
        
        
        <br>
        <div style="text-align: center;">
<!--         <h1>Chapter 1 scripts</h1>
        <a href="/ch01/hello.php">hello.php</a>
        <br>
        <a href="/ch01/test.php">test.php</a>
        <br>        
        <a href="/ch01/hello.php">hello.php</a>
        <br>        
        <a href="/ch01/second.php">second.php</a>
        <br>
        <a href="/ch01/strings.php">strings.php</a>
        <br>
        <a href="/ch01/concat.php">concat.php</a>
        <br>
        <a href="/ch01/comments.php">comments.php</a>
        <br>
        <a href="/ch01/constants.php">constants.php</a>
        <br>
        <a href="/ch01/predefined.php">predefined.php</a>
        <br>
        <a href="/ch01/numbers.php">numbers.php</a>
        <br>
        <a href="/ch01/quotes.php">quotes.php</a>
        <br>
        <h1>Chapter 2 scripts</h1>
        <a href="/ch02/ch02/multi.php">multi.php</a>
        <br>    
        <a href="/ch02/ch02/calendar.php">calendar.php</a>
        <br>
        <a href="/ch02/ch02/sorting.php">sorting.php</a>
        <br>
        <a href="/ch02/ch02/form.html">form.html</a>
        <br>
        <h1>My special function for Week 5</h1>
            <a href="myNameDatePrintingFunction.php">myFunction.php</a> -->
            <h1>Chapter 1 scripts</h1>
        <a href="../includes_4both/ch01/hello.php">hello.php</a>
        <br>
        <a href="../includes_4both/ch01/test.php">test.php</a>
        <br>        
        <a href="../includes_4both/ch01/hello.php">hello.php</a>
        <br>        
        <a href="../includes_4both/ch01/second.php">second.php</a>
        <br>
        <a href="../includes_4both/ch01/strings.php">strings.php</a>
        <br>
        <a href="../includes_4both/ch01/concat.php">concat.php</a>
        <br>
        <a href="../includes_4both/ch01/comments.php">comments.php</a>
        <br>
        <a href="../includes_4both/ch01/constants.php">constants.php</a>
        <br>
        <a href="../includes_4both/ch01/predefined.php">predefined.php</a>
        <br>
        <a href="../includes_4both/ch01/numbers.php">numbers.php</a>
        <br>
        <a href="../includes_4both/ch01/quotes.php">quotes.php</a>
        <br>
        <h1>Chapter 2 scripts</h1>
        <a href="../includes_4both/ch02/ch02/multi.php">multi.php</a>
        <br>    
        <a href="../includes_4both/ch02/ch02/calendar.php">calendar.php</a>
        <br>
        <a href="../includes_4both/ch02/ch02/sorting.php">sorting.php</a>
        <br>
        <a href="../includes_4both/ch02/ch02/form.html">form.html</a>
        <br>
        <h1>My special function for Week 5</h1>
        <a href="../includes_4both/myNameDatePrintingFunction.php">myFunction.php</a>

        <h1>Link to project, in case you missed the one in the header.</h1>
        <a href="/project/viewSchedule.php">Organ scheduler (my project for this class!)</ahref>
        <?
        //My own itty bitty PHP function!
        function printHello(){
            print('Hello from my PHP function!'); //remember, you can always return this value also
        }
        printHello();
        ?>
        </div>
        <!--This is my footer!-->
        <br>
        <?php include ('../includes_4both/footer.php');?>

  <!--  </body>
</html>!-->
