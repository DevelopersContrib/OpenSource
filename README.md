OpenSource
==========

OpenSource Contrib Survey App

Installation

1. Copy application/libraries/contribsurvey.php to your codeigniter file system.
2. Get api key from http://www.developers.contrib.com 
3. In your controller, pass your api key when calling the contrib survey library.
   $this->load->library('contribsurvey',array("key"=>"xxxxxxxxxxxxxxxx"));

Contrib Survey Library Function Documentation

1. authenticate - authenticates user to use contrib survey application 
  return:<br>
        true (if authentication success)  
        false (if authentication failed)
            
2. gettemplates - get all survey templates
  return:<br>
        array of template php filenames e.g array('AskPeopleDefault.php','CorporateBoxes.php','Floral.php',...)

3. getqtypes - get all question types
  return:
        array of question types e.g. array('single','dropdown','multi',...) 

4. createsurvey - create new survey
  parameter:  
        template - (required) template filename
        title - (required) title of survey
  return:
        true - if survey created successfully
        false - if failed
  possible error:
        array('error'=> array('title parameter required','template parameter required')
        
5. getsurveys - get all the list or surveys created
  return:
        array of survey id and title details e.g   array('sid'=>'xxxxx','title'=>'xxxxx')
             
6. addquestion - add a question in a survey
  parameter:
        sid - (required) survey id
        qtype - (required)  question type (single, dropdown, multi,bigbox, smallbox,pagebreak, info)
        qvalid - (required) validation (optional, required)
        question - (required) survey question text
        options - (required for Single/Dropdown/Multi question type) choices for question separated by (|)
                  e.g. (a.Red|b.Blue|c.Green|d.Black)        
  return:
        true - if success
        false - if failed
   possible error:
        array('error'=> array('invalid sid',
                              'sid parameter required',
                              'qtype parameter required',
                              'qvalid parameter required',
                              'question parameter required'
                        )

7. getquestions - get all questions in a survey
  parameter:
        sid - (required) survey id
  return:
        array of question details object      
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
        }
  possible error:
        array('error'=> array('invalid sid')
             
8. editsurvey - edit survey details
  parameter:
        sid - (required) survey id
        title - (required) new survey title
        template - (optional) template filename
  return:
        true - if edit successful
        false - if failed
  possible error:
        array('error'=> array('invalid sid','sid parameter required','title parameter required')

9. editquestion - edit question in a survey
  parameter:
        sid - (required) survey id
        qid - (required) question id
        qtype - (required)  question type (single, dropdown, multi,bigbox, smallbox,pagebreak, info)
        qvalid - (required) validation (optional, required)
        question - (required) survey question text
        options - (required for Single/Dropdown/Multi question type) choices for question separated by (|)
                  e.g. (a.Red|b.Blue|c.Green|d.Black)
  return:
        true - if edit successful
        false - if failed
        
  possible error:
        array('error'=> array('invalid sid','invalid qid','sid parameter required','title parameter required')


10. deletequestion - delete a question in a survey
  parameter:
        sid - (required) survey id
        qid - (required) question id
  return:
        true - if delete successful
        false - if failed
  possible error:
        array('error'=> array('invalid sid','invalid qid','sid parameter required','qid parameter required')

11. deletesurvey - delete survey
  parameter:
        sid - (required) survey id
  return:
        true - if delete successful
        false - if failed
  possible error:
        array('error'=> array('invalid sid','sid parameter required')

12. getreport - get statistics/report of a survey
  parameter:
        sid - (required) survey id
        qid - (optional) question id, default is 'all'
  return:
        array of question and answer details object
        e.g 
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
   
  possible error:
        array('error'=> array('invalid sid')
           
List of general errors
   
    array('error'=> array(
      'Api key required',
      'Invalid api key',
      'Request not allowed'
    )	  