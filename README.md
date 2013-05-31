Open Source Codeigniter Survey Library
==========

OpenSource Contrib Survey App is a Codeigniter library to create and monitor web surveys. Its easy to install and use.

Installation

1. Copy application/libraries/contribsurvey.php to your codeigniter file system.
2. Get api key from http://www.developers.contrib.com 
3. In your controller, pass your api key when calling the contrib survey library.
   $this->load->library('contribsurvey',array("key"=>"xxxxxxxxxxxxxxxx"));

Contrib Survey Library Function Documentation

1. authenticate - authenticates user to use contrib survey application <br>
  return:<br>
        true (if authentication success)  <br>
        false (if authentication failed)<br>
            
2. gettemplates - get all survey templates<br>
  return:<br>
        array of template php filenames e.g array('AskPeopleDefault.php','CorporateBoxes.php','Floral.php',...)<br>

3. getqtypes - get all question types<br>
  return:<br>
        array of question types e.g. array('single','dropdown','multi',...) <br>

4. createsurvey - create new survey<br>
  parameter: <br> 
        template - (required) template filename<br>
        title - (required) title of survey<br>
  return:<br>
        array('success'=>true, 'sid'=>'xxxxx') - if survey created successfully<br>
        array('success'=>false) - if failed<br>
  possible error:<br>
        array('error'=> array('title parameter required','template parameter required')<br>
        
5. getsurveys - get all the list or surveys created<br>
  return:<br>
        array of survey id and title details e.g   array('sid'=>'xxxxx','title'=>'xxxxx','template'=>'Floral.php')<br>
             
6. addquestion - add a question in a survey<br>
  parameter:<br>
        sid - (required) survey id<br>
        qtype - (required)  question type (single, dropdown, multi,bigbox, smallbox,pagebreak, info)<br>
        qvalid - (required) validation (optional, required)<br>
        question - (required) survey question text<br>
        options - (required for Single/Dropdown/Multi question type) choices for question separated by (|)<br>
                  e.g. (a.Red|b.Blue|c.Green|d.Black)<br>        
  return:<br>
        true - if success<br>
        false - if failed<br>
   possible error:<br>
        array('error'=> array('invalid sid',
                              'sid parameter required',
                              'qtype parameter required',
                              'qvalid parameter required',
                              'question parameter required'
                        )<br>

7. getquestions - get all questions in a survey<br>
  parameter:<br>
        sid - (required) survey id<br>
  return:<br>
        array of question details object      <br>
        e.g array(1) {
        [0]=>
        object(stdClass)#16 (6) {
          ["questionid"]=>;
          string(1) "1"
          ["type"]=>
          string(6) "single"
          ["validation"]=>
          string(8) "optional"
          ["questiontext"]=>
          string(28) "What is your favorite color?"
          ["options"]=>
          object(stdClass)#17 (4) {
            ["a.Red"]=>
            string(5) "a.Red"
            ["b.Blue"]=>
            string(6) "b.Blue"
            ["c.Green"]=>
            string(7) "c.Green"
            ["d.Black"]=>
            string(7) "d.Black"
          }
          ["scale"]=>
          NULL
        }<br>
  possible error:<br>
        array('error'=> array('invalid sid')<br>
             
8. editsurvey - edit survey details<br>
  parameter:<br>
        sid - (required) survey id<br>
        title - (required) new survey title<br>
        template - (optional) template filename<br>
  return:<br>
        true - if edit successful<br>
        false - if failed<br>
  possible error:<br>
        array('error'=> array('invalid sid','sid parameter required','title parameter required')<br>

9. editquestion - edit question in a survey<br>
  parameter:<br>
        sid - (required) survey id<br>
        qid - (required) question id<br>
        qtype - (required)  question type (single, dropdown, multi,bigbox, smallbox,pagebreak, info)<br>
        qvalid - (required) validation (optional, required)<br>
        question - (required) survey question text<br>
        options - (required for Single/Dropdown/Multi question type) choices for question separated by (|)<br>
                  e.g. (a.Red|b.Blue|c.Green|d.Black)<br>
  return:<br>
        true - if edit successful<br>
        false - if failed<br>
        
  possible error:<br>
        array('error'=> array('invalid sid','invalid qid','sid parameter required','title parameter required')<br>


10. deletequestion - delete a question in a survey<br>
  parameter:<br>
        sid - (required) survey id<br>
        qid - (required) question id<br>
  return:<br>
        true - if delete successful<br>
        false - if failed<br>
  possible error:<br>
        array('error'=> array('invalid sid','invalid qid','sid parameter required','qid parameter required')<br>

11. deletesurvey - delete survey<br>
  parameter:<br>
        sid - (required) survey id<br>
  return:<br>
        true - if delete successful<br>
        false - if failed<br>
  possible error:<br>
        array('error'=> array('invalid sid','sid parameter required')<br>

12. getreport - get statistics/report of a survey<br>
  parameter:<br>
        sid - (required) survey id<br>
        qid - (optional) question id, default is 'all'<br>
  return:<br>
        array of question and answer details object<br>
        e.g <br>
    array(1) {
    [0]=>
    object(stdClass)#16 (5) {
      ["questionid"]=>
      string(1) "1"
      ["questiontext"]=>
      string(28) "What is your favorite color?"
      ["answered"]=>
      int(4)
      ["total"]=>
      int(4)
      ["stats"]=>
      array(4) {
        [0]=>
        object(stdClass)#17 (3) {
          ["option"]=>
          string(5) "a.Red"
          ["total"]=>
          int(2)
          ["percent"]=>
          string(3) "50%"
        }
        [1]=>
        object(stdClass)#18 (3) {
          ["option"]=>
          string(6) "b.Blue"
          ["total"]=>
          NULL
          ["percent"]=>
          NULL
        }
        [2]=>
        object(stdClass)#19 (3) {
          ["option"]=>
          string(7) "c.Green"
          ["total"]=>
          NULL
          ["percent"]=>
          NULL
        }
        [3]=>
        object(stdClass)#20 (3) {
          ["option"]=>
          string(7) "d.Black"
          ["total"]=>
          NULL
          ["percent"]=>
          NULL
        }
      }
    }         
   } 
   
  possible error:<br>
        array('error'=> array('invalid sid')<br>
           
List of general errors
   
    array('error'=> array(
      'Api key required',
      'Invalid api key',
      'Request not allowed'
    )	  
