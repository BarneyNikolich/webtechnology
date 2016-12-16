<?php
/**
 * A class that contains code to implement a documents page
 *
 * @author Tom Ford <t.ford@ncl.ac.uk>
 * @copyright 2015 Newcastle University
 *
 */

    class Programs extends Siteaction
    {
      /**
       * Handle documents operations /moduleleader
       *
       * @param object $context The context object for the site
       *
       * @return string    A template name
       */

        public function handle($context)
        {

                $context->mustbemoduleleader();

                $t = new SiteInfo();
                $themes = $t->choices();

                $formd = $context->formdata(); //Gets parameters out of page! Use as search bar!
                if($formd->haspost('themeleader'))
                {
                    $themeid = $formd->post('themeselect');
                    $thmeleaderid = $formd->post('themeleader');
                    $id = $formd->post('submitbutton');
                    $userhassubmitted = false;

                    $existsid = R::find('themeselection', 'student_id = ?', [ $id ]);
                    if(sizeof($existsid) > 0) //if > 0 then at least 1 entry already exists for that user
                    {
                        $userhassubmitted = true;
                    }

                    if($themeid)

                    if($themeid == '' or $themeid == 'empty' or $thmeleaderid == 'empty') //if no theme is submitted
                    {
                        $context->local()->addval('showerr', true);
                        $context->local()->addval('errormsg', 'Ensure both theme and theme leader have been selected');
                    }
                    else if($userhassubmitted)
                    {
                        $context->local()->addval('alreadysubmitted', true);
                        $context->local()->addval('errorsubmit', 'You have already submitted for that user');
                    }
                    else
                    {
                        $context->local()->addval('success', true);
                        $context->local()->addval('successmsg', 'Successful submission of choices.');
                        $topic = R::dispense('themeselection');
                        $topic->student_id = $id;
                        $topic->theme_id = $themeid;
                        $topic->themeleader_id = $thmeleaderid;
                        R::store($topic);
                    }

                }

                if (($searchval = $formd->post('search', '')) !== '')
                {
                    $context->local()->addval('searchval', $searchval);
                    $results  = R::findOne( 'theme', ' name LIKE ? ', array($searchval) );
//                $context->local()->addval('searches', $results);
                    $context->local()->addval('searches', $results);
                    $context->local()->addval('donesearch', true);

                }


                return 'programs.twig';


        }
    }
?>
